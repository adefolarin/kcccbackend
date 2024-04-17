<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\NewsLetterMail;

class NewsLetterController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($eventregsid = null)
    {
        Session::put("page", "eventregs");

        /*if($eventregsid == null) {
          $eventregs = NewsLetter::query()->get()->toArray(); 
          return view('admin.eventreg')->with(compact('eventregs'));
        } else {
            $eventregsone = NewsLetter::find($eventregsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = NewsLetter::query()->get()->toArray(); 
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
    
        $message = "You have successfully subscribed to our news letter";

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
                'newsletter_name' => $data['newsletter_name'],
                'newsletter_email' => $data['newsletter_email'],
                'newsletter_pnum' => $data['newsletter_pnum'],
                'newsletter_subject' => $data['newsletter_subject'],
                'newsletter_message' => $data['newsletter_message'],
                'newsletter_date' => date("Y-m-d"),

               ]
            ];*/

               $mailData = [
                'newsletter_email' => $data['newsletter_email'],
                'newsletter_date' => date("Y-m-d"),
               ];

              
                Mail::to('adefolarin2017@gmail.com')->send(new NewsLetterMail($mailData));
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
        //$eventcategoryone = NewsLetterCategory::find($eventcategoriesid);
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
