<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PodcastController extends Controller
{
    


    public function secToHR($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;

        if($hours < 10) {
            $hours = "0".$hours;
        } 
        else if($minutes < 10) {
            $minutes = "0".$minutes;
        }
        else if($seconds < 10) {
            $seconds = "0".$seconds;
        }
        return "$hours:$minutes:$seconds";
     }
  
     public function newdate($time) {
  
       $time = strtotime($time);
       $newformat = date('Y-m-d',$time);
       return $newformat;
     } 


    public function podcastSearch()
    {

        $url = "https://www.buzzsprout.com/api/1241774/episodes.json";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                "authorization: Token token=3b220d086a438823020bdf3455d92193", //replace this with your own test key
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));


        $response = curl_exec($curl);

        $json_data = json_decode($response, true);

         //echo "<prev>"; print_r($json_data); die;

        foreach ($json_data as $key1 => $value1) {
            $data[] = array(
                'podcasts_img'   => $json_data[$key1]['artwork_url'],
                'podcast_id'   => $json_data[$key1]['id'],
                'podcasts_file'   => $json_data[$key1]['audio_url'],
                'podcasts_title'   => $json_data[$key1]['title'],
                'podcasts_artist'   => $json_data[$key1]['artist'],
                'published_at'   => $this->newdate($json_data[$key1]['published_at']),
                'duration'   => $this->secToHR($json_data[$key1]['duration']),
            );
        }

        if ($response) {
            return response()->json(['podcasts' => $data]);
        } else {
            return response()->json(['podcasts' => ""]);
        }

        
    }
}
