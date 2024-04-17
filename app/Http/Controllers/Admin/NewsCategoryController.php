<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($newscategoriesid = null)
    {
        Session::put("page", "newscategory");

        if($newscategoriesid == null) {
          $newscategories = NewsCategory::query()->get()->toArray(); 
          return view('admin.newscategory')->with(compact('newscategories'));
        } else {
            $newscategoryone = NewsCategory::find($newscategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $newscategories = NewsCategory::query()->get()->toArray(); 
           return view('admin.newscategory')->with(compact('newscategories','newscategoryone'));
    
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
        $newscategory = new NewsCategory;
    
        $message = "News Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // News Category Vallidations

                $rules = [
                    'newscategories_name' => 'required',
                ];
                $customMessages = [
                    'newscategories_name.required' => 'Name of News Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'newscategories_name' => $data['newscategories_name'],
               ]
            ];

              //$newscategoryone = NewsCategory::find($data['newscategories_name']);
              //$newscategoryone = $newscategory->where('newscategories_name', '=', $data['newscategories_name'])->first();                           
        
               //echo "<prev>"; print_r($newscategoryone['newscategories_name']); die;

               if (NewsCategory::where('newscategories_name', $data['newscategories_name'])->exists()) {
                return redirect('admin/newscategory')->with('error_message', 'News Category Already Exists');
              } else {
                $newscategory->insert($store);
                return redirect('admin/newscategory')->with('success_message', $message);
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
    public function edit($newscategoriesid)
    {
        //$newscategoryone = NewsCategory::find($newscategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.newscategory')->with(compact('newscategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "News Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'newscategories_name' => 'required',
                ];
            
            $customMessages = [
                'newscategories_name.required' => 'Name of News Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'newscategories_name' => $data['newscategories_name'],
               
            ];

            if (NewsCategory::where('newscategories_name', $data['newscategories_name'])->exists()) {
                return redirect('admin/newscategory/'.$data['newscategories_id'])->with('error_message', 'News Category Already Exists');
            } else { 
              NewsCategory::where('newscategories_id',$data['newscategories_id'])->update($store);
              return redirect('admin/newscategory/'.$data['newscategories_id'])->with('success_message', $message);
            }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        NewsCategory::where('newscategories_id',$evencategoriesid)->delete();
        return redirect('admin/newscategory')->with('success_message', 'News Category deleted successfully');
    }
}
