<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\Models\Rating;
use Dotenv\Validator as DotenvValidator;
use Intervention\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as FacadesHash;

class RatingController extends Controller
{
  //
  public function index($productsid)
  {

    $ratingsnumrw = DB::table('ratings')->where('productsid',$productsid)->count();

    if ($productsid == null) {

      if ($ratingsnumrw > 0) {

        $ratings = DB::table('ratings')->where('productsid',$productsid)->get();
        foreach ($ratings as $rating) {
        
          $data[] = array(
            'ratings_id' => $rating->ratings_id,
            'ratings_number' => $rating->ratings_number,
            'ratings_comment' => $rating->ratings_comment,
            'ratings_status' => $rating->ratings_status,
            'products_name' => $rating->products_name,
          );
        }
      } else {
        $data[] = array(
          'ratings_number' => ''
        );
      }

      $productsnumrw = DB::table('products')->where('products_id',$productsid)->count();

      if ($productsnumrw > 0) {

        $products = DB::table('products')->where('products_id',$productsid)->first();
        foreach ($ratings as $rating) {
        
          $productdata = array(
            'products_name' => $products->products_name,
          );
        }
      } else {
          $productdata[] = array(
          'products_name' => ''
        );
      }

        return response()->json(['ratings' => $data, 'products' => $productdata]);

    } 
  }


  public function store(Request $request) { 
    if($request->isMethod('post')) {
        $data = $request->all();
        $productsid = $data['productsid'];

        $ratingsnumber = 1;

        //$ratingsnumrw = DB::table('ratings')->where('products_id',$productsid)->count();

        //$ratings = DB::table('ratings')->where('products_id',$productsid)->first();


      $rules = [
        'ratings_comment' => 'required',
      ];

      $customMessages = [
        'ratings.required' => 'All fields are required',
      ];


      $validator = Validator::make($data, $rules, $customMessages);

      if ($validator->fails()) {
        return response()->json([$validator->errors(), 422]);
      }

        $store = [
            [
               'storeusersid' => $data['storeusersid'],
               'productsid' => $data['productsid'],
               'ratings_number' => 1, 
               'ratings_comment' => $data['ratings_comment'], 
               'ratings_status' => 1,
               'ratings_date' => date('Y-m-d'),  
            ]
        ];

        //if($ratingsnumrw > 0) {
           // $ratingsnumber = $ratingsnumber + $ratings->ratings_number;
           // Rating::where('productsid', $productsid)->update(['ratings_number' => $ratingsnumber]);
        //} else {
            Rating::insert($store);
            return response()->json(['status' => true, 'message' => "You have successfully rated this product"], 201);
        //}
     }
  }



}
