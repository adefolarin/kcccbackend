<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use App\Models\PodcastGallery;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PodcastController extends Controller
{
            /**
     * Display a listing of the podcast.
     */
    public function index($podcastsid = null)
    {

        //$podcastcategories = PodcastCategory::query()->get();

        //$podcasts = Podcast::get();

        $now = date("Y-m-d H:i");

        $podcastsnumrw = DB::table('podcastcategories')->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->count();

        if($podcastsid == null) {
           
          if($podcastsnumrw > 0) {
            $podcasts = DB::table('podcastcategories')->limit(3)->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->get();
            foreach($podcasts as $podcast) {
   
                $data [] = array(
                'podcasts_id' => $podcast->podcasts_id,
                'podcasts_title' => $podcast->podcasts_title,
                'podcasts_file' => $podcast->podcasts_file,
                'podcasts_date' => $podcast->podcasts_date,
                'podcasts_preacher' => $podcast->podcasts_preacher,
                'podcasts_location' => $podcast->podcasts_location,
                );
            }
          } else {
            $data [] = array(
                'podcasts_id' => ''
            );
          }
              
            return response()->json(['status' => true, 'podcasts'=>$data]);

        } else {

            
            $podcast = new Podcast;
            //$podcastcategory = new PodcastCategory;
            $podcastonenumrw = $podcast->where('podcasts_id', $podcastsid)->count();

            if($podcastonenumrw > 0) {
              $podcastone = $podcast->where('podcasts_id', $podcastsid)->first();

              $data = array(
                'podcasts_id' => $podcastone->podcasts_id,
                'podcasts_title' => $podcastone->podcasts_title,
                'podcasts_date' => $podcast->podcasts_date,
                'podcasts_preacher' => $podcast->podcasts_preacher,
                'podcasts_location' => $podcast->podcasts_location,
            );
            } else {
              $data = array(
                 'podcasts_title' => ''
              );
            }
  
    
            return response()->json(['status' => true, 'podcastone'=>$data]);
            
             
        }


    }


    public function getAllPodcasts()
    {

        $now = date("Y-m-d H:i");

        $podcastsnumrw = DB::table('podcastcategories')->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->count();

           
          if($podcastsnumrw > 0) {
            $podcasts = DB::table('podcastcategories')->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->get();
            foreach($podcasts as $podcast) {
   
                $data [] = array(
                'podcasts_id' => $podcast->podcasts_id,
                'podcasts_title' => $podcast->podcasts_title,
                'podcasts_file' => $podcast->podcasts_file,
                'podcasts_date' => $podcast->podcasts_date,
                'podcasts_preacher' => $podcast->podcasts_preacher,
                'podcasts_location' => $podcast->podcasts_location,
                );
            }
          } else {
            $data [] = array(
                'podcasts_id' => ''
            );
          }
              
            return response()->json(['status' => true, 'podcasts'=>$data]);            


    }


    public function podcastQuickSearch(Request $request) {
      if($request->isMethod('post')) {
        $data = $request->all();

        $podcastsearch = $data['podcastsearch'];
 
        $podcastsnumrw = DB::table('podcastcategories')->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->where("podcasts_title", '=', $podcastsearch)->orWhere("podcastcategories.podcastcategories_name", '=', $podcastsearch)->count();

        if($podcastsnumrw > 0) {
          $podcasts = DB::table('podcastcategories')->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->where("podcasts_title", 'LIKE', $podcastsearch)->orWhere("podcastcategories.podcastcategories_name", 'LIKE', $podcastsearch)->get();

          foreach($podcasts as $podcast) {
   
            $searchdata [] = array(
            'podcasts_id' => $podcast->podcasts_id,
            'podcasts_title' => $podcast->podcasts_title,
            'podcasts_file' => $podcast->podcasts_file,
            'podcasts_date' => $podcast->podcasts_date,
            'podcasts_preacher' => $podcast->podcasts_preacher,
            'podcasts_location' => $podcast->podcasts_location,
            'searchresult' => $podcastsnumrw,
            );
          }
        }  else {
            $searchdata [] = array(
            'podcastsearch_result' => "Not Found"
            );
        }

           return response()->json(['status' => true,'podcastsearchdata'=>$searchdata]);
  
      }
    }

    public function podcastSearch(Request $request) {
      if($request->isMethod('post')) {
        $data = $request->all();

        $podcasttitle = $data['podcasttitle'];
        $podcastpreacher = $data['podcastpreacher'];
        $podcastdate = $data['podcastdate'];
 
        $podcastsnumrw = DB::table('podcastcategories')->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->where("podcasts_title", '=', $podcasttitle)->where("podcasts_preacher", '=', $podcastpreacher)->where("podcasts_date", '=', $podcastdate)->count();

        if($podcastsnumrw > 0) {
          $podcasts = DB::table('podcastcategories')->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->where("podcasts_title", '=', $podcasttitle)->where("podcasts_preacher", '=', $podcastpreacher)->where("podcasts_date", '=', $podcastdate)->get();

          foreach($podcasts as $podcast) {
   
            $searchdata [] = array(
            'podcasts_id' => $podcast->podcasts_id,
            'podcasts_title' => $podcast->podcasts_title,
            'podcasts_file' => $podcast->podcasts_file,
            'podcasts_date' => $podcast->podcasts_date,
            'podcasts_preacher' => $podcast->podcasts_preacher,
            'podcasts_location' => $podcast->podcasts_location,
            'searchresult' => $podcastsnumrw,
            );
          }
        }  else {
            $searchdata [] = array(
            'podcastsearch_result' => "Not Found"
            );
        }

           return response()->json(['podcastsearchdata'=>$searchdata]);
  
      }
    }


    public function podcastLikes(Request $request) {

      $message = "Liked";

      if($request->isMethod('post')) {
          $data = $request->all();

          $podcasts_id = $data['podcasts_id'];

          $countlikes = 1;

          $podcastnumrw = Podcast::where('podcasts_id', $podcasts_id)->count();

          $podcasts = Podcast::where('podcasts_id', $podcasts_id)->first();

          if($podcastnumrw < 0) {
            $podcasts_likes =  $countlikes;
          } else {
            $podcasts_likes = $podcasts->podcasts_likes + $countlikes;
          }

          Podcast::where('podcasts_id', $podcasts_id)->update(['podcasts_likes' => $podcasts_likes]);

          return response()->json(['status' => true, 'message' => $message], 201);
      }

    }


    public function getPodcastTitles()
    {


        $podcastnumrw = DB::table('podcasts')->count();

           
          if($podcastnumrw > 0) {
              $podcasts = DB::table('podcasts')->select('podcasts_title')->groupBy('podcasts_title')->get();

               foreach($podcasts as $podcast) {
            

                $data [] = array(
                'podcasts_title' => $podcast->podcasts_title,
                );
            }
          } else {
            $data [] = array(
                'podcasts_title' => ''
            );
          }
              
            return response()->json(['podcasttitles'=>$data]);

  


    }


    public function getPodcastPreachers()
    {


        $podcastnumrw = DB::table('podcasts')->count();

           
          if($podcastnumrw > 0) {
              $podcasts = DB::table('podcasts')->select('podcasts_preacher')->groupBy('podcasts_preacher')->get();

               foreach($podcasts as $podcast) {
            

                $data [] = array(
                'podcasts_preacher' => $podcast->podcasts_preacher,
                );
            }
          } else {
            $data [] = array(
                'podcasts_preacher' => ''
            );
          }
              
            return response()->json(['podcastpreachers'=>$data]);

  


    }




}
