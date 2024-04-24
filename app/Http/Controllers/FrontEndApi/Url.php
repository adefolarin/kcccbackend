<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Url
{
            /**
     * Display a listing of the resource.
     */

    public static function url() {
        $genurl = "http://localhost/projects/kcccbackend/";
        return $genurl;
    }


    public static function bannervideo()
    {
       $bannerurl = Url::url() . "storage/app/public/admin/videos/banners/";
       return $bannerurl;
    }

    public static function bannerimg()
    {
       $bannerurl = Url::url() . "admin/img/banners";
       return $bannerurl;
    }

    public static function doc()
    {
       $bannerurl = Url::url() . "storage/app/public/admin/docs/resources/";
       return $docurl;
    }

    public static function event()
    {
       $eventurl = Url::url() . "admin/img/events/";
       return $eventurl;
    }

    public static function news()
    {
       $newsurl = Url::url(). "admin/img/news/";
       return $newsurl;
    }

    public static function foodbankimage()
    {
       $foodbankurl = Url::url() . "admin/img/foodbanks/";
       return $foodbankurl;
    }

    public static function foodbankvideo()
    {
       $foodbankurl = Url::url() . "storage/app/public/admin/videos/foodbanks/";
       return $foodbankurl;
    }

    public static function departmentgallery()
    {
       $url = Url::url() . "admin/img/departmentgalleries/";
       return $url;
    }

    public static function department()
    {
       $url = Url::url() . "admin/img/departments/";
       return $url;
    }

    public static function eventgallery()
    {
       $url = Url::url() . "admin/img/eventgalleries/";
       return $url;
    }

    public static function foodbankgallery()
    {
       $url = Url::url() . "admin/img/foodbankgalleries/";
       return $url;
    }

    public static function gallery()
    {
       $url = Url::url() . "admin/img/galleries/";
       return $url;
    }

    public static function photo()
    {
       $url = Url::url() . "admin/img/photo/";
       return $url;
    }

    public static function product()
    {
       $url = Url::url() . "admin/img/products/";
       return $url;
    }

    public static function credit()
    {
       $url = Url::url() . "admin/img/credits/";
       return $url;
    }




}
