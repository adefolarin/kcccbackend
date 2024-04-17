<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\VolForm;
use App\Models\VolCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VolFormController extends Controller
{
            /**
     * Display a listing of the volform.
     */
    public function index()
    {

        //$volcategories = VolFormCategory::query()->get();

        //$volforms = VolForm::get();

        $now = date("Y-m-d H:i");

        $volformsnumrw = DB::table('volcategories')->join('volforms','volcategories.volcategories_id','=', 'volforms.volcategoriesid')->select('volforms.*','volcategories.volcategories_name')->count();

           
          if($volformsnumrw > 0) {
            $volforms = DB::table('volcategories')->join('volforms','volcategories.volcategories_id','=', 'volforms.volcategoriesid')->select('volforms.*','volcategories.volcategories_name')->get();
            foreach($volforms as $volform) {
   
                $data [] = array(
                 'volforms_date' => date("F j, Y", strtotime($volform->voldatetime)),
                 'volforms_mobiletime' => date("g:ia", strtotime($volform->voldatetime)),
                 'volforms_time' => date("F j, Y g:ia", strtotime($volform->voldatetime)),
                );
            }
          } else {
            $data [] = array(
                'volforms_time' => ''
            );
          }
              
            return response()->json(['status' => true, 'volforms'=>$data]);
            


    }


    public function mobileindex($volcategoriesid)
    {

        //$volcategories = VolFormCategory::query()->get();

        //$volforms = VolForm::get();

        $now = date("Y-m-d H:i");

        $volcategories = DB::table('volcategories')
        ->where('volcategories_id', $volcategoriesid)->first();

        $volformsnumrw = DB::table('volcategories')->join('volforms','volcategories.volcategories_id','=', 'volforms.volcategoriesid')->select('volforms.*','volcategories.volcategories_name')
        ->where('volcategories_id', $volcategoriesid)->count();

           
          if($volformsnumrw > 0) {
            $volforms = DB::table('volcategories')->join('volforms','volcategories.volcategories_id','=', 'volforms.volcategoriesid')->select('volforms.*','volcategories.volcategories_name')
            ->where('volcategories_id', $volcategoriesid)->get();
            $volcatdata = array(
              'volcategories_name' => $volcategories->volcategories_name,
            );
            foreach($volforms as $volform) {
   
                $data [] = array(
                 'volforms_date' => date("F j, Y", strtotime($volform->voldatetime)),
                 'volforms_mobiletime' => date("g:ia", strtotime($volform->voldatetime)),
                 'volforms_time' => date("F j, Y g:ia", strtotime($volform->voldatetime)),
                );
            }
          } else {
            $data [] = array(
                'volforms_time' => ''
            );
          }
              
            return response()->json(['status' => true, 'volforms'=>$data, 'volcategories' => $volcatdata]);
            


    }




}
