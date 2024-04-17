<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceGallery;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ResourceController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($resourcesid = null)
    {

        //$resourcecategories = ResourceCategory::query()->get();

        //$resources = Resource::get();

        $now = date("Y-m-d H:i");

        $resourcesnumrw = DB::table('resourcecategories')->join('resources','resourcecategories.resourcecategories_id','=', 'resources.resourcecategoriesid')->select('resources.*','resourcecategories.resourcecategories_name')->count();

        if($resourcesid == null) {
           
          if($resourcesnumrw > 0) {
            $resources = DB::table('resourcecategories')->join('resources','resourcecategories.resourcecategories_id','=', 'resources.resourcecategoriesid')->select('resources.*','resourcecategories.resourcecategories_name')->get();
            foreach($resources as $resource) {
   
                $data [] = array(
                'resources_id' => $resource->resources_id,
                'resources_name' => $resource->resources_name,
                'resources_file' => $resource->resources_file,
                );
            }
          } else {
            $data [] = array(
                'resources_id' => ''
            );
          }
              
            return response()->json(['resources'=>$data]);

        } else {

            
            $resource = new Resource;
            //$resourcecategory = new ResourceCategory;
            $resourceonenumrw = $resource->where('resources_id', $resourcesid)->count();

            if($resourceonenumrw > 0) {
              $resourceone = $resource->where('resources_id', $resourcesid)->first();

              $data = array(
                'resources_id' => $resourceone->resources_id,
                'resources_name' => $resourceone->resources_name,
            );
            } else {
              $data = array(
                 'resources_title' => ''
              );
            }
  
    
            return response()->json(['resourceone'=>$data]);
            
             
        }


    }




}
