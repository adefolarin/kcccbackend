<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
//use App\Mail\GivingMail;
use App\Models\Giving;

class GivingController extends Controller
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
    
        $message = "Giving Successfull";

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
                'givings_name' => $data['givingsname'],
                'givings_email' => $data['givingsemail'],
                'givings_pnum' => $data['givingspnum'],
                'givings_type' => $data['givingstype'],
                'givings_amount' => $data['givingsamount'],
                'givings_reference' => $data['givingsreference'],
                'givings_status' => $data['givingsstatus'],
                'givings_date' => date("Y-m-d"),

               ]
            ];

              /* $mailData = [
                'title' => 'Mail from ' . $data['givings_name'],
                'givings_email' => $data['givings_email'],
                'givings_pnum' => $data['givings_pnum'],
                'givings_request' => $data['givings_request'],
                'givings_date' => date("Y-m-d H:i"),
               ];*/

              
               // if(Mail::to('adefolarin2017@gmail.com')->send(new GivingMail($mailData))) {
                  Giving::insert($store);
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
        //$eventcategoryone = GivingCategory::find($eventcategoriesid);
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
