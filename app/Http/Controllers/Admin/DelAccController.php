<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\DelAccMail;
use Exception;

class DelAccController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function mobileindex()
    {
      
        return view('admin.delacc');

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
    
        $message = "Request submitted successfully";
        $error_message = "Unable to establish a successful connection";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Event Category Vallidations

               $rules = [
                    'delaccs_name' => 'required',
                    'delaccs_email' => 'required|email',
                    
                ];
                $customMessages = [
                    'delaccs_name.required' => 'Name is required',
                    'delaccs_email.required' => 'Email is required',
                    'delaccs_email.email' => 'email is not valid',
                ];
                     

               $this->validate($request,$rules,$customMessages);
            

              /*$store = [
                [
                'delacc_name' => $data['delacc_name'],
                'delacc_email' => $data['delacc_email'],
                'delacc_pnum' => $data['delacc_pnum'],
                'delacc_subject' => $data['delacc_subject'],
                'delacc_message' => $data['delacc_message'],
                'delacc_date' => date("Y-m-d"),

               ]
            ];*/

               $mailData = [
                'title' => 'Mail from ' . $data['delaccs_name'],
                'delaccs_email' => $data['delaccs_email'],
                'delaccs_name' => $data['delaccs_name'],
                'delaccs_date' => date("Y-m-d H:i"),
               ];

              
               try {
                 Mail::to('adefolarin2017@gmail.com')->send(new DelAccMail($mailData));
                  return redirect('delacc')->with('success_message', $message);
               // } else {
                 // return redirect('delacc')->with('error_message', $error_message);
                //}
               }
               catch(Exception $e) {
                  return redirect('delacc')->with('error_message', $error_message);
               }
              

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
        //$eventcategoryone = DelAccCategory::find($eventcategoriesid);
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
