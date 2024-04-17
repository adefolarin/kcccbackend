<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeptCategory;
use App\Models\DepartmentGallery;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DepartmentGalleryController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($departmentsid,$departmentgalleriesid = null)
    {
        Session::put("page", "departmentgalleries");


        $department = new Department;
        $deptcategory = new DeptCategory;
        $deptone = $department->where('departments_id', $departmentsid)->first();

        $deptcategoryone = $deptcategory->where('deptcategories_id', $deptone['deptcategoriesid'])->first();

        $departmentone = Department::find($departmentsid);

        //$departmentgalleries = DepartmentGallery::query()->get()->toArray();

        $departmentgalleries = DB::table('departmentgalleries')->where($departmentsid)->orderByDesc('departmentgalleries_id')->get()->toArray();

        if($departmentgalleriesid == null) {
              
           return view('admin.departmentgallery/' . $departmentsid)->with(compact('departmentone','departmentgalleries','deptcategoryone'));
           //dd($departments); die;
           //echo "<prev>"; print_r($departments); die;

        } else {
            $departmentgallerieswan = new DepartmentGallery;
            $departmentgalleriesone = $departmentgallerieswan->where('departmentgalleries_id', $departmentgalleriesid)->first();

            
            //dd($departmentcategoryone['departmentcategories_name']); die;
            //$departments = DepartmentGallery::query()->get()->toArray(); 
             return view('admin.departmentgallery/' . $departmentsid)->with(compact('departmentone','departmentgalleriesone','departmentgalleries','deptcategoryone'));
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

        $departmentgalleries = new DepartmentGallery;
    
        $message = "Department Gallery Picture added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // DepartmentGallery Category Vallidations

                $rules = [
                    'departmentgalleries_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                    
                ];
                $customMessages = [
                    'departments_file.required' => 'Name of DepartmentGallery File is required',
                    'departments_file.mimes' => "The Image format is not allowed",
                    'departments_file.max' => "Image upload size can't exceed 5MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('departmentgalleries_file')) {
                $image_tmp = $request->file('departmentgalleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/departments/';
                $storePath = public_path('admin/img/departmentgalleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              $store = [
                [
                'depts_id' => $data['depts_id'],
                'departmentgalleries_file' => $fileName,

               ]
            ];

                $departmentgalleries->insert($store);
                return redirect('admin/departmentgallery/' . $data['departmentsid'])->with('success_message', $message);
              

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
        //$departmentcategoryone = DepartmentGalleryCategory::find($departmentcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.departmentcategory')->with(compact('departmentcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Department Gallery Picture updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'departmentgalleries_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
            ];
            $customMessages = [
                'departments_file.mimes' => "The Image format is not allowed",
                'departments_file.max' => "Image upload size can't exceed 5MB",

            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('departmentgalleries_file') && !empty($request->file('departmentgalleries_file'))) {
                $image_tmp = $request->file('departmentgalleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/departments/';
                $storePath = public_path('admin/img/galleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentdepartmentgalleries_file'];
            }

              $store = [
                'departmentgalleries_file' => $fileName,
               
            ];

              DepartmentGallery::where('deptgalleries_id',$data['deptgalleries_id'])->update($store);
              return redirect('admin/departmentgallery/'. $data['depts_id'] . '/' . $data['deptgalleries_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($departmentsid,$departmentgalleriesid)
    {
        DepartmentGallery::where('departmentgalleries_id',$departmentgalleriesid)->delete();
        return redirect('admin/departmentgallery/'. $departmentsid)->with('success_message', 'Department Gallery Picture deleted successfully');
    }

}
