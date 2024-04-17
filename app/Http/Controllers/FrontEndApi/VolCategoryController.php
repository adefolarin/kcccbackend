<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\VolCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VolCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {

          $volcategoriesnumrw = VolCategory::query()->count(); 
          
          if($volcategoriesnumrw > 0) {
            $volcategories = VolCategory::query()->get(); 

            foreach($volcategories as $volcategory) {
                $data [] = array(
                   'volcategories_id' => $volcategory->volcategories_id,
                   'volcategories_name' => $volcategory->volcategories_name,
                );
            }
          }

            return response()->json(['status' => true,'volcategories' => $data]);
        }

         
        //dd($CmsPages);



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

  


}
