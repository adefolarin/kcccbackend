<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FrontEndApi\Url;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
        //$banners = Banner::get()->where("banner_type","video")->orderBy("banners_id")->limit(1); 
           $bannersnumrw = DB::table('banners')->count(); 
    
           if($bannersnumrw > 0) {
            $banners = DB::table('banners')->orderByDesc("banner_id")->limit(1)->get();
            foreach($banners as $banner) {
                $data [] = array(
                'banner_id' => $banner->banner_id,
                'banner_name' => $banner->banner_name,
                'banner_file' => Url::bannervideo() . $banner->banner_file
                );
           }
          } else {
            $data [] = array(
                'banners_id' => ''
            );
          }
                 
          return response()->json(['banners'=>$data]);
    }


}
