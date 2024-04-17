<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeviceTokenController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($devicetokensid = null)
    {
        Session::put("page", "devicetokens");

        if($devicetokensid == null) {
          $devicetokens = DeviceToken::query()->get()->toArray(); 
          return view('admin.devicetoken')->with(compact('devicetokens'));
        } else {
            $devicetokensone = DeviceToken::find($devicetokensid);
            //$banner = Banner::where('banner_id',$bannerid);
            $devicetokens = DeviceToken::query()->get()->toArray(); 
           return view('admin.devicetoken')->with(compact('devicetokens','devicetokensone'));
    
        }

         
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
    public function destroy($devicetokensid)
    {
        DeviceToken::where('devicetokens_id',$devicetokensid)->delete();
        return redirect('admin/devicetoken')->with('success_message', 'Device Token deleted successfully');
    }
}
