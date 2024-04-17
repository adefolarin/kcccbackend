<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeptMembReg;
use App\Models\DeptCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeptMembRegController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($deptmembregs_dept)
    {
        Session::put("page", "deptmembregs");

          $deptmembregsnumrw = DeptMembReg::query()->count(); 
          if($deptmembregsnumrw > 0) {
            $deptcategoryone = DeptCategory::find($deptmembregs_dept);
            $deptmembregs = DeptMembReg::query()->where('deptmembregs_dept',$deptmembregs_dept)->get()->toArray(); 
            return view('admin.deptmembreg')->with(compact('deptmembregs','deptcategoryone'));
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
    public function edit($eventcategoriesid)
    {
        //$eventcategoryone = DeptMembRegCategory::find($eventcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.eventcategory')->with(compact('eventcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
 
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($deptmembregsid,$deptmembregs_dept)
    {
        DeptMembReg::where('deptmembregs_id',$deptmembregsid)->delete();
        return redirect('admin/deptmembreg/' . $deptmembregs_dept)->with('success_message', 'Member deleted successfully');
    }
}
