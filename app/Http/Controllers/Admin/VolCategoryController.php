<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VolCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VolCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($volcategoriesid = null)
    {
        Session::put("page", "volcategory");

        if($volcategoriesid == null) {
          $volcategories = VolCategory::query()->get()->toArray(); 
          return view('admin.volcategory')->with(compact('volcategories'));
        } else {
            $volcategoryone = VolCategory::find($volcategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $volcategories = VolCategory::query()->get()->toArray(); 
           return view('admin.volcategory')->with(compact('volcategories','volcategoryone'));
    
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
        $volcategory = new VolCategory;
    
        $message = "Volunteer Program added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Vol Category Vallidations

                $rules = [
                    'volcategories_name' => 'required',
                ];
                $customMessages = [
                    'volcategories_name.required' => 'Name of Volunteer Program is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'volcategories_name' => $data['volcategories_name'],
               ]
            ];

              //$volcategoryone = VolCategory::find($data['volcategories_name']);

             //$volcategoryone = $volcategory->where('volcategories_name', '=', $data['volcategories_name'])->first();                           
        
               //echo "<prev>"; print_r($volcategoryone['volcategories_name']); die;

              //if(($data['volcategories_name'] != null) && ($volcategoryone['volcategories_name'] == $data['volcategories_name'])) {
                //return redirect('admin/volcategory')->with('error_message', 'Volunteer Program Name Already Exists'); 
              //} else {
                if ($volcategory->where('volcategories_name', $data['volcategories_name'])->exists()) {
                    return redirect('admin/volcategory')->with('error_message', 'Volunteer Program Name Already Exists');
                } else {
                    $volcategory->insert($store);
                    return redirect('admin/volcategory')->with('success_message', $message);
                }
              
              //}

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
    public function edit($volcategoriesid)
    {
        //$volcategoryone = VolCategory::find($volcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.volcategory')->with(compact('volcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Volunteer Program updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'volcategories_name' => 'required',
                ];
            
            $customMessages = [
                'volcategories_name.required' => 'Name of Volunteer Program is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'volcategories_name' => $data['volcategories_name'],
               
            ];

            if (VolCategory::where('volcategories_name', $data['volcategories_name'])->exists()) {
                return redirect('admin/volcategory/' . $data['volcategories_id'])->with('error_message', 'Volunteer Program Name Already Exists');
            } 
             else {
              VolCategory::where('volcategories_id',$data['volcategories_id'])->update($store);
              return redirect('admin/volcategory/'.$data['volcategories_id'])->with('success_message', $message);
             }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        VolCategory::where('volcategories_id',$evencategoriesid)->delete();
        return redirect('admin/volcategory')->with('success_message', 'Volunteer Program deleted successfully');
    }
}
