<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($productcategoriesid = null)
    {
        Session::put("page", "productcategory");

        if($productcategoriesid == null) {
          $productcategories = ProductCategory::query()->get()->toArray(); 
          return view('admin.productcategory')->with(compact('productcategories'));
        } else {
            $productcategoryone = ProductCategory::find($productcategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $productcategories = ProductCategory::query()->get()->toArray(); 
           return view('admin.productcategory')->with(compact('productcategories','productcategoryone'));
    
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
        $productcategory = new ProductCategory;
    
        $message = "Product Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Product Category Vallidations

                $rules = [
                    'productcategories_name' => 'required',
                ];
                $customMessages = [
                    'productcategories_name.required' => 'Name of Product Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'productcategories_name' => $data['productcategories_name'],
               ]
            ];

              //$productcategoryone = ProductCategory::find($data['productcategories_name']);
              //$productcategoryone = $productcategory->where('productcategories_name', '=', $data['productcategories_name'])->first();                           
        
               //echo "<prev>"; print_r($productcategoryone['productcategories_name']); die;

            if(ProductCategory::where('productcategories_name', $data['productcategories_name'])->exists()) {
                return redirect('admin/productcategory')->with('error_message', 'Product Category Already Exists');
            }  else {
                $productcategory->insert($store);
                return redirect('admin/productcategory')->with('success_message', $message);
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
    public function edit($productcategoriesid)
    {
        //$productcategoryone = ProductCategory::find($productcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.productcategory')->with(compact('productcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Product Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'productcategories_name' => 'required',
                ];
            
            $customMessages = [
                'productcategories_name.required' => 'Name of Product Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'productcategories_name' => $data['productcategories_name'],
               
            ];

            if(ProductCategory::where('productcategories_name', $data['productcategories_name'])->exists()) {
                return redirect('admin/productcategory/'.$data['productcategories_id'])->with('error_message', 'Product Category Already Exists');
            } else {
              ProductCategory::where('productcategories_id',$data['productcategories_id'])->update($store);
              return redirect('admin/productcategory/'.$data['productcategories_id'])->with('success_message', $message);
            }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        ProductCategory::where('productcategories_id',$evencategoriesid)->delete();
        return redirect('admin/productcategory')->with('success_message', 'Product Category deleted successfully');
    }
}
