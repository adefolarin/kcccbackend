<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZipCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ZipCodeController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($zipcodesid = null)
    {
        Session::put("page", "zipcode");

        if($zipcodesid == null) {
          $zipcodes = ZipCode::query()->get()->toArray(); 
          return view('admin.zipcode')->with(compact('zipcodes'));
        } else {
            $zipcodeone = ZipCode::find($zipcodesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $zipcodes = ZipCode::query()->get()->toArray(); 
           return view('admin.zipcode')->with(compact('zipcodes','zipcodeone'));
    
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
        $zipcode = new ZipCode;
    
        $message = "Zip Code added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Product Category Vallidations

                $rules = [
                    'zipcodes_name' => 'required',
                    'zipcodes_price' => 'required',
                ];
                $customMessages = [
                    'zipcodes_name.required' => 'Zip Code is required',
                    'zipcodes_price.required' => 'Price Of Zip Code is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'zipcodes_name' => $data['zipcodes_name'],
                'zipcodes_price' => $data['zipcodes_price'],
                'zipcodes_date' => date("Y-m-d"),
               ]
            ];

              //$zipcodeone = ZipCode::find($data['zipcodes_name']);
              //$zipcodeone = $zipcode->where('zipcodes_name', '=', $data['zipcodes_name'])->first();                           
        
               //echo "<prev>"; print_r($zipcodeone['zipcodes_name']); die;

               if (ZipCode::where('zipcodes_name', $data['zipcodes_name'])->exists()) {
                return redirect('admin/zipcode')->with('error_message', 'Zip Code Already Exists');
               }  else {
                $zipcode->insert($store);
                return redirect('admin/zipcode')->with('success_message', $message);
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
    public function edit($zipcodesid)
    {
        //$zipcodeone = ZipCode::find($zipcodesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.zipcode')->with(compact('zipcodeone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Zip Code updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Zip Code Vallidations
            $rules = [
                'zipcodes_name' => 'required',
                'zipcodes_price' => 'required',
            ];
            $customMessages = [
                'zipcodes_name.required' => 'Zip Code is required',
                'zipcodes_price.required' => 'Price Of Zip Code is required',
            ];
                 

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'zipcodes_name' => $data['zipcodes_name'],
                'zipcodes_price' => $data['zipcodes_price'],
                'zipcodes_date' => date("Y-m-d"),
               
            ];

            if (ZipCode::where('zipcodes_name', $data['zipcodes_name'])->exists()) {
                return redirect('admin/zipcode/'.$data['zipcodes_id'])->with('error_message', 'Zip Code Already Exists');
            }  else {
              ZipCode::where('zipcodes_id',$data['zipcodes_id'])->update($store);
              return redirect('admin/zipcode/'.$data['zipcodes_id'])->with('success_message', $message);
              }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        ZipCode::where('zipcodes_id',$evencategoriesid)->delete();
        return redirect('admin/zipcode')->with('success_message', 'Zip Code deleted successfully');
    }
}
