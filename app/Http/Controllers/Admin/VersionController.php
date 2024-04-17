<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VersionController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($versionsid = null)
    {
        Session::put("page", "version");

        if($versionsid == null) {
          $versions = Version::query()->get()->toArray(); 
          return view('admin.version')->with(compact('versions'));
        } else {
            $versionone = Version::find($versionsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $versions = Version::query()->get()->toArray(); 
           return view('admin.version')->with(compact('versions','versionone'));
    
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
        //$title = "Banner";
        $version = new Version;
    
        $message = "Version added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Event Category Vallidations

                $rules = [
                    'versions_name' => 'required',
                    'versions_androidnumber' => 'required',
                    'versions_iosnumber' => 'required',
                ];
                $customMessages = [
                    'versions_name.required' => 'Version name is required',
                    'versions_androidnumber.required' => 'Version number is required',
                    'versions_iosnumber.required' => 'Version number is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'versions_name' => $data['versions_name'],
                'versions_androidnumber' => $data['versions_androidnumber'],
                'versions_iosnumber' => $data['versions_iosnumber'],
               ]
            ];

             
                $version->insert($store);
                return redirect('admin/version')->with('success_message', $message);
              

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
    public function edit($versionsid)
    {
        //$versionone = Version::find($versionsid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.version')->with(compact('versionone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Version updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
            $rules = [
                'versions_name' => 'required',
                'versions_androidnumber' => 'required',
                'versions_iosnumber' => 'required',
            ];
            $customMessages = [
                'versions_name.required' => 'Version name is required',
                'versions_androidnumber.required' => 'Version number is required',
                'versions_iosnumber.required' => 'Version number is required',
            ];

            $this->validate($request,$rules,$customMessages);

            $store = [
                
                'versions_name' => $data['versions_name'],
                'versions_androidnumber' => $data['versions_androidnumber'],
                'versions_iosnumber' => $data['versions_iosnumber'],
            ];

              Version::where('versions_id',$data['versions_id'])->update($store);
              return redirect('admin/version/'.$data['versions_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($versionsid)
    {
        Version::where('versions_id',$versionsid)->delete();
        return redirect('admin/version')->with('success_message', 'Version deleted successfully');
    }
}
