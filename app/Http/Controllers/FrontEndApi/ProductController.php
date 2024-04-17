<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

        $productcategories = ProductCategory::query()->get()->toArray();

        $productsnumrw = DB::table('productcategories')->orderByDesc('products_id')->join('products','productcategories.productcategories_id','=', 'products.productcategoriesid')->select('products.*','productcategories.productcategories_name')->count();

        if($productsid == null) {

            $products = DB::table('productcategories')->orderByDesc('products_id')->join('products','productcategories.productcategories_id','=', 'products.productcategoriesid')->select('products.*','productcategories.productcategories_name')->get();

            if($productsnumrw > 0) {
                foreach($products as $product) {
                   $data [] = array(
                     'products_id' => $product->products_id,
                     'products_name' => $product->products_name,
                     'products_price' => $product->products_price,
                     'products_image' => $product->products_image,
                   );
                }
            } else {
                $data = array(
                   'products_name' => '',
                );
            }
              
            return response()->json(['status' => true, 'products' => $data], 201);

        } else {
            
            $productsnumrw = DB::table('productcategories')->orderByDesc('products_id')->join('products','productcategories.productcategories_id','=', 'products.productcategoriesid')->select('products.*','productcategories.productcategories_name')->count();

            if($productsnumrw > 0) {
                $product = DB::table('productcategories')->orderByDesc('products_id')->join('products','productcategories.productcategories_id','=', 'products.productcategoriesid')->select('products.*','productcategories.productcategories_name')->first();
                   $data = array(
                     'products_id' => $product->products_id,
                     'products_name' => $product->products_name,
                     'products_price' => $product->products_price,
                     'products_image' => $product->products_image,
                   );
                
            } else {
                $data = array(
                   'products_name' => '',
                );
            }
              
            return response()->json(['status' => true, 'productone' => $data], 201);
        }


    }

    public function getProductByCat($productcatid) {

        $productsnumrw = DB::table('productcategories')->orderByDesc('products_id')->join('products','productcategories.productcategories_id','=', 'products.productcategoriesid')->select('products.*','productcategories.productcategories_name')->where('productcategories_id',$productcatid)->count();

        if($productsnumrw > 0) {
            $products = DB::table('productcategories')->orderByDesc('products_id')->join('products','productcategories.productcategories_id','=', 'products.productcategoriesid')->select('products.*','productcategories.productcategories_name')->where('productcategories_id',$productcatid)->get();
            foreach($products as $product) {
               $data [] = array(
                 'products_id' => $product->products_id,
                 'products_name' => $product->products_name,
                 'products_price' => $product->products_price,
                 'products_image' => $product->products_image,
               );
            }
        } else {
            $data = array(
               'products_name' => '',
            );
        }

        $productcatnumrw = DB::table('productcategories')->where('productcategories_id',$productcatid)->count();

        if($productcatnumrw > 0) {
          $productcat = DB::table('productcategories')->where('productcategories_id',$productcatid)->first();

          $productcatdata = array(
             'productcategories_name' => $productcat->productcategories_name,
          );
        } else {
           $productcatdata = array(
                'productcategories_name' => '',
            );
        }
          
        return response()->json(['status' => true, 'products' => $data, 'productcat' => $productcatdata], 201);
       
    }

    public function productLikes(Request $request) {

        $message = "Liked";
  
        if($request->isMethod('post')) {
            $data = $request->all();
  
            $products_id = $data['products_id'];
            $storeusers_id = $data['storeusers_id'];
  
            $countlikes = 1;
  
            $productnumrw = Product::where('products_id', $products_id)->count();
  
            $products = Product::where('products_id', $products_id)->first();

            $prodlikes = ProdLikes::where('storeusersid', $storeusers_id)->first();
  
            if($productnumrw > 0) {
                if($prodlikes->prodlikes_status == "true") {
                    $prodlikes_status = "false";
                } else {
                    $prodlikes_status = "true";
                }
                $products_likes = $products->products_likes + $countlikes;
                ProdLike::where('storeusersid', $storeusers_id)->update(['prodlikes_status' => $prodlikes_status]);
            } else {
                ProdLike::insert(
                    [
                    'storeusersid' => $storeusers_id,
                    'productsid' => $products_id,
                    'prodlikes_status' => $prodlikes,
                    'prodlikes_date' => date("Y-m-d"),

                   ]
              );
            }
  
            Product::where('products_id', $products_id)->update(['products_likes' => $products_likes]);
  
            return response()->json(['status' => true, 'message' => $message], 201);
        }
  
      }


}
