<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VolForm;
use App\Models\VolCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VolFormController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($volcategoriesid,$volformsid = null)
    {
        Session::put("page", "volcategory");

        $volcategories = VolCategory::query()->get()->toArray();

        $volcategoryone = VolCategory::where('volcategories_id', $volcategoriesid)->first();

        $volforms = DB::table('volcategories')->where('volcategories_id',$volcategoriesid)->orderByDesc('volforms_id')->join('volforms','volcategories.volcategories_id','=', 'volforms.volcategoriesid')->select('volforms.*','volcategories.volcategories_name')->get()->toArray();

        if($volformsid == null) {
              
           return view('admin.volform')->with(compact('volforms','volcategories','volcategoryone'));
           //dd($volforms); die;
           //echo "<prev>"; print_r($volforms); die;

        } else {
            $volform = new VolForm;
            $volcategory = new VolCategory;
        
            $volformone = $volform->where('volforms_id', $volformsid)->first();

            //$volcategoryone = $volcategory->where('volcategories_id', $volformone['volcategoriesid'])->first(); 
            
            //dd($volformone['volcategoriesid']); die;
            //dd($volcategoryone['volcategories_name']); die;
            //if(!empty($volformone['volcategoriesid'])) {
              //echo "<prev>"; print_r($volformone['volcategoriesid']); die;
            //}
            //$volforms = VolForm::query()->get()->toArray(); 
             return view('admin.volform')->with(compact('volforms','volformone','volcategoryone','volcategories'));
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

        $volform = new VolForm;
    
        $message = "Volunter Date and Time added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // VolForm Category Vallidations

                $rules = [
                    'volcategoriesid' => 'required',
                    'voldatetime' => 'required',
                ];
                $customMessages = [
                    'volcategoriesid.required' => 'Volunteer Form Category is required',
                    'voldatetime.required' => 'Volunteer Date and Time is required',
                ];
                     

               $this->validate($request,$rules,$customMessages);

              $store = [
                [
                'volcategoriesid' => $data['volcategoriesid'],
                'voldatetime' => $data['voldatetime'],

               ]
            ];

                $volform->insert($store);
                return redirect('admin/volform/' . $data['volcategoriesid'])->with('success_message', $message);
              

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
    public function edit($volformcategoriesid)
    {
        //$volformcategoryone = VolCategory::find($volformcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.volformcategory')->with(compact('volformcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Volunteer Date and Time updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'volcategoriesid' => 'required',
                'voldatetime' => 'required',
            ];
            $customMessages = [
                'volcategoriesid.required' => 'Volunteer Form Category is required',
                'voldatetime.required' => 'Volunteer Date and Time is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
            
                'volcategoriesid' => $data['volcategoriesid'],
                'voldatetime' => $data['voldatetime'],
               
            ];

              VolForm::where('volforms_id',$data['volforms_id'])->update($store);
              return redirect('admin/volform/'.$data['volcategoriesid'].'/'.$data['volforms_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($volcategoriesid,$volformsid)
    {
        VolForm::where('volforms_id',$volformsid)->delete();
        return redirect('admin/volform/' . $volcategoriesid)->with('success_message', 'Volunteer Date and Time deleted successfully');
    }

}
