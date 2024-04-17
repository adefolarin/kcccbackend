<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ResourceController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($resourcesid = null)
    {
        Session::put("page", "resources");

        $resourcecategories = ResourceCategory::query()->get()->toArray();

        $resources = DB::table('resourcecategories')->orderByDesc('resources_id')->join('resources','resourcecategories.resourcecategories_id','=', 'resources.resourcecategoriesid')->select('resources.*','resourcecategories.resourcecategories_name')->get()->toArray();

        if($resourcesid == null) {
              
           return view('admin.resource')->with(compact('resources','resourcecategories'));
           //dd($resources); die;
           //echo "<prev>"; print_r($resources); die;

        } else {
            $resource = new Resource;
            $resourcecategory = new ResourceCategory;
            $resourceone = $resource->where('resources_id', $resourcesid)->first();

            $resourcecategoryone = $resourcecategory->where('resourcecategories_id', $resourceone['resourcecategoriesid'])->first(); 
            
            //dd($resourcecategoryone['resourcecategories_name']); die;
            //$resources = Resource::query()->get()->toArray(); 
             return view('admin.resource')->with(compact('resources','resourceone','resourcecategoryone','resourcecategories'));
        }


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

        $resource = new Resource;
    
        $message = "Resource added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Resource Category Vallidations

   
                $rules = [
                    'resourcecategoriesid' => 'required',
                    'resources_name' => 'required',
                    'resources_file' => 'required|max:50240',
                    
                ];
             
                $customMessages = [
                    'resourcecategoriesid.required' => 'Name of Resource Category is required',
                    'resources_name.required' => 'Resource Title is required',
                    'resources_file.required' => 'The Resource File is required',
                    //'resources_file.mimes' => "The File format is not allowed",
                    'resources_file.max' => "Upload size can't exceed 50MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

                if ($request->hasFile('resources_file')) {
                    $docFile = $request->file('resources_file');
                    $fileName = time() . '.' . $docFile->getClientOriginalExtension();
                    // Move the uploaded file to the storage directory
                    //$videoFile->storeAs('public/admin/videos/banners', $fileName);
                    $docFile->storeAs('public/admin/docs/resources', $fileName);
                    //$videoFile->store()
                 }
              

              $store = [
                [
                'resourcecategoriesid' => $data['resourcecategoriesid'],
                'resources_name' => $data['resources_name'],
                'resources_file' => $fileName,
                'resources_date' => date("Y-m-d"),

               ]
            ];

                $resource->insert($store);
                return redirect('admin/resource')->with('success_message', $message);
              

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
        $message = "Resource updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;
    

                $rules = [
                    'resourcecategoriesid' => 'required',
                    'resources_name' => 'required',
                    'resources_file' => 'max:50240',
                    
                ];
               
                $customMessages = [
                    'resourcecategoriesid.required' => 'Name of Resource Category is required',
                    'resources_name.required' => 'Resource Title is required',
                    //'resources_file.required' => 'The Resource File is required',
                    //'resources_file.mimes' => "The File format is not allowed",
                    'resources_file.max' => "Upload size can't exceed 50MB",
                ];
                     

            $this->validate($request,$rules,$customMessages);

 
                if($request->hasFile('resources_file') && !empty($request->file('resources_file'))) {

                    $docFile = $request->file('resources_file');
                    $fileName = time() . '.' . $docFile->getClientOriginalExtension();
                    // Move the uploaded file to the storage directory
                    //$videoFile->storeAs('public/admin/videos/banners', $fileName);
                    $docFile->storeAs('public/admin/docs/resources', $fileName);
                    //$videoFile->store()
                } else {
                    $fileName = $data['currentresources_file'];
                }
        

              $store = [
            
                'resourcecategoriesid' => $data['resourcecategoriesid'],
                'resources_name' => $data['resources_name'],
                'resources_file' => $fileName,
                'resources_date' => date("Y-m-d"),
               
            ];

              Resource::where('resources_id',$data['resources_id'])->update($store);
              return redirect('admin/resource/'.$data['resources_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($resourcesid)
    {
        Resource::where('resources_id',$resourcesid)->delete();
        return redirect('admin/resource')->with('success_message', 'Resource deleted successfully');
    }


 

}
