<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Version;
use App\Models\VersionGallery;
use App\Models\VersionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VersionController extends Controller
{
            /**
     * Display a listing of the resource.
     */



    public function index()
    {

        $now = date("Y-m-d H:i");

        $versionsnumrw  = DB::table('versions')->count();
           
          if($versionsnumrw > 0) {
            $version  = DB::table('versions')->first();
                    
                $data = array(
                'versions_id' => $version->versions_id,
                'versions_name' => $version->versions_name, 
                'versions_androidnumber' => $version->versions_androidnumber, 
                'versions_iosnumber' => $version->versions_iosnumber, 
                'versions_status' => "true",    
                );
              
            
          } else {
            $data = array(
                'versions_status' => "false",
            );
          }
              
            return response()->json(['status' => true,'versionone'=>$data]);

             
        


    }




}
