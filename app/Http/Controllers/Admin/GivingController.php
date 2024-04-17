<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Giving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\SampleMail;

class GivingController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($givingsid = null)
    {
        Session::put("page", "givings");

        if($givingsid == null) {
          $givings = Giving::query()->get()->toArray(); 
          return view('admin.giving')->with(compact('givings'));
        } else {
            $givingsone = Giving::find($givingsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = Giving::query()->get()->toArray(); 
           return view('admin.giving')->with(compact('givings','givingsone'));
    
        }

         
        //dd($CmsPages);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($givingsid)
    {
        Giving::where('givings_id',$givingsid)->delete();
        return redirect('admin/giving')->with('success_message', 'Giving deleted successfully');
    }
}
