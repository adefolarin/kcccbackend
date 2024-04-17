<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
//use App\Mail\DonationMail;
use App\Models\Donation;

class DonationController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($eventregsid = null)
    {


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
    
        $message = "Donation Successfull";

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
                'donations_name' => $data['donationsname'],
                'donations_email' => $data['donationsemail'],
                'donations_pnum' => $data['donationspnum'],
                'donations_type' => $data['donationstype'],
                'donations_amount' => $data['donationsamount'],
                'donations_reference' => $data['donationsreference'],
                'donations_status' => $data['donationsstatus'],
                'donations_date' => date("Y-m-d"),

               ]
            ];

              /* $mailData = [
                'title' => 'Mail from ' . $data['donations_name'],
                'donations_email' => $data['donations_email'],
                'donations_pnum' => $data['donations_pnum'],
                'donations_request' => $data['donations_request'],
                'donations_date' => date("Y-m-d H:i"),
               ];*/

              
               // if(Mail::to('adefolarin2017@gmail.com')->send(new DonationMail($mailData))) {
                  Donation::insert($store);
                  return response()->json(['status' => true, 'message' => $message], 201);
                //}
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
        //$eventcategoryone = DonationCategory::find($eventcategoriesid);
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
