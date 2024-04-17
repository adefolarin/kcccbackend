<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\DeptMembReg;
use App\Models\Department;
use App\Models\DeptCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\DeptRegMail;


class DeptMembRegController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($deptmembregs_dept)
    {


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

        $deptmembreg = new DeptMembReg;
    
        $message = "Registration Succesfull";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Department Category Vallidations

               /* $rules = [
                    'deptmembregs_department' => 'required',
                    'deptmembregs_name' => 'required',
                    'deptmembregs_email' => 'required',
                    'deptmembregs_pnum' => 'required',
                    
                ];
                $customMessages = [
                    'deptmembregs_department.required' => 'Department ID is required',
                    'deptmembregs_name.required' => 'Name is required',
                    'deptmembregs_email.required' => 'Email is required',
                    'deptmembregs_pnum.required' => 'Phone Number is required',
                ];
                     

               $this->validate($request,$rules,$customMessages);*/
  

               //$department = new Department;
               $deptcategory = new DeptCategory;
               //$deptcategoryonenumrw = $deptcategory->where('deptcategories_id', $data['deptmembregs_dept'])->count();
   
               //if($deptcategoryonenumrw > 0) {
                 $deptcategoryone = $deptcategory->where('deptcategories_id', $data['deptmembregs_dept'])->first();
               //}
            

              $store = [
                [
                'deptmembregs_dept' => $data['deptmembregs_dept'],
                'deptmembregs_name' => $data['deptmembregs_name'],
                'deptmembregs_email' => $data['deptmembregs_email'],
                'deptmembregs_pnum' => $data['deptmembregs_pnum'],
                'deptmembregs_date' => date("Y-m-d"),

               ]
            ];

               $mailData = [
                'title' => 'Mail from ' . $data['deptmembregs_name'],
                'deptcategories_name' => $deptcategoryone->deptcategories_name,
                'body' => 'The above person has registered for the department.'
               ];

              
                if(Mail::to('adefolarin2017@gmail.com')->send(new DeptRegMail($mailData))) {
                    $deptmembreg->insert($store);
                }
                return response()->json(['status' => true, 'message' => $message], 201);
                //return redirect('admin/department')->with('success_message', $message);
              

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
    public function edit($departmentcategoriesid)
    {
        //$departmentcategoryone = DeptMembRegCategory::find($departmentcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.departmentcategory')->with(compact('departmentcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
 
    }



}
