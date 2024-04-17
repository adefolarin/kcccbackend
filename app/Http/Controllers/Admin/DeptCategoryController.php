<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeptCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeptCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($deptcategoriesid = null)
    {
        Session::put("page", "deptcategory");

        if($deptcategoriesid == null) {
          $deptcategories = DeptCategory::query()->get()->toArray(); 
          return view('admin.deptcategory')->with(compact('deptcategories'));
        } else {
            $deptcategoryone = DeptCategory::find($deptcategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $deptcategories = DeptCategory::query()->get()->toArray(); 
           return view('admin.deptcategory')->with(compact('deptcategories','deptcategoryone'));
    
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
        $deptcategory = new DeptCategory;
    
        $message = "Dept Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Dept Category Vallidations

                $rules = [
                    'deptcategories_name' => 'required',
                ];
                $customMessages = [
                    'deptcategories_name.required' => 'Name of Dept Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'deptcategories_name' => $data['deptcategories_name'],
               ]
            ];

              //$deptcategoryone = DeptCategory::find($data['deptcategories_name']);
              //$deptcategoryone = $deptcategory->where('deptcategories_name', '=', $data['deptcategories_name'])->first();                           
        
               //echo "<prev>"; print_r($deptcategoryone['deptcategories_name']); die;

            if (DeptCategory::where('deptcategories_name', $data['deptcategories_name'])->exists()) {
                return redirect('admin/deptcategory')->with('error_message', 'Department Category Already Exists');
            } else {
                $deptcategory->insert($store);
                return redirect('admin/deptcategory')->with('success_message', $message);
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
    public function edit($deptcategoriesid)
    {
        //$deptcategoryone = DeptCategory::find($deptcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.deptcategory')->with(compact('deptcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Dept Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'deptcategories_name' => 'required',
                ];
            
            $customMessages = [
                'deptcategories_name.required' => 'Name of Dept Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'deptcategories_name' => $data['deptcategories_name'],
               
            ];

            if (DeptCategory::where('deptcategories_name', $data['deptcategories_name'])->exists()) {
                return redirect('admin/deptcategory/'.$data['deptcategories_id'])->with('error_message', 'Department Category Already Exists');
            } else {

              DeptCategory::where('deptcategories_id',$data['deptcategories_id'])->update($store);
              return redirect('admin/deptcategory/'.$data['deptcategories_id'])->with('success_message', $message);
            }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        DeptCategory::where('deptcategories_id',$evencategoriesid)->delete();
        return redirect('admin/deptcategory')->with('success_message', 'Dept Category deleted successfully');
    }
}
