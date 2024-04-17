<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ResourceCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($resourcecategoriesid = null)
    {
        Session::put("page", "resourcecategory");

        if($resourcecategoriesid == null) {
          $resourcecategories = ResourceCategory::query()->get()->toArray(); 
          return view('admin.resourcecategory')->with(compact('resourcecategories'));
        } else {
            $resourcecategoryone = ResourceCategory::find($resourcecategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $resourcecategories = ResourceCategory::query()->get()->toArray(); 
           return view('admin.resourcecategory')->with(compact('resourcecategories','resourcecategoryone'));
    
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
        $resourcecategory = new ResourceCategory;
    
        $message = "Resource Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Resource Category Vallidations

                $rules = [
                    'resourcecategories_name' => 'required',
                ];
                $customMessages = [
                    'resourcecategories_name.required' => 'Name of Resource Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'resourcecategories_name' => $data['resourcecategories_name'],
               ]
            ];

              //$resourcecategoryone = ResourceCategory::find($data['resourcecategories_name']);
              //$resourcecategoryone = $resourcecategory->where('resourcecategories_name', '=', $data['resourcecategories_name'])->first();                           
        
               //echo "<prev>"; print_r($resourcecategoryone['resourcecategories_name']); die;

               if (ResourceCategory::where('resourcecategories_name', $data['resourcecategories_name'])->exists()) {
                return redirect('admin/resourcecategory')->with('error_message', 'Resource Category Already Exists');
               } else {
                $resourcecategory->insert($store);
                return redirect('admin/resourcecategory')->with('success_message', $message);
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
    public function edit($resourcecategoriesid)
    {
        //$resourcecategoryone = ResourceCategory::find($resourcecategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.resourcecategory')->with(compact('resourcecategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Resource Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'resourcecategories_name' => 'required',
                ];
            
            $customMessages = [
                'resourcecategories_name.required' => 'Name of Resource Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'resourcecategories_name' => $data['resourcecategories_name'],
               
            ];

            if (ResourceCategory::where('resourcecategories_name', $data['resourcecategories_name'])->exists()) {
                return redirect('admin/resourcecategory/'.$data['resourcecategories_id'])->with('error_message', 'Resource Category Already Exists');
            } else { 
              ResourceCategory::where('resourcecategories_id',$data['resourcecategories_id'])->update($store);
              return redirect('admin/resourcecategory/'.$data['resourcecategories_id'])->with('success_message', $message);
            }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        ResourceCategory::where('resourcecategories_id',$evencategoriesid)->delete();
        return redirect('admin/resourcecategory')->with('success_message', 'Resource Category deleted successfully');
    }
}
