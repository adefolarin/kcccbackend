<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveCountDown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LiveCountDownController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index($livecountdownsid = null)
    {
        Session::put("page", "livecountdown");

        if($livecountdownsid == null) {
          $livecountdowns = LiveCountDown::query()->get()->toArray(); 
          return view('admin.livecountdown')->with(compact('livecountdowns'));
        } else {
            $livecountdownone = LiveCountDown::find($livecountdownsid);
            //$banner = Banner::where('banner_id',$bannerid);
            $livecountdowns = LiveCountDown::query()->get()->toArray(); 
           return view('admin.livecountdown')->with(compact('livecountdowns','livecountdownone'));
    
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
        $livecountdown = new LiveCountDown;
    
        $message = "Count Down added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Event Category Vallidations

                $rules = [
                    'livecountdowns_datetime' => 'required',
                ];
                $customMessages = [
                    'livecountdowns_datetime.required' => 'Count Down Date and Time is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'livecountdowns_datetime' => $data['livecountdowns_datetime'],
               ]
            ];

             
                $livecountdown->insert($store);
                return redirect('admin/livecountdown')->with('success_message', $message);
              

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
    public function edit($livecountdownsid)
    {
        //$livecountdownone = LiveCountDown::find($livecountdownsid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.livecountdown')->with(compact('livecountdownone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Live Count Down updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'livecountdowns_datetime' => 'required',
                ];
            
            $customMessages = [
                'livecountdowns_datetime.required' => 'CountDown Date and Time is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'livecountdowns_datetime' => $data['livecountdowns_datetime'],
               
            ];

              LiveCountDown::where('livecountdowns_id',$data['livecountdowns_id'])->update($store);
              return redirect('admin/livecountdown/'.$data['livecountdowns_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($livecountdownsid)
    {
        LiveCountDown::where('livecountdowns_id',$livecountdownsid)->delete();
        return redirect('admin/livecountdown')->with('success_message', 'Count Down deleted successfully');
    }
}
