<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ReviewController extends Controller
{
            /**
     * Display a listing of the sermon.
     */
    public function index($sermonsid = null)
    {

    }

    public function reviewPost(Request $request) {
      if($request->isMethod('post')) {
        $data = $request->all();

        $eventdate = $data['eventdate'];
        $eventcategoryname = $data['eventcategoryname'];
        $eventlocation = $data['eventlocation'];
        $eventpreacher = $data['eventpreacher'];

        $eventnumrw = DB::table('events')->where('events_date',$eventdate)->count();

        if($eventnumrw > 0) {
            $event = DB::table('events')->where('events_date',$eventdate)->first();
            $eventsid = $event->events_id; 
        } else {
            $eventsid = "";
        }

        // EVENT SEARCH
 
        $reviewsnumrw = DB::table('eventcategories')->join('events','eventcategories.eventcategories_id','=', 'events.eventcategoriesid')->select('events.*','eventcategories.eventcategories_name')->where("eventcategories.eventcategories_name", '=', $eventcategoryname)->where("events_preacher", '=', $eventpreacher)->where("events_venue", '=', $eventlocation)->where("events_date", '=', $eventdate)->count();

        if($reviewsnumrw > 0) {
          $reviews = DB::table('eventcategories')->join('events','eventcategories.eventcategories_id','=', 'events.eventcategoriesid')->select('events.*','eventcategories.eventcategories_name')->where("eventcategories.eventcategories_name", '=', $eventcategoryname)->where("events_preacher", '=', $eventpreacher)->where("events_venue", '=', $eventlocation)->where("events_date", '=', $eventdate)->get();

          foreach($reviews as $review) {
   
            $eventsearchdata [] = array(
            'events_id' => $review->events_id,
            'events_title' => $review->events_title,
            'events_venue' => $review->events_venue,
            'events_startdate' => $review->events_startdate,
            'events_organizer' => $review->events_organizer,
            'events_preacher' => $review->events_preacher,
            );
          }
        }  else {
            $eventsearchdata [] = array(
            'eventsearch_result' => "Not Found"
            );
        }
   
           /// SERMON SEARCH

           $sermonnumrw = DB::table('sermons')->where('sermons_preacher',$eventpreacher)->where('sermons_date',$eventdate)->where('sermons_location',$eventlocation)->count();

           if($sermonnumrw > 0) {
            $sermons = DB::table('sermons')->where('sermons_preacher',$eventpreacher)->where('sermons_date',$eventdate)->where('sermons_location',$eventlocation)->get();
            foreach($sermons as $sermon) {
   
                $sermonsearchdata [] = array(
                'sermons_file' => $sermon->sermons_file,
                'sermons_tile' => $sermon->sermons_title,
                );
              }

           } else {
            $sermonsearchdata [] = array(
                'sermonsearch_result' => "Not Found"
            );
           }

           // EVENT GALLERY

           $eventgallerynumrw = DB::table('eventgalleries')->where("eventsid", $eventsid)->orderBy("eventsid")->count();

           if($eventgallerynumrw > 0) {
           $eventgalleries = DB::table('eventgalleries')->where("eventsid", $eventsid)->orderBy("eventsid")->get();

           foreach($eventgalleries as $eventgallery) {
               $eventgallerydata [] = array(
               'eventsid' => $eventgallery->eventsid,
               'eventgalleries_file' => $eventgallery->eventgalleries_file,
               );
           }
          } else {
              $eventgallerydata [] = array(
                 'eventgalleries_file' => ''
              );
          }

           return response()->json(['eventsearch' => $eventsearchdata ,'sermonsearch'=>$sermonsearchdata, 'eventgallerysearch' => $eventgallerydata]);
  
      }
    }

    public function reviewSearchOld(Request $request) {
      if($request->isMethod('post')) {
        $data = $request->all();

        $eventdate = $data['eventdate'];
        $eventcategoryname = $data['eventcategoryname'];
        $eventlocation = $data['eventlocation'];
        $eventpreacher = $data['eventpreacher'];

        $eventnumrw = DB::table('events')->where('events_date',$eventdate)->count();

        if($eventnumrw > 0) {
            $event = DB::table('events')->where('events_date',$eventdate)->first();
            $eventsid = $event->events_id; 
        } else {
            $eventsid = "";
        }

        // EVENT SEARCH
 
        $reviewsnumrw = DB::table('eventcategories')->join('events','eventcategories.eventcategories_id','=', 'events.eventcategoriesid')->select('events.*','eventcategories.eventcategories_name')->where("eventcategories.eventcategories_name", '=', $eventcategoryname)->where("events_preacher", '=', $eventpreacher)->where("events_venue", '=', $eventlocation)->where("events_date", '=', $eventdate)->count();

        if($reviewsnumrw > 0) {
          $reviews = DB::table('eventcategories')->join('events','eventcategories.eventcategories_id','=', 'events.eventcategoriesid')->select('events.*','eventcategories.eventcategories_name')->where("eventcategories.eventcategories_name", '=', $eventcategoryname)->where("events_preacher", '=', $eventpreacher)->where("events_venue", '=', $eventlocation)->where("events_date", '=', $eventdate)->get();

          foreach($reviews as $review) {
   
            $eventsearchdata [] = array(
            'events_id' => $review->events_id,
            'events_title' => $review->events_title,
            'events_venue' => $review->events_venue,
            'events_startdate' => $review->events_startdate,
            'events_organizer' => $review->events_organizer,
            'events_preacher' => $review->events_preacher,
            'searchresult' => $reviewsnumrw,
            'events_date' => $review->events_date,
            );
          }
        }  else {
            $eventsearchdata  = array(
            'eventsearch_result' => "Not Found"
            );
        }
   
           /// SERMON SEARCH

           $sermonnumrw = DB::table('sermons')->where('sermons_preacher',$eventpreacher)->where('sermons_date',$eventdate)->where('sermons_location',$eventlocation)->count();

           if($sermonnumrw > 0) {
            $sermons = DB::table('sermons')->where('sermons_preacher',$eventpreacher)->where('sermons_date',$eventdate)->where('sermons_location',$eventlocation)->get();
            foreach($sermons as $sermon) {
   
                $sermonsearchdata [] = array(
                'sermons_file' => $sermon->sermons_file,
                'sermons_title' => $sermon->sermons_title,
                );
              }

           } else {
            $sermonsearchdata = array(
                'sermonsearch_result' => "Not Found"
            );
           }

           // EVENT GALLERY

           $eventgallerynumrw = DB::table('eventgalleries')->where("eventsid", $eventsid)->orderBy("eventsid")->count();

           if($eventgallerynumrw > 0) {
           $eventgalleries = DB::table('eventgalleries')->where("eventsid", $eventsid)->orderBy("eventsid")->get();

           foreach($eventgalleries as $eventgallery) {
               $eventgallerydata [] = array(
               'eventsid' => $eventgallery->eventsid,
               'eventgalleries_file' => $eventgallery->eventgalleries_file,
               );
           }
          } else {
              $eventgallerydata  = array(
                 'eventgallery_searchresult' => ''
              );
          }

           return response()->json(['eventsearch' => $eventsearchdata ,'sermonsearch'=>$sermonsearchdata, 'eventgallerysearch' => $eventgallerydata]);
  
      }
    }

    public function reviewSearch(Request $request) {

      if($request->isMethod('post')) {
        $data = $request->all();

        $reviewyear = $data['reviewyear'];

        $reviewnumrw = DB::table('reviews')->where('reviews_year',$reviewyear)->count();

        if($reviewnumrw > 0) { 
            $reviews = DB::table('reviews')->where('reviews_year',$reviewyear)->get()->toArray();
            foreach($reviews as $review) {
   
              $reviewsearchdata [] = array(
              'reviews_id' => $review->reviews_id,
              'reviews_year' => $review->reviews_year,
              'reviews_file' => $review->reviews_file,
              );
            }
        } else {
            $reviewsearchdata  = array(
            'reviews_year' => "Not Found",
            'reviews_result' => "Not Found",
            );
        }
            return response()->json(['reviews'=>$reviewsearchdata]);

  
      }
    }


}
