<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\SermonGallery;
use App\Models\SermonCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SermonController extends Controller
{
            /**
     * Display a listing of the sermon.
     */
    public function index($sermonsid = null)
    {

        //$sermoncategories = SermonCategory::query()->get();

        //$sermons = Sermon::get();

        $now = date("Y-m-d H:i");

        $sermonsnumrw = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->count();

        if($sermonsid == null) {
           
          if($sermonsnumrw > 0) {
            $sermons = DB::table('sermoncategories')->limit(3)->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->get();
            foreach($sermons as $sermon) {
   
                $data [] = array(
                'sermons_id' => $sermon->sermons_id,
                'sermons_title' => $sermon->sermons_title,
                'sermons_file' => $sermon->sermons_file,
                'sermons_date' => $sermon->sermons_date,
                'sermons_preacher' => $sermon->sermons_preacher,
                'sermons_location' => $sermon->sermons_location,
                );
            }
          } else {
            $data [] = array(
                'sermons_id' => ''
            );
          }
              
            return response()->json(['sermons'=>$data]);

        } else {

            
            $sermon = new Sermon;
            //$sermoncategory = new SermonCategory;
            $sermononenumrw = $sermon->where('sermons_id', $sermonsid)->count();

            if($sermononenumrw > 0) {
              $sermonone = $sermon->where('sermons_id', $sermonsid)->first();

              $data = array(
                'sermons_id' => $sermonone->sermons_id,
                'sermons_title' => $sermonone->sermons_title,
                'sermons_date' => $sermon->sermons_date,
                'sermons_preacher' => $sermon->sermons_preacher,
                'sermons_location' => $sermon->sermons_location,
            );
            } else {
              $data = array(
                 'sermons_title' => ''
              );
            }
  
    
            return response()->json(['sermonone'=>$data]);
            
             
        }


    }


    public function getAllSermons()
    {

        $now = date("Y-m-d H:i");

        $sermonsnumrw = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->count();

           
          if($sermonsnumrw > 0) {
            $sermons = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->get();
            foreach($sermons as $sermon) {
   
                $data [] = array(
                'sermons_id' => $sermon->sermons_id,
                'sermons_title' => $sermon->sermons_title,
                'sermons_file' => $sermon->sermons_file,
                'sermons_date' => $sermon->sermons_date,
                'sermons_preacher' => $sermon->sermons_preacher,
                'sermons_location' => $sermon->sermons_location,
                );
            }
          } else {
            $data [] = array(
                'sermons_id' => ''
            );
          }
              
            return response()->json(['sermons'=>$data]);            


    }


    public function sermonQuickSearch(Request $request) {
      if($request->isMethod('post')) {
        $data = $request->all();

        $sermonsearch = $data['sermonsearch'];
 
        $sermonsnumrw = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->where("sermons_title", '=', $sermonsearch)->orWhere("sermoncategories.sermoncategories_name", '=', $sermonsearch)->count();

        if($sermonsnumrw > 0) {
          $sermons = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->where("sermons_title", 'LIKE', $sermonsearch)->orWhere("sermoncategories.sermoncategories_name", 'LIKE', $sermonsearch)->get();

          foreach($sermons as $sermon) {
   
            $searchdata [] = array(
            'sermons_id' => $sermon->sermons_id,
            'sermons_title' => $sermon->sermons_title,
            'sermons_file' => $sermon->sermons_file,
            'sermons_date' => $sermon->sermons_date,
            'sermons_preacher' => $sermon->sermons_preacher,
            'sermons_location' => $sermon->sermons_location,
            'searchresult' => $sermonsnumrw,
            );
          }
        }  else {
            $searchdata [] = array(
            'sermonsearch_result' => "Not Found"
            );
        }

           return response()->json(['sermonsearchdata'=>$searchdata]);
  
      }
    }

    public function sermonSearch(Request $request) {
      if($request->isMethod('post')) {
        $data = $request->all();

        $sermontitle = $data['sermontitle'];
        $sermonpreacher = $data['sermonpreacher'];
        $sermondate = $data['sermondate'];
 
        $sermonsnumrw = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->where("sermons_title", '=', $sermontitle)->where("sermons_preacher", '=', $sermonpreacher)->where("sermons_date", '=', $sermondate)->count();

        if($sermonsnumrw > 0) {
          $sermons = DB::table('sermoncategories')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->where("sermons_title", '=', $sermontitle)->where("sermons_preacher", '=', $sermonpreacher)->where("sermons_date", '=', $sermondate)->get();

          foreach($sermons as $sermon) {
   
            $searchdata [] = array(
            'sermons_id' => $sermon->sermons_id,
            'sermons_title' => $sermon->sermons_title,
            'sermons_file' => $sermon->sermons_file,
            'sermons_date' => $sermon->sermons_date,
            'sermons_preacher' => $sermon->sermons_preacher,
            'sermons_location' => $sermon->sermons_location,
            'searchresult' => $sermonsnumrw,
            );
          }
        }  else {
            $searchdata [] = array(
            'sermonsearch_result' => "Not Found"
            );
        }

           return response()->json(['sermonsearchdata'=>$searchdata]);
  
      }
    }


    public function sermonLikes(Request $request) {

      $message = "Liked";

      if($request->isMethod('post')) {
          $data = $request->all();

          $sermons_id = $data['sermons_id'];

          $countlikes = 1;

          $sermonnumrw = Sermon::where('sermons_id', $sermons_id)->count();

          $sermons = Sermon::where('sermons_id', $sermons_id)->first();

          if($sermonnumrw < 0) {
            $sermons_likes =  $countlikes;
          } else {
            $sermons_likes = $sermons->sermons_likes + $countlikes;
          }

          Sermon::where('sermons_id', $sermons_id)->update(['sermons_likes' => $sermons_likes]);

          return response()->json(['status' => true, 'message' => $message], 201);
      }

    }


    public function getSermonTitles()
    {


        $sermonnumrw = DB::table('sermons')->count();

           
          if($sermonnumrw > 0) {
              $sermons = DB::table('sermons')->select('sermons_title')->groupBy('sermons_title')->get();

               foreach($sermons as $sermon) {
            

                $data [] = array(
                'sermons_title' => $sermon->sermons_title,
                );
            }
          } else {
            $data [] = array(
                'sermons_title' => ''
            );
          }
              
            return response()->json(['sermontitles'=>$data]);

  


    }


    public function getSermonPreachers()
    {


        $sermonnumrw = DB::table('sermons')->count();

           
          if($sermonnumrw > 0) {
              $sermons = DB::table('sermons')->select('sermons_preacher')->groupBy('sermons_preacher')->get();

               foreach($sermons as $sermon) {
            

                $data [] = array(
                'sermons_preacher' => $sermon->sermons_preacher,
                );
            }
          } else {
            $data [] = array(
                'sermons_preacher' => ''
            );
          }
              
            return response()->json(['sermonpreachers'=>$data]);

  


    }




}
