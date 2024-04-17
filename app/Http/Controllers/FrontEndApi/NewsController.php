<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsGallery;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class NewsController extends Controller
{
            /**
     * Display a listing of the news.
     */
    public function index($newsid = null)
    {

        //$newscategories = NewsCategory::query()->get();

        //$news = News::get();

        $now = date("Y-m-d H:i");

        $newsnumrw = DB::table('newscategories')->join('news','newscategories.newscategories_id','=', 'news.newscategoriesid')->select('news.*','newscategories.newscategories_name')->count();

        if($newsid == null) {
           
          if($newsnumrw > 0) {
            $news = DB::table('newscategories')->join('news','newscategories.newscategories_id','=', 'news.newscategoriesid')->select('news.*','newscategories.newscategories_name')->get();
            foreach($news as $news) {
   
                $data [] = array(
                'news_id' => $news->news_id,
                'news_title' => $news->news_title,
                'news_file' => $news->news_file,
                'news_content' => $news->news_content,
                'news_date' => $news->news_date,
                );
            }
          } else {
            $data [] = array(
                'news_title' => ''
            );
          }
              
            return response()->json(['status' => true, 'news'=>$data]);

        } else {

            
            $news = new News;
            //$newscategory = new NewsCategory;
            $newsonenumrw = $news->where('news_id', $newsid)->count();

            if($newsonenumrw > 0) {
              $newsone = $news->where('news_id', $newsid)->first();

              $data = array(
                'news_id' => $newsone->news_id,
                'news_title' => $newsone->news_title,
                'news_file' => $newsone->news_file,
                'news_content' => $newsone->news_content,
                'news_date' => $newsone->news_date,
            );
            } else {
              $data = array(
                 'news_title' => ''
              );
            }
  
    
            return response()->json(['status' => true, 'newsone'=>$data]);
            
             
        }


    }




}
