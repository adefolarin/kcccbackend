<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\DonationCategory;
use App\Models\DonationCategoryGallery;
use App\Models\DonationCategoryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DonationCategoryController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($donationcategoriesid = null)
    {

        //$donationcategories = DonationCategoryCategory::query()->get();

        //$donationcategories = DonationCategory::get();

        $now = date("Y-m-d H:i");

        $donationcategoriesnumrw = DB::table('donationcategories')->count();

        if($donationcategoriesid == null) {
           
          if($donationcategoriesnumrw > 0) {
            $donationcategories = DB::table('donationcategories')->get();;
            foreach($donationcategories as $donationcategory) {

                $data [] = array(
                'donationcategories_id' => $donationcategory->donationcategories_id,
                'donationcategories_name' => $donationcategory->donationcategories_name,
                );
            }
          } else {
            $data [] = array(
                'donationcategories_id' => ''
            );
          }
              
            return response()->json(['donationcategories'=>$data]);         
             
        }


    }

  






}
