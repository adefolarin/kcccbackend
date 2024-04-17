<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodBankCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FoodBankCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($foodbankcategoriesid = null)
    {
        Session::put("page", "foodbankcategory");

        if($foodbankcategoriesid == null) {
          $foodbankcategories = FoodBankCategory::query()->get()->toArray(); 
          return view('admin.foodbankcategory')->with(compact('foodbankcategories'));
        } else {
            $foodbankcategoryone = FoodBankCategory::find($foodbankcategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $foodbankcategories = FoodBankCategory::query()->get()->toArray(); 
           return view('admin.foodbankcategory')->with(compact('foodbankcategories','foodbankcategoryone'));
    
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
        $foodbankcategory = new FoodBankCategory;
    
        $message = "FoodBank Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // FoodBank Category Vallidations

                $rules = [
                    'foodbankcategories_name' => 'required',
                ];
                $customMessages = [
                    'foodbankcategories_name.required' => 'Name of FoodBank Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'foodbankcategories_name' => $data['foodbankcategories_name'],
               ]
            ];

              //$foodbankcategoryone = FoodBankCategory::find($data['foodbankcategories_name']);
              //$foodbankcategoryone = $foodbankcategory->where('foodbankcategories_name', '=', $data['foodbankcategories_name'])->first();                           
        
               //echo "<prev>"; print_r($foodbankcategoryone['foodbankcategories_name']); die;

               if (FoodBankCategory::where('foodbankcategories_name', $data['foodbankcategories_name'])->exists()) {
                return redirect('admin/foodbankcategory')->with('error_message', 'Food Bank Category Already Exists');
              }  else {
                $foodbankcategory->insert($store);
                return redirect('admin/foodbankcategory')->with('success_message', $message);
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
    public function edit($foodbankcategoriesid)
    {
        //$foodbankcategoryone = FoodBankCategory::find($foodbankcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.foodbankcategory')->with(compact('foodbankcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "FoodBank Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'foodbankcategories_name' => 'required',
                ];
            
            $customMessages = [
                'foodbankcategories_name.required' => 'Name of FoodBank Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'foodbankcategories_name' => $data['foodbankcategories_name'],
               
            ];

             if (FoodBankCategory::where('foodbankcategories_name', $data['foodbankcategories_name'])->exists()) {
                return redirect('admin/foodbankcategory/'.$data['foodbankcategories_id'])->with('error_message', 'Food Bank Category Already Exists');
              } else {
              FoodBankCategory::where('foodbankcategories_id',$data['foodbankcategories_id'])->update($store);
              return redirect('admin/foodbankcategory/'.$data['foodbankcategories_id'])->with('success_message', $message);
              }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        FoodBankCategory::where('foodbankcategories_id',$evencategoriesid)->delete();
        return redirect('admin/foodbankcategory')->with('success_message', 'FoodBank Category deleted successfully');
    }
}
