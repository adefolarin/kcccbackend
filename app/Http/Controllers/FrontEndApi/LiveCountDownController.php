<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\LiveCountDown;
use App\Models\LiveCountDownGallery;
use App\Models\LiveCountDownCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class LiveCountDownController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($livecountdownsid = null)
    {

        $now = date("Y-m-d H:i");

        $livecountdownsnumrw  = DB::table('livecountdowns')
        ->where("livecountdowns_datetime", ">", $now)
        ->orderBy("livecountdowns_datetime")
        ->limit(1)->count();

        if($livecountdownsid == null) {
           
          if($livecountdownsnumrw > 0) {
            $livecountdowns = DB::table('livecountdowns')
            ->where("livecountdowns_datetime", ">", $now)
            ->orderBy("livecountdowns_datetime")
            ->limit(1)->get();
            foreach($livecountdowns as $livecountdown) {
               
                $livecountdown_countdown = strtotime($livecountdown->livecountdowns_datetime);

                $data [] = array(
                'livecountdowns_id' => $livecountdown->livecountdowns_id,
                'livecountdowns_datetime' => $livecountdown_countdown, 
                'livecountdowns_status' => "true",    
                );
            }
          } else {
            $data [] = array(
                'livecountdowns_status' => "false",
            );
          }
              
            return response()->json(['status' => true,'livecountdowns'=>$data]);

             
        }


    }


    public function mobileindex()
    {

        $now = date("Y-m-d H:i");

        $livecountdownsnumrw  = DB::table('livecountdowns')
        ->where("livecountdowns_datetime", ">", $now)
        ->count();
           
          if($livecountdownsnumrw > 0) {
            $livecountdown = DB::table('livecountdowns')
            ->where("livecountdowns_datetime", ">", $now)
            ->first();
           
               
                $livecountdown_countdown = strtotime($livecountdown->livecountdowns_datetime);

                $data = array(
                'livecountdowns_id' => $livecountdown->livecountdowns_id,
                'livecountdowns_datetime' => 1000 * $livecountdown_countdown, 
                'livecountdowns_status' => "true",    
                );
            
          } else {
            $data = array(
                'livecountdowns_status' => "false",
            );
          }
              
            return response()->json(['status' => true,'livecountdownone'=>$data]);

             
        


    }




}
