<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($productsid = null)
    {
        Session::put("page", "products");

        $productcategories = ProductCategory::query()->get()->toArray();

        $products = DB::table('productcategories')->orderByDesc('products_id')->join('products','productcategories.productcategories_id','=', 'products.productcategoriesid')->select('products.*','productcategories.productcategories_name')->get()->toArray();

        if($productsid == null) {
              
           return view('admin.product')->with(compact('products','productcategories'));
           //dd($products); die;
           //echo "<prev>"; print_r($products); die;

        } else {
            $product = new Product;
            $productcategory = new ProductCategory;
            $productone = $product->where('products_id', $productsid)->first();

            $productcategoryone = $productcategory->where('productcategories_id', $productone['productcategoriesid'])->first(); 
            
            //dd($productcategoryone['productcategories_name']); die;
            //$products = Product::query()->get()->toArray(); 
             return view('admin.product')->with(compact('products','productone','productcategoryone','productcategories'));
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

        $product = new Product;
    
        $message = "Product added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Product Category Vallidations

                $rules = [
                    'productcategoriesid' => 'required',
                    'products_name' => 'required',
                    'products_description' => 'required',
                    'products_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                    'products_price' => 'required',
                    
                ];
                $customMessages = [
                    'productcategoriesid.required' => 'Name of Product Category is required',
                    'products_name.required' => 'Name of Product is required',
                    'products_description.required' => 'Product Description is required',
                    'products_image.required' => 'Product Image is required',
                    'products_image.mimes' => "The Image format is not allowed",
                    'products_image.max' => "Image upload size can't exceed 5MB",
                    'products_price.required' => 'Product Price is required',
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('products_image')) {
                $image_tmp = $request->file('products_image');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/products/';
                $storePath = public_path('admin/img/products/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 


              $store = [
                [
                'productcategoriesid' => $data['productcategoriesid'],
                'products_name' => $data['products_name'],
                'products_description' => $data['products_description'],
                'products_image' => $fileName,
                'products_price' => $data['products_price'],
                'products_date' => date("Y-m-d"),

               ]
            ];

                $product->insert($store);
                return redirect('admin/product')->with('success_message', $message);
              

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
        $message = "Product updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'productcategoriesid' => 'required',
                'products_name' => 'required',
                'products_description' => 'required',
                'products_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                'products_price' => 'required',
                
            ];
            $customMessages = [
                'productcategoriesid.required' => 'Name of Product Category is required',
                'products_name.required' => 'Name of Product is required',
                'products_description.required' => 'Product Description is required',
                'products_image.mimes' => "The Image format is not allowed",
                'products_image.max' => "Image upload size can't exceed 5MB",
                'products_price.required' => 'Product Price is required',
            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('products_image') && !empty($request->file('products_image'))) {
                $image_tmp = $request->file('products_image');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/products/';
                $storePath = public_path('admin/img/products/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentproducts_file'];
            }

              $store = [
            
                'productcategoriesid' => $data['productcategoriesid'],
                'products_name' => $data['products_name'],
                'products_description' => $data['products_description'],
                'products_image' => $fileName,
                'products_price' => $data['products_price'],
                'products_date' => date("Y-m-d"),
               
            ];

              Product::where('products_id',$data['products_id'])->update($store);
              return redirect('admin/product/'.$data['products_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productsid)
    {
        Product::where('products_id',$productsid)->delete();
        return redirect('admin/product')->with('success_message', 'Product deleted successfully');
    }




}
