<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\DeviceToken;

class DeviceTokenController extends Controller
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
    
        //$message = "DeviceToken Request Sent Successfully";

        if($request->isMethod('post')) {
            $data = $request->all();

        
              $store = [
                [
                'tokens_id' => $data['tokens_id'],
               ]
            ];

            if (DeviceToken::where('tokens_id', $data['tokens_id'])->exists()) {
                  DeviceToken::where('tokens_id',$data['tokens_id'])->update(['tokens_id' => $data['tokens_id']]);
                  return response()->json(['status1' => true], 201);
            } else {
                  DeviceToken::insert($store);
                  return response()->json(['status2' => true], 201);
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
