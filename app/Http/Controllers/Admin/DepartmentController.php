<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DeptCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DepartmentController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($departmentsid = null)
    {
        Session::put("page", "departments");

        $deptcategories = DeptCategory::query()->get()->toArray();

        $departments = DB::table('deptcategories')->orderByDesc('departments_id')->join('departments','deptcategories.deptcategories_id','=', 'departments.deptcategoriesid')->select('departments.*','deptcategories.*')->get()->toArray();

        if($departmentsid == null) {
              
           return view('admin.department')->with(compact('departments','deptcategories'));
           //dd($department); die;
           //echo "<prev>"; print_r($department); die;

        } else {
            $department = new Department;
            $deptcategory = new DeptCategory;
            $departmentone = $department->where('departments_id', $departmentsid)->first();

            $deptcategoryone = $deptcategory->where('deptcategories_id', $departmentone['deptcategoriesid'])->first(); 
            
            //dd($deptcategoryone['deptcategories_name']); die;
            //$department = Department::query()->get()->toArray(); 
             return view('admin.department')->with(compact('departments','departmentone','deptcategoryone','deptcategories'));
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

        $department = new Department;
    
        $message = "Department added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Department Category Vallidations

                $rules = [
                    'deptcategoriesid' => 'required',
                    'departments_content' => 'required',
                    'departments_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                ];
                $customMessages = [
                    'deptcategoriesid.required' => 'Name of Department is required',
                    'departments_content.required' => 'Department Content is required',
                    'departments_file.required' => 'Department File is required',
                    'departments_file.mimes' => "The Image format is not allowed",
                    'departments_file.max' => "Image upload size can't exceed 5MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('departments_file')) {
                $image_tmp = $request->file('departments_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/department/';
                $storePath = public_path('admin/img/departments/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              $store = [
                [
                'deptcategoriesid' => $data['deptcategoriesid'],
                'departments_content' => $data['departments_content'],
                'departments_file' => $fileName,
                'departments_status' => 1,
                'departments_date' => date("Y-m-d"),

               ]
            ];

                $department->insert($store);
                return redirect('admin/department')->with('success_message', $message);
              

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
    public function edit($deptcategoriesid)
    {
        //$deptcategoryone = DeptCategory::find($deptcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.deptcategory')->with(compact('deptcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Department updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'deptcategoriesid' => 'required',
                'departments_content' => 'required',
                'departments_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
            ];
            $customMessages = [
                'deptcategoriesid.required' => 'Name of Department Category is required',
                'departments_content.required' => 'Name of Department Description is required',
                'departments_file.mimes' => "The Image format is not allowed",
                'departments_file.max' => "Image upload size can't exceed 5MB",
            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('departments_file') && !empty($request->file('departments_file'))) {
                $image_tmp = $request->file('departments_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/department/';
                $storePath = public_path('admin/img/departments/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentdepartments_file'];
            }

              $store = [
            
                'deptcategoriesid' => $data['deptcategoriesid'],
                'departments_content' => $data['departments_content'],
                'departments_file' => $fileName,
                'departments_status' => 1,
                'departments_date' => date("Y-m-d"),
               
            ];

              Department::where('departments_id',$data['departments_id'])->update($store);
              return redirect('admin/department/'.$data['departments_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($departmentsid)
    {
        Department::where('departments_id',$departmentsid)->delete();
        return redirect('admin/department')->with('success_message', 'Department deleted successfully');
    }


    public function updateDepartmentFile(Request $request) {
        $message = "Banner File changed succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations

                $rules = [
                'departments_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ];
                 
                $customMessages = [
                    'departments_file.required' => 'Department File is required',
                    'departments_file.mimes' => "The Image format is not allowed",
                    'departments_file.max' => "Image upload size can't exceed 10MB",
                ];
                   
            $this->validate($request,$rules,$customMessages);

                if($request->hasFile('departments_file')) {
                    $image_tmp = $request->file('departments_file');
                    if($image_tmp->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                    $image = $manager->read($image_tmp);
                    //$image = $image->resize(60,60);
        
                    $storePath = 'admin/img/department/';
                    //$image->toJpeg(80)->save($storePath . $imageName);
                    $image->save($storePath . $fileName);
                    
                    
                    
                    }
                } 

              $store = [
                'departments_file' => $fileName,
                'departments_date' => date('Y-m-d'),
               
            ];

            Department::where('departments_id',$data['departments_id'])->update($store);
            return redirect('admin/department/'.$data['departments_id'])->with('success_message', $message);

         }
    }

}
