<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PrayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($prayerid = null)
    {
        Session::put("page", "prayers");

        if($prayerid == null) {
          $prayers = Prayer::query()->get()->toArray(); 
          return view('admin.prayer')->with(compact('prayers'));
        } else {
            $prayerone = Prayer::find($prayerid);
            //$banner = Banner::where('banner_id',$bannerid);
            $prayer = Prayer::query()->get()->toArray(); 
           return view('admin.prayer')->with(compact('prayers','prayerone'));
    
        }

         
        //dd($CmsPages);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prayer $prayer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prayer $prayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prayer $prayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($prayerid)
    {
        Prayer::where('prayers_id',$prayerid)->delete();
        return redirect('admin/prayer')->with('success_message', 'Prayer Request deleted successfully');
    }
}
