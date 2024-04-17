<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\ZipCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ZipCodeController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {

          $zipcodesnumrw = ZipCode::query()->count(); 
          
          if($zipcodesnumrw > 0) {
            $zipcodes = ZipCode::query()->get(); 

            foreach($zipcodes as $zipcode) {
                $data [] = array(
                   'zipcodes_id' => $zipcode->zipcodes_id,
                   'zipcodes_name' => $zipcode->zipcodes_name,
                   'zipcodes_price' => $zipcode->zipcodes_price,
                );
            }
          } else {
               $data = array(
                'zipcodes_name' => '',

             );
          }

            return response()->json(['zipcodes' => $data]);
        }

         
        //dd($CmsPages);



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

  


}
