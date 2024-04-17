<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\MembReg;
use App\Mail\MembRegMail;
use Illuminate\Support\Facades\Mail;

class MembRegController extends Controller
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
    
        $message = "Registration Successfull";

        if($request->isMethod('post')) {
            $data = $request->all();

        
              $store = [
                [
                'membregs_name' => $data['membregs_name'],
                'membregs_address' => $data['membregs_address'],
                'membregs_email' => $data['membregs_email'],
                'membregs_pnum' => $data['membregs_pnum'],
                'membregs_gender' => $data['membregs_gender'],
                'membregs_maritalstatus' => $data['membregs_maritalstatus'],
                'membregs_dob' => $data['membregs_dob'],
                'membregs_how' => $data['membregs_how'],
                'membregs_reason' => $data['membregs_reason'],
                'membregs_bornagain' => $data['membregs_bornagain'],
                'membregs_guidance' => $data['membregs_guidance'],
                'membregs_request' => $data['membregs_request'],
                'membregs_updated' => $data['membregs_updated'],
                'membregs_date' => date("Y-m-d")
               ]
              ];

              $mailData = [
                'title' => 'Mail from ' . $data['membregs_name'],
                'membregs_date' => date("Y-m-d"),
                'membregs_name' => $data['membregs_name'],
                'membregs_address' => $data['membregs_address'],
                'membregs_email' => $data['membregs_email'],
                'membregs_pnum' => $data['membregs_pnum'],
                'membregs_gender' => $data['membregs_gender'],
                'membregs_maritalstatus' => $data['membregs_maritalstatus'],
                'membregs_dob' => $data['membregs_dob'],
                'membregs_how' => $data['membregs_how'],
                'membregs_reason' => $data['membregs_reason'],
                'membregs_bornagain' => $data['membregs_bornagain'],
                'membregs_guidance' => $data['membregs_guidance'],
                'membregs_request' => $data['membregs_request'],
                'membregs_updated' => $data['membregs_updated'],
               ];

               if(Mail::to('adefolarin2017@gmail.com')->send(new MembRegMail($mailData))) {
                 MembReg::insert($store);
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
        //$eventcategoryone = DeviceTokenCategory::find($eventcategoriesid);
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
