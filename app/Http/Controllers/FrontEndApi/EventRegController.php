<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\EventReg;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\EventRegMail;

class EventRegController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($eventregsid = null)
    {
        Session::put("page", "eventregs");

        if($eventregsid == null) {
          $eventregs = EventReg::query()->get()->toArray(); 
          return view('admin.eventreg')->with(compact('eventregs'));
        } else {
            $eventregsone = EventReg::find($eventregsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = EventReg::query()->get()->toArray(); 
           return view('admin.eventregs')->with(compact('eventregs','eventregsone'));
    
        }

         
        //dd($CmsPages);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $eventreg = new EventReg;
    
        $message = "Registration Succesfull";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Event Category Vallidations

               /* $rules = [
                    'eventregs_event' => 'required',
                    'eventregs_name' => 'required',
                    'eventregs_email' => 'required',
                    'eventregs_pnum' => 'required',
                    
                ];
                $customMessages = [
                    'eventregs_event.required' => 'Event ID is required',
                    'eventregs_name.required' => 'Name is required',
                    'eventregs_email.required' => 'Email is required',
                    'eventregs_pnum.required' => 'Phone Number is required',
                ];
                     

               $this->validate($request,$rules,$customMessages);*/
  

               $event = new Event;
               //$eventcategory = new EventCategory;
               //$eventonenumrw = $event->where('events_id', $data['eventregs_event'])->count();
   
               //if($eventonenumrw > 0) {
                 $eventone = $event->where('events_id', $data['eventregs_event'])->first();
               //}
            

              $store = [
                [
                'eventregs_event' => $data['eventregs_event'],
                'eventregs_name' => $data['eventregs_name'],
                'eventregs_email' => $data['eventregs_email'],
                'eventregs_pnum' => $data['eventregs_pnum'],
                'eventregs_date' => date("Y-m-d"),

               ]
            ];

               $mailData = [
                'title' => 'Mail from ' . $data['eventregs_name'],
                'eventname' => $eventone->events_title,
                'body' => 'The above person has registered for the event.'
               ];

              
                if(Mail::to('adefolarin2017@gmail.com')->send(new EventRegMail($mailData))) {
                    $eventreg->insert($store);
                }
                return response()->json(['status' => true, 'message' => $message], 201);
                //return redirect('admin/event')->with('success_message', $message);
              

          }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($eventcategoriesid)
    {
        //$eventcategoryone = EventRegCategory::find($eventcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.eventcategory')->with(compact('eventcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
 
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
