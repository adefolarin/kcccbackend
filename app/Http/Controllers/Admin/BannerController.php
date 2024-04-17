<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put("page", "banner");
        $banners = Banner::get()->toArray();  
        //dd($CmsPages);
        return view('admin.banner')->with(compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Session::put("page", "banner");
        return view('admin.banner-add');
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$title = "Banner";
        $banner = new Banner;
        $message = "Banner added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations

            if($data['banner_type'] == 'image') {
                $rules = [
                'banner_type' => 'required',
                'banner_name' => 'required',
                'banner_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                ];
                $customMessages = [
                    'banner_type.required' => 'Banner Type is required',
                    'banner_name.required' => 'Banner Caption is required',
                    'banner_file.required' => 'Banner File is required',
                    'banner_file.mimes' => "The Image format is not allowed",
                    'banner_file.max' => "Image upload size can't exceed 5MB",
                ];
            } else {
                $rules = [
                    'banner_type' => 'required',
                    'banner_name' => 'required',
                    'banner_file' => 'required|mimes:mp4|max:500240',
                ];
                $customMessages = [
                    'banner_type.required' => 'Banner Type is required',
                    'banner_name.required' => 'Banner Caption is required',
                    'banner_file.required' => 'Banner File is required',
                    'banner_file.mimes' => "The video format is not allowed",
                    'banner_file.max' => "Video upload size can't exceed 500MB",
                ];
            }
            
         

            $this->validate($request,$rules,$customMessages);

            if($data['banner_type'] == 'image') {
                if($request->hasFile('banner_file')) {
                    $image_tmp = $request->file('banner_file');
                    if($image_tmp->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                    $image = $manager->read($image_tmp);
                    //$image = $image->resize(60,60);
        
                    $storePath = 'admin/img/banners/';
                    //$image->toJpeg(80)->save($storePath . $imageName);
                    $image->save($storePath . $fileName);
                    
                    
                    
                    }
                } 
             } else if($data['banner_type'] == 'video') {
                if ($request->hasFile('banner_file')) {
                    $videoFile = $request->file('banner_file');
                    $fileName = time() . '.' . $videoFile->getClientOriginalExtension();
                    // Move the uploaded file to the storage directory
                    $videoFile->storeAs('public/admin/videos/banners', $fileName);
                    //$videoFile->storeAs('admin/videos/banners', $fileName);
                    //$videoFile->store()
                 }
            }

              $store = [
                [
                'banner_type' => $data['banner_type'],
                'banner_name' => $data['banner_name'],
                'banner_desc' => $data['banner_desc'],
                'banner_file' => $fileName,
                'banner_date' => date('Y-m-d'),
               ]
            ];

              $banner->insert($store);
              return redirect('admin/banner-add')->with('success_message', $message);

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
    public function edit($bannerid)
    {
        $banner = Banner::find($bannerid);
        //$banner = Banner::where('banner_id',$bannerid);
        return view('admin.banner-edit')->with(compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Banner updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations
                $rules = [
                'banner_type' => 'required',
                'banner_name' => 'required',
                ];
            
            $customMessages = [
                'banner_type.required' => 'Banner Type is required',
                'banner_name.required' => 'Banner Caption is required',
            ];

            $this->validate($request,$rules,$customMessages);

              $store = [
                
                'banner_type' => $data['banner_type'],
                'banner_name' => $data['banner_name'],
                'banner_desc' => $data['banner_desc'],
                'banner_date' => date('Y-m-d'),
               
            ];

              Banner::where('banner_id',$data['banner_id'])->update($store);
              return redirect('admin/banner-edit/'.$data['banner_id'])->with('success_message', $message);

          }   
    }


    public function updateBannerFile(Request $request) {
        $message = "Banner File changed succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations

            if($data['banner_type'] == 'image') {
                $rules = [
                'banner_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ];
                 
                $customMessages = [
                    'banner_file.required' => 'Banner File is required',
                    'banner_file.mimes' => "The Image format is not allowed",
                    'banner_file.max' => "Image upload size can't exceed 10MB",
                ];
            } else {
                $rules = [
                    'banner_file' => 'required|mimes:mp4|max:500240',
                ];
                 
                $customMessages = [
                    'banner_file.required' => 'Banner File is required',
                    'banner_file.mimes' => "The video format is not allowed",
                    'banner_file.max' => "Video upload size can't exceed 10MB",
                ];
            }
           

            $this->validate($request,$rules,$customMessages);

            if($data['banner_type'] == 'image') {
                if($request->hasFile('banner_file')) {
                    $image_tmp = $request->file('banner_file');
                    if($image_tmp->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                    $image = $manager->read($image_tmp);
                    //$image = $image->resize(60,60);
        
                    $storePath = 'admin/img/banners/';
                    //$image->toJpeg(80)->save($storePath . $imageName);
                    $image->save($storePath . $fileName);
                    
                    
                    
                    }
                } 
             } else if($data['banner_type'] == 'video') {
                if ($request->hasFile('banner_file')) {
                    $videoFile = $request->file('banner_file');
                    $fileName = time() . '.' . $videoFile->getClientOriginalExtension();
                    // Move the uploaded file to the storage directory
                    $videoFile->storeAs('public/admin/videos/banners', $fileName);
                    //$videoFile->storeAs('admin/videos/banners', $fileName);
                    //$videoFile->store()
                 }
            }

              $store = [
                'banner_file' => $fileName,
                'banner_date' => date('Y-m-d'),
               
            ];

            Banner::where('banner_id',$data['banner_id'])->update($store);
            return redirect('admin/banner-edit/'.$data['banner_id'])->with('success_message', $message);

         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($banner_id)
    {
        Banner::where('banner_id',$banner_id)->delete();
        return redirect()->back()->with('success_message', 'Banner deleted successfully');
    }
}
