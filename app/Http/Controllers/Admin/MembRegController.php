<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembReg;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\SampleMail;

class MembRegController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($membregsid = null)
    {
        Session::put("page", "membregs");

        if($membregsid == null) {
          $membregs = MembReg::query()->get()->toArray(); 
          return view('admin.membreg')->with(compact('membregs'));
        } else {
            $membregsone = MembReg::find($membregsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = MembReg::query()->get()->toArray(); 
           return view('admin.membreg')->with(compact('membregs','membsregsone'));
    
        }

         
        //dd($CmsPages);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($membregsid)
    {
        MembReg::where('membregs_id',$membregsid)->delete();
        return redirect('admin/membreg')->with('success_message', 'Member deleted successfully');
    }
}
