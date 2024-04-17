<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($eventregsid = null)
    {
        Session::put("page", "eventregs");

        /*if($eventregsid == null) {
          $eventregs = Contact::query()->get()->toArray(); 
          return view('admin.eventreg')->with(compact('eventregs'));
        } else {
            $eventregsone = Contact::find($eventregsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = Contact::query()->get()->toArray(); 
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
    
        $message = "Thank You For Contacting US. We Will Get Back To You";

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
            

              /*$store = [
                [
                'contact_name' => $data['contact_name'],
                'contact_email' => $data['contact_email'],
                'contact_pnum' => $data['contact_pnum'],
                'contact_subject' => $data['contact_subject'],
                'contact_message' => $data['contact_message'],
                'contact_date' => date("Y-m-d"),

               ]
            ];*/

               $mailData = [
                'title' => 'Mail from ' . $data['contact_name'],
                'contact_email' => $data['contact_email'],
                'contact_pnum' => $data['contact_pnum'],
                'contact_subject' => $data['contact_subject'],
                'contact_message' => $data['contact_message'],
                'contact_date' => date("Y-m-d H:i"),
               ];

              
                Mail::to('adefolarin2017@gmail.com')->send(new ContactMail($mailData));
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
        //$eventcategoryone = ContactCategory::find($eventcategoriesid);
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
