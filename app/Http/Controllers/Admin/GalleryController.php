<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($galleriesid = null)
    {
        Session::put("page", "galleries");

        $galleriescategories = GalleryCategory::query()->get()->toArray();

        $galleries = DB::table('galleriescategories')->orderByDesc('galleries_id')->join('galleries','galleriescategories.galleriescategories_id','=', 'galleries.gallerycategoriesid')->select('galleries.*','galleriescategories.galleriescategories_name')->get()->toArray();

        if($galleriesid == null) {
              
           return view('admin.gallery')->with(compact('galleries','galleriescategories'));
           //dd($galleries); die;
           //echo "<prev>"; print_r($galleries); die;

        } else {
            $gallery = new Gallery;
            $gallerycategory = new GalleryCategory;
            $galleriesone = $gallery->where('galleries_id', $galleriesid)->first();

            $gallerycategoryone = $gallerycategory->where('galleriescategories_id', $galleriesone['gallerycategoriesid'])->first(); 
            
            //dd($gallerycategoryone['galleriescategories_name']); die;
            //$galleries = Gallery::query()->get()->toArray(); 
             return view('admin.gallery')->with(compact('galleries','galleriesone','gallerycategoryone','galleriescategories'));
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

        $gallery = new Gallery;
    
        $message = "Gallery added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Gallery Category Vallidations

                $rules = [
                    'gallerycategoriesid' => 'required',
                    'galleries_title' => 'required',
                    'galleries_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',

                    
                ];
                $customMessages = [
                    'gallerycategoriesid.required' => 'Name of Gallery Category is required',
                    'galleries_title.required' => 'Gallery Title is required',
                    'galleries_file.required' => 'Gallery File is required',
                    'galleries_file.mimes' => "The Image format is not allowed",
                    'galleries_file.max' => "Image upload size can't exceed 5MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('galleries_file')) {
                $image_tmp = $request->file('galleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/galleries/';
                $storePath = public_path('admin/img/galleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              $store = [
                [
                'gallerycategoriesid' => $data['gallerycategoriesid'],
                'galleries_title' => $data['galleries_title'],
                'galleries_file' => $fileName,
                'galleries_date' => date("Y-m-d"),

               ]
            ];

                $gallery->insert($store);
                return redirect('admin/gallery')->with('success_message', $message);
              

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
    public function edit($gallerycategoriesid)
    {
        //$gallerycategoryone = GalleryCategory::find($gallerycategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.gallerycategory')->with(compact('gallerycategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Gallery updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'gallerycategoriesid' => 'required',
                'galleries_title' => 'required',
                'galleries_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',

            ];
            $customMessages = [
                'gallerycategoriesid.required' => 'Name of Gallery Category is required',
                'galleries_title.required' => 'Title of Gallery is required',
                'galleries_file.mimes' => "The Image format is not allowed",
                'galleries_file.max' => "Image upload size can't exceed 5MB",
            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('galleries_file') && !empty($request->file('galleries_file'))) {
                $image_tmp = $request->file('galleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/galleries/';
                $storePath = public_path('admin/img/galleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentgalleries_file'];
            }

              $store = [
            
                'gallerycategoriesid' => $data['gallerycategoriesid'],
                'galleries_title' => $data['galleries_title'],
                'galleries_file' => $fileName,
                'galleries_date' => date("Y-m-d"),
               
            ];

              Gallery::where('galleries_id',$data['galleries_id'])->update($store);
              return redirect('admin/gallery/'.$data['galleries_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($galleriesid)
    {
        Gallery::where('galleries_id',$galleriesid)->delete();
        return redirect('admin/gallery')->with('success_message', 'Gallery deleted successfully');
    }


    public function updateGalleryFile(Request $request) {
        $message = "Banner File changed succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations

                $rules = [
                'galleries_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ];
                 
                $customMessages = [
                    'galleries_file.required' => 'Gallery File is required',
                    'galleries_file.mimes' => "The Image format is not allowed",
                    'galleries_file.max' => "Image upload size can't exceed 10MB",
                ];
                   
            $this->validate($request,$rules,$customMessages);

                if($request->hasFile('galleries_file')) {
                    $image_tmp = $request->file('galleries_file');
                    if($image_tmp->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                    $image = $manager->read($image_tmp);
                    //$image = $image->resize(60,60);
        
                    $storePath = 'admin/img/galleries/';
                    //$image->toJpeg(80)->save($storePath . $imageName);
                    $image->save($storePath . $fileName);
                    
                    
                    
                    }
                } 

              $store = [
                'galleries_file' => $fileName,
                'galleries_date' => date('Y-m-d'),
               
            ];

            Gallery::where('galleries_id',$data['galleries_id'])->update($store);
            return redirect('admin/gallery/'.$data['galleries_id'])->with('success_message', $message);

         }
    }

}
