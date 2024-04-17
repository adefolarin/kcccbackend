<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventReg;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\SampleMail;

class EventRegController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($eventregs_event)
    {
        Session::put("page", "eventregs");

          $eventregsnumrw = EventReg::query()->count(); 
          if($eventregsnumrw > 0) {
            $eventone = Event::find($eventregs_event);
            $eventregs = EventReg::query()->where('eventregs_event',$eventregs_event)->get()->toArray(); 
            return view('admin.eventreg')->with(compact('eventregs','eventone'));
          }


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($eventregsid,$eventregs_event)
    {
        EventReg::where('eventregs_id',$eventregsid)->delete();
        return redirect('admin/eventreg/' . $eventregs_event)->with('success_message', 'Event Participant deleted successfully');
    }
}
