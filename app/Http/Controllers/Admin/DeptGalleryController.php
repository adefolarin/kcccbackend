<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeptGallery;
use App\Models\Department;
use App\Models\DeptCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DeptGalleryController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($deptsid,$deptgalleriesid = null)
    {
        Session::put("page", "deptgalleries");

        $departmentone = Department::find($deptsid);

        $departmentcategoryone = DeptCategory::find($departmentone->deptcategoriesid);

        //$deptgalleries = DeptGallery::query()->get()->toArray();

        $deptgalleriesnumrw = DB::table('deptgalleries')->where('deptsid',$deptsid)
        ->orderByDesc('deptgalleries_id')->count();

        if($deptgalleriesid == null) {
            $deptgalleries = DB::table('deptgalleries')->where('deptsid',$deptsid)
            ->orderByDesc('deptgalleries_id')->get()->toArray();

            if($deptgalleriesnumrw > 0) {
         
             return view('admin.departmentgallery')->with(compact('departmentcategoryone','departmentone','deptgalleries'));
            //dd($depts); die;
            //echo "<prev>"; print_r($depts); die;

            } else {
             return view('admin.departmentgallery')->with(compact('departmentcategoryone','departmentone','deptgalleries')); 
            }
        } else {
            $deptgallerieswan = new DeptGallery;
            $deptgalleriesnumrwone = $deptgallerieswan->where('deptgalleries_id', $deptgalleriesid)->count();

            $deptgalleries = DB::table('deptgalleries')->where('deptsid',$deptsid)->orderByDesc('deptgalleries_id')->get()->toArray();

            if($deptgalleriesnumrwone > 0) {
                $deptgalleriesone = $deptgallerieswan->where('deptgalleries_id', $deptgalleriesid)->first();

                return view('admin.departmentgallery')->with(compact('departmentcategoryone','departmentone','deptgalleriesone','deptgalleries'));
            }

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

        $deptgalleries = new DeptGallery;
    
        $message = "Department Gallery Picture added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // DeptGallery Category Vallidations

                $rules = [
                    'deptgalleries_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                    
                ];
                $customMessages = [
                    'depts_file.required' => 'Name of DeptGallery File is required',
                    'depts_file.mimes' => "The Image format is not allowed",
                    'depts_file.max' => "Image upload size can't exceed 5MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('deptgalleries_file')) {
                $image_tmp = $request->file('deptgalleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/depts/';
                $storePath = public_path('admin/img/departmentgalleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              $store = [
                [
                'deptsid' => $data['depts_id'],
                'deptgalleries_file' => $fileName,

               ]
            ];

                $deptgalleries->insert($store);
                return redirect('admin/departmentgallery/' . $data['depts_id'])->with('success_message', $message);
              

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
        //$deptcategoryone = DeptGalleryCategory::find($deptcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.deptcategory')->with(compact('deptcategoryone'));
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
                'deptgalleries_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
            ];
            $customMessages = [
                'depts_file.mimes' => "The Image format is not allowed",
                'depts_file.max' => "Image upload size can't exceed 5MB",

            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('deptgalleries_file') && !empty($request->file('deptgalleries_file'))) {
                $image_tmp = $request->file('deptgalleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/depts/';
                $storePath = public_path('admin/img/departmentgalleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentdeptgalleries_file'];
            }

              $store = [
                'deptgalleries_file' => $fileName,
               
            ];

              DeptGallery::where('deptgalleries_id',$data['deptgalleries_id'])->update($store);
              return redirect('admin/departmentgallery/'. $data['deptsid'] . '/' . $data['deptgalleries_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($deptsid,$deptgalleriesid)
    {
        DeptGallery::where('deptgalleries_id',$deptgalleriesid)->delete();
        return redirect('admin/departmentgallery/'. $deptsid)->with('success_message', 'Dept Gallery Picture deleted successfully');
    }

}
