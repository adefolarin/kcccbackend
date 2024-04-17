<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\VolunteerMail;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($volunteersid = null)
    {
        Session::put("page", "volunteers");

        /*if($eventregsid == null) {
          $eventregs = Volunteer::query()->get()->toArray(); 
          return view('admin.eventreg')->with(compact('eventregs'));
        } else {
            $eventregsone = Volunteer::find($eventregsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = Volunteer::query()->get()->toArray(); 
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
    
        $message = "You have successfully volunteered for the above program";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //dd($data);

            $bodylist = "";

            foreach ($data['selecteditem'] as $value) {
            
                $volunteers_time = $value;
                $bodylist .= $volunteers_time." | "; 
              
            }

              $store = [
                [
                'volunteers_type' => $data['volunteers_type'],
                'volunteers_name' => $data['volunteers_name'],
                'volunteers_email' => $data['volunteers_email'],
                'volunteers_pnum' => $data['volunteers_pnum'],
                'volunteers_time' => $bodylist,
                'volunteers_date' => date("Y-m-d"),

               ]
            ];

               $mailData = [
                'title' => 'Mail from ' . $data['volunteers_name'],
                'volunteers_type' => $data['volunteers_type'],
                'volunteers_name' => $data['volunteers_name'],
                'volunteers_email' => $data['volunteers_email'],
                'volunteers_pnum' => $data['volunteers_pnum'],
                'volunteers_time' => $bodylist,
                'volunteers_date' => date("Y-m-d"),
               ];

              
                if(Mail::to('adefolarin2017@gmail.com')->send(new VolunteerMail($mailData))) {
                  Volunteer::insert($store);
                  return response()->json(['status' => true, 'message' => $message], 201);
                }
                //return redirect('admin/event')->with('success_message', $message);
              

          }
    }

    public function mobilestore(Request $request)
    {
    
        $message = "You have successfully volunteered for the above program";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //dd($data);

            $bodylist = "";

            foreach ($data['selecteditem'] as $value) {
            
                $volunteers_time = $value['voldate'] . " " . $value['voltime'];
                $bodylist .= $volunteers_time." | "; 
              
            }

              $store = [
                [
                'volunteers_type' => $data['volunteers_type'],
                'volunteers_name' => $data['volunteers_name'],
                'volunteers_email' => $data['volunteers_email'],
                'volunteers_pnum' => $data['volunteers_pnum'],
                'volunteers_time' => $bodylist,
                'volunteers_date' => date("Y-m-d"),

               ]
            ];

               $mailData = [
                'title' => 'Mail from ' . $data['volunteers_name'],
                'volunteers_type' => $data['volunteers_type'],
                'volunteers_name' => $data['volunteers_name'],
                'volunteers_email' => $data['volunteers_email'],
                'volunteers_pnum' => $data['volunteers_pnum'],
                'volunteers_time' => $bodylist,
                'volunteers_date' => date("Y-m-d"),
               ];

              
                if(Mail::to('adefolarin2017@gmail.com')->send(new VolunteerMail($mailData))) {
                  Volunteer::insert($store);
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
        //$eventcategoryone = VolunteerCategory::find($eventcategoriesid);
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
