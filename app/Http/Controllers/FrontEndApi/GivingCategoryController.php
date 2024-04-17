<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\GivingCategory;
use App\Models\GivingCategoryGallery;
use App\Models\GivingCategoryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GivingCategoryController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($givingcategoriesid = null)
    {

        //$givingcategories = GivingCategoryCategory::query()->get();

        //$givingcategories = GivingCategory::get();

        $now = date("Y-m-d H:i");

        $givingcategoriesnumrw = DB::table('givingcategories')->count();

        if($givingcategoriesid == null) {
           
          if($givingcategoriesnumrw > 0) {
            $givingcategories = DB::table('givingcategories')->get();;
            foreach($givingcategories as $givingcategory) {

                $data [] = array(
                'givingcategories_id' => $givingcategory->givingcategories_id,
                'givingcategories_name' => $givingcategory->givingcategories_name,
                );
            }
          } else {
            $data [] = array(
                'givingcategories_id' => ''
            );
          }
              
            return response()->json(['givingcategories'=>$data]);         
             
        }


    }

  






}
