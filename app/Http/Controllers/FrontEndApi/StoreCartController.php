<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use DB;
//use App\Mail\StoreCartMail;
use App\Models\StoreCart;

class StoreCartController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($storusersid)
    {

        $storecartsnumrw = DB::table('products')->orderByDesc('storecarts_id')->join('storecarts','products.products_id','=', 'storecarts.productsid')->select('storecarts.*','products.products_name')->where('storeusersid',$storusersid)->count();

        $storecarts = DB::table('products')->orderByDesc('storecarts_id')->join('storecarts','products.products_id','=', 'storecarts.productsid')->select('storecarts.*','products.products_name')->where('storeusersid',$storusersid)->get();


            if($storecartsnumrw > 0) {
                foreach($storecarts as $storecart) {
                   $data [] = array(
                    'storeusers_id' => $storecart->storeusersid,
                    'storecarts_refid' => $storecart->storecarts_refid,
                    'storecarts_price' => $storecart->storecarts_price,
                    'storecarts_qty' => $storecart->storecarts_qty,
                    'storecarts_total' => $storecart->storecarts_total,
                    'storecarts_currency' => $storecart->storecarts_currency,
                    'storecarts_type' => $storecart->storecarts_type,
                    'storecarts_status' => $storecart->storecart_status,
                    'storecarts_date' => $storecart->storecarts_date,
                    'logsname' => $storecart->logsname,
                    'logspnum' => $storecart->logspnum,
                    'logsemail' => $storecart->logsemail,
                    'logsgender' => $storecart->logsgender,
                    'logslocation' => $storecart->logslocation,
                    'logsdelivery' => $storecart->logdelivery,
                    'logsemail' => $storecart->logsemail,
                    'logsdate' => $storecart->logsdate,
                   );
                }
            } else {
                $data = array(
                   'storeusers_refid' => '',
                );
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
    
        if($request->isMethod('post')) {
            $data = $request->all();

            $message = "Product Added To Cart";

            $storeusersid = $data['storeusersid'];
            $storeproductsid = $data['storeproductsid'];
            $storecartsqty = $data['storecartsqty'];
  
            $storecartsnumrw = DB::table('storecarts')
            ->where('storeusersid',$storeusersid)
            ->where('storeproductsid',$storeproductsid)
            ->count();
              

             if($storecartsnumrw > 0) {
                $storecarts = DB::table('storecarts')
                ->where('storeusersid',$storeusersid)
                ->where('storeproductsid',$storeproductsid)
                ->first();
    
                $storecartsqty = $storecarts->storecarts_qty + $data['storecartsqty'];
                $storecarts_totalprice = $storecartsqty * $data['storeproductsprice'];


               StoreCart::where('storeusersid',$data['storeusersid'])
               ->where('storeproductsid',$storeproductsid)
               ->update(
                [
                    'storeusersid' => $storeusersid,
                    'storeproductsid' => $storeproductsid,
                    'storecarts_qty' => $storecartsqty,
                    'storeproductsprice' => $data['storeproductsprice'],
                    'storecarts_totalprice' => $storecarts_totalprice,
                    'storecarts_date' => date("Y-m-d"),
                   ]
               );
               return response()->json(['status' => true, 'message' => $message], 201);

             } else {

                $storecartsqty = $data['storecartsqty'];
                $storecarts_totalprice = $storecartsqty * $data['storeproductsprice'];

                $store = [
                    [
                    'storeusersid' => $storeusersid,
                    'storeproductsid' => $storeproductsid,
                    'storecarts_qty' => $storecartsqty,
                    'storeproductsprice' => $data['storeproductsprice'],
                    'storecarts_totalprice' => $storecarts_totalprice,
                    'storecarts_date' => date("Y-m-d"),
                   ]
               ];
                  StoreCart::insert($store);
                  return response()->json(['status' => true, 'message' => $message], 201);
             }
              

          }
    }


    public function updateone(Request $request)
    {
    
        if($request->isMethod('post')) {
            $data = $request->all();

            $message = "Cart Updated Successfully";

            $storeusersid = $data['storeusersid'];
            $storeproductsid = $data['storeproductsid'];
            $storecartsqty = $data['storecartsqty'];
            $storeusersid = $data['storeusersid'];
  
            $storecartsnumrw = DB::table('storecarts')
            ->where('storeusersid',$storeusersid)
            ->where('storeproductsid',$storeproductsid)
            ->count();
              

             if($storecartsnumrw > 0) {
                $storecarts = DB::table('storecarts')
                ->where('storeusersid',$storeusersid)
                ->where('storeproductsid',$storeproductsid)
                ->first();
    
                $storecartsqty = $data['storecartsqty'];
                $storecarts_totalprice = $storecartsqty * $data['storeproductsprice'];


               StoreCart::where('storeusersid',$data['storeusersid'])
               ->where('storeproductsid',$storeproductsid)
               ->update(
                [
                    'storeusersid' => $storeusersid,
                    'storeproductsid' => $storeproductsid,
                    'storecarts_qty' => $storecartsqty,
                    'storeproductsprice' => $data['storeproductsprice'],
                    'storecarts_totalprice' => $storecarts_totalprice,
                    'storecarts_date' => date("Y-m-d"),
                   ]
               );
               return response()->json(['status' => true, 'message' => $message], 201);

             } 
              

          }
    }


    public function destroyone(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $storecartsid = $data['storecartsid'];
            StoreCart::where('storecarts_id',$storecartsid)->delete();
            return response()->json(['status' => true, 'message' => "Product Removed From Cart Successfully"], 201);
        }
    }

    public function destroyall(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $storeusersid = $data['storeusersid'];
            StoreCart::where('storeusersid',$storeusersid)
            ->delete();
            return response()->json(['status' => true, 'message' => "Cart Emptied Successfully"], 201);
        }
    
    }




}
