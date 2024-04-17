<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GivingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GivingCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($givingcategoriesid = null)
    {
        Session::put("page", "givingcategory");

        if($givingcategoriesid == null) {
          $givingcategories = GivingCategory::query()->get()->toArray(); 
          return view('admin.givingcategory')->with(compact('givingcategories'));
        } else {
            $givingcategoryone = GivingCategory::find($givingcategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $givingcategories = GivingCategory::query()->get()->toArray(); 
           return view('admin.givingcategory')->with(compact('givingcategories','givingcategoryone'));
    
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
        $givingcategory = new GivingCategory;
    
        $message = "Giving Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Giving Category Vallidations

                $rules = [
                    'givingcategories_name' => 'required',
                ];
                $customMessages = [
                    'givingcategories_name.required' => 'Name of Giving Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'givingcategories_name' => $data['givingcategories_name'],
               ]
            ];

              //$givingcategoryone = GivingCategory::find($data['givingcategories_name']);
              //$givingcategoryone = $givingcategory->where('givingcategories_name', '=', $data['givingcategories_name'])->first();                           
        
               //echo "<prev>"; print_r($givingcategoryone['givingcategories_name']); die;

               if (GivingCategory::where('givingcategories_name', $data['givingcategories_name'])->exists()) {
                return redirect('admin/givingcategory')->with('error_message', 'Giving Category Already Exists');
              } else {
                $givingcategory->insert($store);
                return redirect('admin/givingcategory')->with('success_message', $message);
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
    public function edit($givingcategoriesid)
    {
        //$givingcategoryone = GivingCategory::find($givingcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.givingcategory')->with(compact('givingcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Giving Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'givingcategories_name' => 'required',
                ];
            
            $customMessages = [
                'givingcategories_name.required' => 'Name of Giving Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'givingcategories_name' => $data['givingcategories_name'],
               
            ];

              if (GivingCategory::where('givingcategories_name', $data['givingcategories_name'])->exists()) {
                return redirect('admin/givingcategory/'.$data['givingcategories_id'])->with('error_message', 'Giving Category Already Exists');
              } else {
              GivingCategory::where('givingcategories_id',$data['givingcategories_id'])->update($store);
              return redirect('admin/givingcategory/'.$data['givingcategories_id'])->with('success_message', $message);
              }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        GivingCategory::where('givingcategories_id',$evencategoriesid)->delete();
        return redirect('admin/givingcategory')->with('success_message', 'Giving Category deleted successfully');
    }
}
