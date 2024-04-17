<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {

          $productcategoriesnumrw = ProductCategory::query()->count(); 
          
          if($productcategoriesnumrw > 0) {
            $productcategories = ProductCategory::query()->get(); 

            foreach($productcategories as $productcategory) {
                $data [] = array(
                   'productcategories_id' => $productcategory->productcategories_id,
                   'productcategories_name' => $productcategory->productcategories_name,
                );
            }
          }

            return response()->json(['productcategories' => $data]);
        }

         
        //dd($CmsPages);



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

  


}
