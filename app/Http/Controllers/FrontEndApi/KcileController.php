<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\KcileMail;
use App\Models\Kcile;

class KcileController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($kcilesid = null)
    {
        //Session::put("page", "kciles");

        /*if($eventregsid == null) {
          $eventregs = Kcile::query()->get()->toArray(); 
          return view('admin.eventreg')->with(compact('eventregs'));
        } else {
            $eventregsone = Kcile::find($eventregsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $eventregs = Kcile::query()->get()->toArray(); 
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
    
        $message = "You have successfully applied for the above program";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //dd($data);

            $bodylist = "";

            foreach ($data['selecteditem'] as $value) {
            
                $kciles_time = $value;
                $bodylist .= $kciles_time." | "; 
              
            }

              $store = [
                [
                'kciles_type' => $data['kciles_type'],
                'kciles_name' => $data['kciles_name'],
                'kciles_email' => $data['kciles_email'],
                'kciles_pnum' => $data['kciles_pnum'],
                'kciles_time' => $bodylist,
                'kciles_date' => date("Y-m-d"),

               ]
            ];

               $mailData = [
                'title' => 'Mail from ' . $data['kciles_name'],
                'kciles_type' => $data['kciles_type'],
                'kciles_name' => $data['kciles_name'],
                'kciles_email' => $data['kciles_email'],
                'kciles_pnum' => $data['kciles_pnum'],
                'kciles_time' => $bodylist,
                'kciles_date' => date("Y-m-d"),
               ];

              
                if(Mail::to('adefolarin2017@gmail.com')->send(new KcileMail($mailData))) {
                  Kcile::insert($store);
                  return response()->json(['status' => true, 'message' => $message], 201);
                }
                //return redirect('admin/event')->with('success_message', $message);
              

          }
    }

    public function mobileregmodulestore(Request $request)
    {
    
        $message = "You have successfully registered for the above program";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //dd($data);

            $bodylist = "";

            foreach ($data['kciles_module'] as $value) {
            
                $kciles_coursename = $value['name'];
                $bodylist .= $kciles_coursename." | "; 
              
            }

              $store = [
                [
                'kciles_name' => $data['kciles_name'],
                'kciles_email' => $data['kciles_email'],
                'kciles_gender' => $data['kciles_gender'],
                'kciles_address' => $data['kciles_address'],
                'kciles_country' => $data['kciles_country'],
                'kciles_state' => $data['kciles_state'],
                'kciles_city' => $data['kciles_city'],
                'kciles_zipcode' => $data['kciles_zipcode'],
                'kciles_pnum' => $data['kciles_pnum'],
                'kciles_moduletype' => $data['kciles_moduletype'],
                'kciles_coursename' => $bodylist,
                'kciles_date' => date("Y-m-d"),

               ]
            ];

               $mailData = [
                'title' => 'Mail from ' . $data['kciles_name'],
                'kciles_name' => $data['kciles_name'],
                'kciles_email' => $data['kciles_email'],
                'kciles_gender' => $data['kciles_gender'],
                'kciles_address' => $data['kciles_address'],
                'kciles_country' => $data['kciles_country'],
                'kciles_state' => $data['kciles_state'],
                'kciles_city' => $data['kciles_city'],
                'kciles_zipcode' => $data['kciles_zipcode'],
                'kciles_pnum' => $data['kciles_pnum'],
                'kciles_moduletype' => $data['kciles_moduletype'],
                'kciles_coursename' => $bodylist,
                'kciles_date' => date("Y-m-d"),
               ];

              
                if(Mail::to('adefolarin2017@gmail.com')->send(new KcileMail($mailData))) {
                  //Kcile::insert($store);
                  return response()->json(['status' => true, 'message' => $message], 201);
                }
                //return redirect('admin/event')->with('success_message', $message);
              

          }
    }


    public function mobilestore(Request $request)
    {
    
        $message = "You have successfully submitted your request";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //dd($data);

            $bodylist = "";

            foreach ($data['kciles_module'] as $value) {
            
              $kciles_coursename = $value['name'];
              $bodylist .= $kciles_coursename." | ";  
              
            }

              $store = [
                [
                'kciles_name' => $data['kciles_name'],
                'kciles_email' => $data['kciles_email'],
                'kciles_gender' => $data['kciles_gender'],
                'kciles_address' => $data['kciles_address'],
                'kciles_country' => $data['kciles_country'],
                'kciles_state' => $data['kciles_state'],
                'kciles_city' => $data['kciles_city'],
                'kciles_zipcode' => $data['kciles_zipcode'],
                'kciles_pnum' => $data['kciles_pnum'],
                'kciles_moduletype' => $data['kciles_moduletype'],
                'kciles_coursename' => $bodylist,
                'kciles_date' => date("Y-m-d"),

               ]
            ];

               $mailData = [
                'title' => 'Mail from ' . $data['kciles_name'],
                'kciles_name' => $data['kciles_name'],
                'kciles_email' => $data['kciles_email'],
                'kciles_gender' => $data['kciles_gender'],
                'kciles_address' => $data['kciles_address'],
                'kciles_country' => $data['kciles_country'],
                'kciles_state' => $data['kciles_state'],
                'kciles_city' => $data['kciles_city'],
                'kciles_zipcode' => $data['kciles_zipcode'],
                'kciles_pnum' => $data['kciles_pnum'],
                'kciles_moduletype' => $data['kciles_moduletype'],
                'kciles_coursename' => $bodylist,
                'kciles_date' => date("Y-m-d"),
               ];

              
                if(Mail::to('adefolarin2017@gmail.com')->send(new KcileMail($mailData))) {
                  //Kcile::insert($store);
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
        //$eventcategoryone = KcileCategory::find($eventcategoriesid);
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
