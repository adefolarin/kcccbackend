<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodBankGallery;
use App\Models\FoodBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FoodBankGalleryController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($foodbanksid,$foodbankgalleriesid = null)
    {
        Session::put("page", "foodbankgalleries");

        $foodbankone = FoodBank::find($foodbanksid);

        //$foodbankgalleries = FoodBankGallery::query()->get()->toArray();

        $foodbankgalleriesnumrw = DB::table('foodbankgalleries')->where('foodbanksid',$foodbanksid)->orderByDesc('foodbankgalleries_id')->count();

        if($foodbankgalleriesid == null) {

            $foodbankgalleries = DB::table('foodbankgalleries')->where('foodbanksid',$foodbanksid)->orderByDesc('foodbankgalleries_id')->get()->toArray();

            if($foodbankgalleriesnumrw > 0) {
           
            return view('admin.foodbankgallery')->with(compact('foodbankone','foodbankgalleries'));

            } else {
                return view('admin.foodbankgallery')->with(compact('foodbankone','foodbankgalleries'));
            }
        } else {
            $foodbankgallerieswan = new FoodBankGallery;
            $foodbankgalleriesnumrwone = $foodbankgallerieswan
            ->where('foodbankgalleries_id', $foodbankgalleriesid)->count();

            $foodbankgalleries = DB::table('foodbankgalleries')
            ->where('foodbanksid',$foodbanksid)->orderByDesc('foodbankgalleries_id')->get()->toArray();

            $foodbankgalleriesone = $foodbankgallerieswan
            ->where('foodbankgalleries_id', $foodbankgalleriesid)->first();

            if($foodbankgalleriesnumrwone > 0) {

                return view('admin.foodbankgallery')->with(compact('foodbankone','foodbankgalleriesone','foodbankgalleries'));
            } else {
                return view('admin.foodbankgallery')->with(compact('foodbankone','foodbankgalleriesone','foodbankgalleries'));
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

        $foodbankgalleries = new FoodBankGallery;
    
        $message = "FoodBank Gallery Picture added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // FoodBankGallery Category Vallidations

                $rules = [
                    'foodbankgalleries_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                    
                ];
                $customMessages = [
                    'foodbanks_file.required' => 'Name of FoodBankGallery File is required',
                    'foodbanks_file.mimes' => "The Image format is not allowed",
                    'foodbanks_file.max' => "Image upload size can't exceed 5MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('foodbankgalleries_file')) {
                $image_tmp = $request->file('foodbankgalleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/foodbanks/';
                $storePath = public_path('admin/img/foodbankgalleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              $store = [
                [
                'foodbanksid' => $data['foodbanks_id'],
                'foodbankgalleries_file' => $fileName,

               ]
            ];

                $foodbankgalleries->insert($store);
                return redirect('admin/foodbankgallery/' . $data['foodbanks_id'])->with('success_message', $message);
              

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
        //$foodbankcategoryone = FoodBankGalleryCategory::find($foodbankcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.foodbankcategory')->with(compact('foodbankcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "FoodBank Gallery Picture updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'foodbankgalleries_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
            ];
            $customMessages = [
                'foodbanks_file.mimes' => "The Image format is not allowed",
                'foodbanks_file.max' => "Image upload size can't exceed 5MB",

            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('foodbankgalleries_file') && !empty($request->file('foodbankgalleries_file'))) {
                $image_tmp = $request->file('foodbankgalleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/foodbanks/';
                $storePath = public_path('admin/img/foodbankgalleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentfoodbankgalleries_file'];
            }

              $store = [
                'foodbankgalleries_file' => $fileName,
               
            ];

              FoodBankGallery::where('foodbankgalleries_id',$data['foodbankgalleries_id'])->update($store);
              return redirect('admin/foodbankgallery/'. $data['foodbanksid'] . '/' . $data['foodbankgalleries_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($foodbanksid,$foodbankgalleriesid)
    {
        FoodBankGallery::where('foodbankgalleries_id',$foodbankgalleriesid)->delete();
        return redirect('admin/foodbankgallery/'. $foodbanksid)->with('success_message', 'FoodBank Gallery Picture deleted successfully');
    }

}
