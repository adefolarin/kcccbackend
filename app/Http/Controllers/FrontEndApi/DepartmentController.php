<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentGallery;
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
    public function index($deptsid = null)
    {

        //$deptcategories = DepartmentCategory::query()->get();

        //$departments = Department::get();

        $departmentsnumrw = DB::table('deptcategories')->join('departments','deptcategories.deptcategories_id','=', 'departments.deptcategoriesid')->select('departments.*','deptcategories.*')->count();

        if($deptsid == null) {
           
          if($departmentsnumrw > 0) {
            $departments = DB::table('deptcategories')->limit(3)->join('departments','deptcategories.deptcategories_id','=', 'departments.deptcategoriesid')->select('departments.*','deptcategories.*')->get();
            foreach($departments as $department) {
                $data [] = array(
                'departments_id' => $department->departments_id,
                'deptcategories_id' => $department->deptcategories_id,
                'deptcategories_name' => $department->deptcategories_name,
                'departments_content' => $department->departments_content,
                'departments_file' => $department->departments_file,
                'departments_status' => $department->departments_status,
                );
            }
          } else {
            $data [] = array(
                'departments_id' => ''
            );
          }
              
            return response()->json(['departments'=>$data]);

        } else {

            
            $department = new Department;
            //$deptcategory = new DepartmentCategory;
            $departmentonenumrw = $department->where('departments_id', $deptsid)->count();

            if($departmentonenumrw > 0) {
              //$departmentone = $department->where('departments_id', $deptsid)->first();

             $departmentone =  DB::table('deptcategories')->join('departments','deptcategories.deptcategories_id','=', 'departments.deptcategoriesid')->select('departments.*','deptcategories.*')->where('departments_id', $deptsid)->first();

              $data = array(
                'departments_id' => $departmentone->departments_id,
                'deptcategories_id' => $departmentone->deptcategories_id,
                'deptcategories_name' => $departmentone->deptcategories_name,
                'departments_content' => $departmentone->departments_content,
                'departments_file' => $departmentone->departments_file,
                'departments_status' => $departmentone->departments_status,
            );
            } else {
              $data = array(
                 'deptcategoies_name' => ''
              );
            }
        

            //$departmentgallerynumrw = \App\Models\DepartmentCategory::count();
            $departmentgallerynumrw = DB::table('deptgalleries')->where("deptsid", $deptsid)->orderBy("deptsid")->count();

            if($departmentgallerynumrw > 0) {
            $deptgalleries = DB::table('deptgalleries')->where("deptsid", $deptsid)->orderBy("deptsid")->get();

            foreach($deptgalleries as $departmentgallery) {
                $deptgallerydata [] = array(
                'deptsid' => $departmentgallery->deptsid,
                'deptgalleries_file' => $departmentgallery->deptgalleries_file,
                );
            }
           } else {
               $deptgallerydata [] = array(
                  'deptgalleries_file' => ''
               );
           }

            //$deptcategoryone = $deptcategory->where('deptcategories_id', $departmentone['deptcategoriesid'])->first();

           
    
            //date("F j, Y, g:i a", strtotime($page['created_at']))
    

    
            //dd($department); die;
            //echo "<prev>"; print_r($data); die;
    
            return response()->json(['departmentone'=>$data, 'departmentgallery'=>$deptgallerydata]);

            //return with(compact('departments','departmentone','deptcategoryone','deptcategories'));
            
             
        }


    }



    public function getAllDepartment()
    {

        //$deptcategories = DepartmentCategory::query()->get();

        //$departments = Department::get();

        $departmentsnumrw = DB::table('deptcategories')->join('departments','deptcategories.deptcategories_id','=', 'departments.deptcategoriesid')->select('departments.*','deptcategories.*')->count();
           
          if($departmentsnumrw > 0) {
            $departments = DB::table('deptcategories')->join('departments','deptcategories.deptcategories_id','=', 'departments.deptcategoriesid')->select('departments.*','deptcategories.*')->get();
            foreach($departments as $department) {
                $data [] = array(
                'departments_id' => $department->departments_id,
                'deptcategories_id' => $department->deptcategories_id,
                'deptcategories_name' => $department->deptcategories_name,
                'departments_content' => $department->departments_content,
                'departments_file' => $department->departments_file,
                'departments_status' => $department->departments_status,
                );
            }
          } else {
            $data [] = array(
                'departments_id' => ''
            );
          }
              
            return response()->json(['departments'=>$data]);

        } 
 

}
