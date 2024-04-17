<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\SampleMail;

class VolunteerController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($volunteersid = null)
    {
        Session::put("page", "volunteers");

        if($volunteersid == null) {
          $volunteers = Volunteer::query()->get()->toArray(); 
          return view('admin.volunteer')->with(compact('volunteers'));
        } else {
            $volunteersone = Volunteer::find($volunteersid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = Volunteer::query()->get()->toArray(); 
           return view('admin.volunteer')->with(compact('volunteers','volunteersone'));
    
        }

         
        //dd($CmsPages);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($volunteersid)
    {
        Volunteer::where('volunteers_id',$volunteersid)->delete();
        return redirect('admin/volunteer')->with('success_message', 'Volunteer deleted successfully');
    }
}
