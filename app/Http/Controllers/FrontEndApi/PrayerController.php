<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\PrayerMail;
use App\Models\Prayer;

class PrayerController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($eventregsid = null)
    {
        Session::put("page", "eventregs");

        /*if($eventregsid == null) {
          $eventregs = Prayer::query()->get()->toArray(); 
          return view('admin.eventreg')->with(compact('eventregs'));
        } else {
            $eventregsone = Prayer::find($eventregsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = Prayer::query()->get()->toArray(); 
           return view('admin.eventregs')->with(compact('eventregs','eventregsone'));
    
        }*/

         
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
    
        $message = "Prayer Request Sent Successfully";

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
            

              $store = [
                [
                'prayeruser_name' => $data['prayeruser_name'],
                'prayeruser_email' => $data['prayeruser_email'],
                'prayeruser_pnum' => $data['prayeruser_pnum'],
                'prayeruser_request' => $data['prayeruser_request'],
                'prayers_date' => date("Y-m-d"),

               ]
            ];

               $mailData = [
                'title' => 'Mail from ' . $data['prayeruser_name'],
                'prayer_email' => $data['prayeruser_email'],
                'prayer_pnum' => $data['prayeruser_pnum'],
                'prayer_request' => $data['prayeruser_request'],
                'prayer_date' => date("Y-m-d H:i"),
               ];

              
                if(Mail::to('adefolarin2017@gmail.com')->send(new PrayerMail($mailData))) {
                  Prayer::insert($store);
                  return response()->json(['status' => true, 'message' => $message], 201);
                }
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
        //$eventcategoryone = PrayerCategory::find($eventcategoriesid);
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
}
