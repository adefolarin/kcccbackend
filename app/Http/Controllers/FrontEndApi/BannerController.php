<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;

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
           return $banners;
        }
        //return view('admin.banner')->with(compact('banners'));
    }


}
