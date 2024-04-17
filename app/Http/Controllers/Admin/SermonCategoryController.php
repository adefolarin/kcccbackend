<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SermonCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SermonCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($sermoncategoriesid = null)
    {
        Session::put("page", "sermoncategory");

        if($sermoncategoriesid == null) {
          $sermoncategories = SermonCategory::query()->get()->toArray(); 
          return view('admin.sermoncategory')->with(compact('sermoncategories'));
        } else {
            $sermoncategoryone = SermonCategory::find($sermoncategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $sermoncategories = SermonCategory::query()->get()->toArray(); 
           return view('admin.sermoncategory')->with(compact('sermoncategories','sermoncategoryone'));
    
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
        $sermoncategory = new SermonCategory;
    
        $message = "Sermon Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Sermon Category Vallidations

                $rules = [
                    'sermoncategories_name' => 'required',
                ];
                $customMessages = [
                    'sermoncategories_name.required' => 'Name of Sermon Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'sermoncategories_name' => $data['sermoncategories_name'],
               ]
            ];

              //$sermoncategoryone = SermonCategory::find($data['sermoncategories_name']);
              $sermoncategoryone = $sermoncategory->where('sermoncategories_name', '=', $data['sermoncategories_name'])->first();                           
        
               //echo "<prev>"; print_r($sermoncategoryone['sermoncategories_name']); die;

               if (SermonCategory::where('sermoncategories_name', $data['sermoncategories_name'])->exists()) {
                return redirect('admin/sermoncategory')->with('error_message', 'Sermon Category Already Exists');
               }else {
                $sermoncategory->insert($store);
                return redirect('admin/sermoncategory')->with('success_message', $message);
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
    public function edit($sermoncategoriesid)
    {
        //$sermoncategoryone = SermonCategory::find($sermoncategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.sermoncategory')->with(compact('sermoncategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Sermon Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'sermoncategories_name' => 'required',
                ];
            
            $customMessages = [
                'sermoncategories_name.required' => 'Name of Sermon Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'sermoncategories_name' => $data['sermoncategories_name'],
               
            ];

            if (SermonCategory::where('sermoncategories_name', $data['sermoncategories_name'])->exists()) {
                return redirect('admin/sermoncategory/'.$data['sermoncategories_id'])->with('error_message', 'Sermon Category Already Exists');
            }
            else {
              SermonCategory::where('sermoncategories_id',$data['sermoncategories_id'])->update($store);
              return redirect('admin/sermoncategory/'.$data['sermoncategories_id'])->with('success_message', $message);
            }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        SermonCategory::where('sermoncategories_id',$evencategoriesid)->delete();
        return redirect('admin/sermoncategory')->with('success_message', 'Sermon Category deleted successfully');
    }
}
