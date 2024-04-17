<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GalleryCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($gallerycategoriesid = null)
    {
        Session::put("page", "gallerycategory");

        if($gallerycategoriesid == null) {
          $gallerycategories = GalleryCategory::query()->get()->toArray(); 
          return view('admin.gallerycategory')->with(compact('gallerycategories'));
        } else {
            $gallerycategoryone = GalleryCategory::find($gallerycategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $gallerycategories = GalleryCategory::query()->get()->toArray(); 
           return view('admin.gallerycategory')->with(compact('gallerycategories','gallerycategoryone'));
    
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
        $gallerycategory = new GalleryCategory;
    
        $message = "Gallery Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Gallery Category Vallidations

                $rules = [
                    'gallerycategories_name' => 'required',
                ];
                $customMessages = [
                    'gallerycategories_name.required' => 'Name of Gallery Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'gallerycategories_name' => $data['gallerycategories_name'],
               ]
            ];

              //$gallerycategoryone = GalleryCategory::find($data['gallerycategories_name']);
              $gallerycategoryone = $gallerycategory->where('gallerycategories_name', '=', $data['gallerycategories_name'])->first();                           
        
               //echo "<prev>"; print_r($gallerycategoryone['gallerycategories_name']); die;

              if($gallerycategoryone['gallerycategories_name'] == $data['gallerycategories_name']) {
                return redirect('admin/gallerycategory')->with('error_message', 'Gallery Category Name Already Exists'); 
              } else {
                $gallerycategory->insert($store);
                return redirect('admin/gallerycategory')->with('success_message', $message);
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
    public function edit($gallerycategoriesid)
    {
        //$gallerycategoryone = GalleryCategory::find($gallerycategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.gallerycategory')->with(compact('gallerycategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Gallery Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'gallerycategories_name' => 'required',
                ];
            
            $customMessages = [
                'gallerycategories_name.required' => 'Name of Gallery Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'gallerycategories_name' => $data['gallerycategories_name'],
               
            ];

              GalleryCategory::where('gallerycategories_id',$data['gallerycategories_id'])->update($store);
              return redirect('admin/gallerycategory/'.$data['gallerycategories_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        GalleryCategory::where('gallerycategories_id',$evencategoriesid)->delete();
        return redirect('admin/gallerycategory')->with('success_message', 'Gallery Category deleted successfully');
    }
}
