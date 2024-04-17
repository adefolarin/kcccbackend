<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodBank;
use App\Models\FoodBankCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FoodBankController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($foodbanksid = null)
    {
        Session::put("page", "foodbanks");

        $foodbankcategories = FoodBankCategory::query()->get()->toArray();

        $foodbanks = DB::table('foodbankcategories')->orderByDesc('foodbanks_id')->join('foodbanks','foodbankcategories.foodbankcategories_id','=', 'foodbanks.foodbankcategoriesid')->select('foodbanks.*','foodbankcategories.foodbankcategories_name')->get()->toArray();

        if($foodbanksid == null) {
              
           return view('admin.foodbank')->with(compact('foodbanks','foodbankcategories'));
           //dd($foodbanks); die;
           //echo "<prev>"; print_r($foodbanks); die;

        } else {
            $foodbank = new FoodBank;
            $foodbankcategory = new FoodBankCategory;
            $foodbankone = $foodbank->where('foodbanks_id', $foodbanksid)->first();

            $foodbankcategoryone = $foodbankcategory->where('foodbankcategories_id', $foodbankone['foodbankcategoriesid'])->first(); 
            
            //dd($foodbankcategoryone['foodbankcategories_name']); die;
            //$foodbanks = FoodBank::query()->get()->toArray(); 
             return view('admin.foodbank')->with(compact('foodbanks','foodbankone','foodbankcategoryone','foodbankcategories'));
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

        $foodbank = new FoodBank;
    
        $message = "FoodBank added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // FoodBank Category Vallidations

                $rules = [
                    'foodbankcategoriesid' => 'required',
                    'foodbanks_name' => 'required',
                    'foodbanks_imagefile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                    'foodbanks_videofile' => 'mimes:mp4|max:20240',
                    'foodbanks_date' => 'required',
                ];
                $customMessages = [
                    'foodbankcategoriesid.required' => 'Name of Food Bank Category is required',
                    'foodbanks_name.required' => 'Food Bank name is required',
                    'foodbanks_imagefile.mimes' => "The Image format is not allowed",
                    'foodbanks_imagefile.max' => "Image upload size can't exceed 5MB",
                    'foodbanks_videofile.mimes' => "The Video format is not allowed",
                    'foodbanks_videofile.max' => "Video upload size can't exceed 100MB",
                    'foodbanks_date.required' => 'Food Bank Date is required',
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('foodbanks_imagefile')) {
                $image_tmp = $request->file('foodbanks_imagefile');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/foodbanks/';
                $storePath = public_path('admin/img/foodbanks/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              if ($request->hasFile('foodbanks_videofile')) {
                $videoFile = $request->file('foodbanks_videofile');
                $fileVideoName = time() . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->storeAs('public/admin/videos/foodbanks', $fileVideoName);
              }

              $store = [
                [
                'foodbankcategoriesid' => $data['foodbankcategoriesid'],
                'foodbanks_name' => $data['foodbanks_name'],
                'foodbanks_imagefile' => $fileName,
                'foodbanks_videofile' => $fileVideoName,
                'foodbanks_date' => $data['foodbanks_date'],

               ]
            ];

                $foodbank->insert($store);
                return redirect('admin/foodbank')->with('success_message', $message);
              

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
    public function edit($foodbankcategoriesid)
    {
        //$foodbankcategoryone = FoodBankCategory::find($foodbankcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.foodbankcategory')->with(compact('foodbankcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "FoodBank updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'foodbankcategoriesid' => 'required',
                'foodbanks_name' => 'required',
                'foodbanks_imagefile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                'foodbanks_videofile' => 'mimes:mp4|max:20240',
                'foodbanks_date' => 'required',
            ];
            $customMessages = [
                'foodbankcategoriesid.required' => 'Name of Food Bank Category is required',
                'foodbanks_name.required' => 'Food Bank name is required',
                'foodbanks_imagefile.mimes' => "The Image format is not allowed",
                'foodbanks_imagefile.max' => "Image upload size can't exceed 5MB",
                'foodbanks_videofile.mimes' => "The Video format is not allowed",
                'foodbanks_videofile.max' => "Video upload size can't exceed 100MB",
                'foodbanks_date.required' => 'Food Bank Date is required',
            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('foodbanks_imagefile') && !empty($request->file('foodbanks_imagefile'))) {
                $image_tmp = $request->file('foodbanks_imagefile');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/foodbanks/';
                $storePath = public_path('admin/img/foodbanks/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentfoodbanks_imagefile'];
            }


            if($request->hasFile('foodbanks_videofile') && !empty($request->file('foodbanks_videofile'))) {
                $videoFile = $request->file('foodbanks_videofile');
                $fileVideoName = time() . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->storeAs('public/admin/videos/foodbanks', $fileVideoName);
                } else {
                    $fileVideoName = $data['currentfoodbanks_videofile'];
                }

              $store = [
            
                'foodbankcategoriesid' => $data['foodbankcategoriesid'],
                'foodbanks_name' => $data['foodbanks_name'],
                'foodbanks_imagefile' => $fileName,
                'foodbanks_videofile' => $fileVideoName,
                'foodbanks_date' => $data['foodbanks_date'],
               
            ];

              FoodBank::where('foodbanks_id',$data['foodbanks_id'])->update($store);
              return redirect('admin/foodbank/'.$data['foodbanks_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($foodbanksid)
    {
        FoodBank::where('foodbanks_id',$foodbanksid)->delete();
        return redirect('admin/foodbank')->with('success_message', 'Food Bank deleted successfully');
    }



}
