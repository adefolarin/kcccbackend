<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DonationCategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($donationcategoriesid = null)
    {
        Session::put("page", "donationcategory");

        if($donationcategoriesid == null) {
          $donationcategories = DonationCategory::query()->get()->toArray(); 
          return view('admin.donationcategory')->with(compact('donationcategories'));
        } else {
            $donationcategoryone = DonationCategory::find($donationcategoriesid);
            //$banner = Banner::where('banner_id',$bannerid);
            $donationcategories = DonationCategory::query()->get()->toArray(); 
           return view('admin.donationcategory')->with(compact('donationcategories','donationcategoryone'));
    
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
        $donationcategory = new DonationCategory;
    
        $message = "Donation Category added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Donation Category Vallidations

                $rules = [
                    'donationcategories_name' => 'required',
                ];
                $customMessages = [
                    'donationcategories_name.required' => 'Name of Donation Category is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'donationcategories_name' => $data['donationcategories_name'],
               ]
            ];

              //$donationcategoryone = DonationCategory::find($data['donationcategories_name']);
              //$donationcategoryone = $donationcategory->where('donationcategories_name', '=', $data['donationcategories_name'])->first();                           
        
               //echo "<prev>"; print_r($donationcategoryone['donationcategories_name']); die;

              if (DonationCategory::where('donationcategories_name', $data['donationcategories_name'])->exists()) {
                return redirect('admin/donationcategory')->with('error_message', 'Donation Category Already Exists');
              }  else {
                $donationcategory->insert($store);
                return redirect('admin/donationcategory')->with('success_message', $message);
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
    public function edit($donationcategoriesid)
    {
        //$donationcategoryone = DonationCategory::find($donationcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.donationcategory')->with(compact('donationcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Donation Category updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'donationcategories_name' => 'required',
                ];
            
            $customMessages = [
                'donationcategories_name.required' => 'Name of Donation Category is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'donationcategories_name' => $data['donationcategories_name'],
               
            ];
              if (DonationCategory::where('donationcategories_name', $data['donationcategories_name'])->exists()) {
                return redirect('admin/donationcategory/'.$data['donationcategories_id'])->with('error_message', 'Donation Category Already Exists');
              } else {

              DonationCategory::where('donationcategories_id',$data['donationcategories_id'])->update($store);
              return redirect('admin/donationcategory/'.$data['donationcategories_id'])->with('success_message', $message);
              }

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($evencategoriesid)
    {
        DonationCategory::where('donationcategories_id',$evencategoriesid)->delete();
        return redirect('admin/donationcategory')->with('success_message', 'Donation Category deleted successfully');
    }
}
