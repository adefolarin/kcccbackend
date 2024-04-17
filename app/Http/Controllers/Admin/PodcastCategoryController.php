<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PodcastCategoryController extends Controller
{
        /**s
     * Display a listing of the resource.
     */
    public function index($podcastcategoriesid = null)
    {
        Session::put("page", "podcastcategory");

        if($podcastcategoriesid == null) {
          $podcastcategories = PodcastCategory::query()->get()->toArray(); 
          return view('admin.podcastcategory')->with(compact('podcastcategories'));
        } else {
            $podcastcategoryone = PodcastCategory::find($podcastcategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $podcastcategories = PodcastCategory::query()->get()->toArray(); 
           return view('admin.podcastcategory')->with(compact('podcastcategories','podcastcategoryone'));
    
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
        $podcastcategory = new PodcastCategory;
    
        $message = "Podcast Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Podcast Category Vallidations

                $rules = [
                    'podcastcategories_name' => 'required',
                ];
                $customMessages = [
                    'podcastcategories_name.required' => 'Name of Podcast Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'podcastcategories_name' => $data['podcastcategories_name'],
               ]
            ];

              //$podcastcategoryone = PodcastCategory::find($data['podcastcategories_name']);
              $podcastcategoryone = $podcastcategory->where('podcastcategories_name', '=', $data['podcastcategories_name'])->first();                           
        
               //echo "<prev>"; print_r($podcastcategoryone['podcastcategories_name']); die;

              if($podcastcategoryone['podcastcategories_name'] == $data['podcastcategories_name']) {
                return redirect('admin/podcastcategory')->with('error_message', 'Podcast Category Name Already Exists'); 
              } else {
                $podcastcategory->insert($store);
                return redirect('admin/podcastcategory')->with('success_message', $message);
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
    public function edit($podcastcategoriesid)
    {
        //$podcastcategoryone = PodcastCategory::find($podcastcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.podcastcategory')->with(compact('podcastcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Podcast Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'podcastcategories_name' => 'required',
                ];
            
            $customMessages = [
                'podcastcategories_name.required' => 'Name of Podcast Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'podcastcategories_name' => $data['podcastcategories_name'],
               
            ];

              PodcastCategory::where('podcastcategories_id',$data['podcastcategories_id'])->update($store);
              return redirect('admin/podcastcategory/'.$data['podcastcategories_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        PodcastCategory::where('podcastcategories_id',$evencategoriesid)->delete();
        return redirect('admin/podcastcategory')->with('success_message', 'Podcast Category deleted successfully');
    }
}
