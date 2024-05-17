<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use DB;
//use App\Mail\StoreOrderMail;
use App\Models\StoreOrder;
use App\Models\StoreCart;

class StoreOrderController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($storusersid)
    {

        $storeordersnumrw = DB::table('products')->orderByDesc('storeorders_id')->join('storeorders','products.products_id','=', 'storeorders.productsid')->select('storeorders.*','products.products_name')->where('storeusersid',$storusersid)->count();

        $storeorders = DB::table('products')->orderByDesc('storeorders_id')->join('storeorders','products.products_id','=', 'storeorders.productsid')->select('storeorders.*','products.products_name')->where('storeusersid',$storusersid)->get();


            if($storeordersnumrw > 0) {
                foreach($storeorders as $storeorder) {
                   $data [] = array(
                    'storeusers_id' => $storeorder->storeusersid,
                    'storeorders_refid' => $storeorder->storeorders_refid,
                    'storeorders_price' => $storeorder->storeorders_price,
                    'storeorders_qty' => $storeorder->storeorders_qty,
                    'storeorders_total' => $storeorder->storeorders_total,
                    'storeorders_currency' => $storeorder->storeorders_currency,
                    'storeorders_type' => $storeorder->storeorders_type,
                    'storeorders_status' => $storeorder->storeorder_status,
                    'storeorders_date' => $storeorder->storeorders_date,
                    'logsname' => $storeorder->logsname,
                    'logspnum' => $storeorder->logspnum,
                    'logsemail' => $storeorder->logsemail,
                    'logsgender' => $storeorder->logsgender,
                    'logsstate' => $storeorder->logsstate,
                    'logscountry' => $storeorder->logscountry,
                    'logsaddress' => $storeorder->logsaddress,
                    'logsdelivery' => $storeorder->logdelivery,
                    'logsemail' => $storeorder->logsemail,
                    'logsdate' => $storeorder->logsdate,
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
    public function store($storeusersid,Request $request)
    {
    
        if($request->isMethod('post')) {
            $data = $request->all();
  
              //$storeordersrefid = rand(1000000000,9999999999);

                $storeusersname = $data['storeusers_fname'] . ' ' . $data['storeusers_lname'];

                //$refid = StoreOrder::where('storeordersrefid', $storeordersrefid)->count();
                $storecarts = DB::table('products')->orderByDesc('storecarts_id')->join('storecarts','products.products_id','=', 'storecarts.storeproductsid')->select('storecarts.*','products.products_name')->where('storeusersid',$storeusersid)->get();
                $total = 0;
                foreach($storecarts as $storecart) { 
                  $total = number_format($total + $storecart->storecarts_totalprice,2) ;
                }
   
                foreach($storecarts as $storecart) { 
                  $store = [
                    [
                    'storeusersid' => $data['storeusersid'],
                    'productsid' => $storecart->storeproductsid,
                    'storeorders_refid' => $data['storeorders_refid'],
                    'storeorders_price' => $storecart->storeproductsprice,
                    'storeorders_qty' => $storecart->storecarts_qty,
                    'storeorders_total' => $storecart->storecarts_totalprice,
                    'storeorders_totalall' => $total,
                    'storeorders_currency' => '$',
                    'storeorders_type' => $data['storeorders_type'],
                    'storeorders_status' => $data['storeorders_status'],
                    'storeorders_date' => date("Y-m-d H:i"),
                    'logsname' => $storeusersname,
                    'logspnum' => $data['storeusers_pnum'],
                    'logsemail' => $data['storeusers_email'],
                    'logsgender' => $data['storeusers_gender'],
                    'logsstate' => $data['storeusers_state'],
                    'logscountry' => $data['storeusers_country'],
                    'logsaddress' => $data['storeusers_address'],
                    'logsdelivery' => $data['storeusers_deliv'],
                    'logsdate' => date("Y-m-d"),
    
                   ]
                ];
                   StoreOrder::insert($store);
                }
                StoreCart::where('storeusersid',$storeusersid)
                ->delete();
                return response()->json(['status' => true, 'message' => 'Order placed successfully'], 201); 

              /* $mailData = [
                'title' => 'Mail from ' . $data['storeorders_name'],
                'storeorders_email' => $data['storeorders_email'],
                'storeorders_pnum' => $data['storeorders_pnum'],
                'storeorders_request' => $data['storeorders_request'],
                'storeorders_date' => date("Y-m-d H:i"),
               ];*/

              
               // if(Mail::to('adefolarin2017@gmail.com')->send(new StoreOrderMail($mailData))) {
                 
                //}

              

          }
    }


}
