<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
//use App\Mail\StoreOrderMail;
use App\Models\StoreOrder;

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
                    'logslocation' => $storeorder->logslocation,
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
    public function store(Request $request)
    {
    
        if($request->isMethod('post')) {
            $data = $request->all();
  
            
              $store = [
                [
                'storeusers_id' => $data['storeusersid'],
                'storeorders_refid' => $data['storeordersrefid'],
                'storeorders_price' => $data['storeordersprice'],
                'storeorders_qty' => $data['storeordersqty'],
                'storeorders_total' => $data['storeorderstotal'],
                'storeorders_currency' => $data['storeorderscurrency'],
                'storeorders_type' => $data['storeorderstype'],
                'storeorders_status' => $data['storeorderstatus'],
                'storeorders_date' => date("Y-m-d"),
                'logsname' => $data['logsname'],
                'logspnum' => $data['logspnum'],
                'logsemail' => $data['logsemail'],
                'logsgender' => $data['logsgender'],
                'logslocation' => $data['logslocation'],
                'logsdelivery' => $data['logdelivery'],
                'logsemail' => $data['logsemail'],
                'logsdate' => date("Y-m-d"),

               ]
            ];

              /* $mailData = [
                'title' => 'Mail from ' . $data['storeorders_name'],
                'storeorders_email' => $data['storeorders_email'],
                'storeorders_pnum' => $data['storeorders_pnum'],
                'storeorders_request' => $data['storeorders_request'],
                'storeorders_date' => date("Y-m-d H:i"),
               ];*/

              
               // if(Mail::to('adefolarin2017@gmail.com')->send(new StoreOrderMail($mailData))) {
                  StoreOrder::insert($store);
                  return response()->json(['status' => true], 201);
                //}

              

          }
    }


}
