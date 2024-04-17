<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\SermonCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SermonController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($sermonsid = null)
    {
        Session::put("page", "sermons");

        $sermoncategories = SermonCategory::query()->get()->toArray();

        $sermons = DB::table('sermoncategories')->orderByDesc('sermons_id')->join('sermons','sermoncategories.sermoncategories_id','=', 'sermons.sermoncategoriesid')->select('sermons.*','sermoncategories.sermoncategories_name')->get()->toArray();

        if($sermonsid == null) {
              
           return view('admin.sermon')->with(compact('sermons','sermoncategories'));
           //dd($sermons); die;
           //echo "<prev>"; print_r($sermons); die;

        } else {
            $sermon = new Sermon;
            $sermoncategory = new SermonCategory;
            $sermonone = $sermon->where('sermons_id', $sermonsid)->first();

            $sermoncategoryone = $sermoncategory->where('sermoncategories_id', $sermonone['sermoncategoriesid'])->first(); 
            
            //dd($sermoncategoryone['sermoncategories_name']); die;
            //$sermons = Sermon::query()->get()->toArray(); 
             return view('admin.sermon')->with(compact('sermons','sermonone','sermoncategoryone','sermoncategories'));
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

        $sermon = new Sermon;
    
        $message = "Sermon added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Sermon Category Vallidations

             if($data['sermons_filetype'] == 'local') {
                $rules = [
                    'sermoncategoriesid' => 'required',
                    'sermons_title' => 'required',
                    'sermons_filetype' => 'required',
                    'sermons_videofile' => 'required|mimes:mp4|max:500240',
                    'sermons_location' => 'required',
                    'sermons_preacher' => 'required',
                    'sermons_date' => 'required',
                    
                ];
               } else if($data['sermons_filetype'] == 'remote') {
                    $rules = [
                        'sermoncategoriesid' => 'required',
                        'sermons_title' => 'required',
                        'sermons_filetype' => 'required',
                        'sermons_urlfile' => 'required',
                        'sermons_location' => 'required',
                        'sermons_preacher' => 'required',
                        'sermons_date' => 'required',
                        
                    ];
               }
                $customMessages = [
                    'sermoncategoriesid.required' => 'Name of Sermon Category is required',
                    'sermons_title.required' => 'Sermon Title is required',
                    'sermons_filetype.required' => 'File Type is required',
                    'sermons_videofile.required' => 'The Sermon Video File is required',
                    'sermons_videofile.mimes' => "The Video format is not allowed",
                    'sermons_videofile.max' => "Video upload size can't exceed 500MB",
                    'sermons_urlfile' => "Sermon URL is required",
                    'sermons_location.required' => 'Location of Sermon is required',
                    'sermons_preacher.required' => 'Name of Preacher is required',
                    'sermons_date.required' => 'Date when sermon was preached is required',
                ];
                     

               $this->validate($request,$rules,$customMessages);

               /*if($data['sermons_filetype'] == 'local') {
                if ($request->hasFile('sermons_videofile')) {
                    $videoFile = $request->file('sermons_videofile');
                    $fileName = time() . '_' . $videoFile->getClientOriginalExtension();
                    $videoFile->storeAs('admin/videos/sermons', $fileName);
                 }
                }*/
                if($data['sermons_filetype'] == 'remote') {
                    $fileName = $data['sermons_urlfile'];
                }

              $store = [
                [
                'sermoncategoriesid' => $data['sermoncategoriesid'],
                'sermons_title' => $data['sermons_title'],
                'sermons_filetype' => $data['sermons_filetype'],
                'sermons_file' => $fileName,
                'sermons_location' => $data['sermons_location'],
                'sermons_preacher' => $data['sermons_preacher'],
                'sermons_likes' => 0,
                'sermons_shares' => 0,
                'sermons_date' => $data['sermons_date'],

               ]
            ];

                $sermon->insert($store);
                return redirect('admin/sermon')->with('success_message', $message);
              

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
    public function edit($sermoncategoriesid)
    {
        //$sermoncategoryone = SermonCategory::find($sermoncategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.sermoncategory')->with(compact('sermoncategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Sermon updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;
    
            if($data['sermons_filetype'] == 'local') {
                $rules = [
                    'sermoncategoriesid' => 'required',
                    'sermons_title' => 'required',
                    'sermons_filetype' => 'required',
                    'sermons_videofile' => 'required|mimes:mp4|max:500240',
                    'sermons_location' => 'required',
                    'sermons_preacher' => 'required',
                    'sermons_date' => 'required',
                    
                ];
               } else if($data['sermons_filetype'] == 'remote') {
                    $rules = [
                        'sermoncategoriesid' => 'required',
                        'sermons_title' => 'required',
                        'sermons_filetype' => 'required',
                        'sermons_urlfile' => 'required',
                        'sermons_location' => 'required',
                        'sermons_preacher' => 'required',
                        'sermons_date' => 'required',
                        
                    ];
               }
                $customMessages = [
                    'sermoncategoriesid.required' => 'Name of Sermon Category is required',
                    'sermons_title.required' => 'Sermon Title is required',
                    'sermons_filetype.required' => 'File Type is required',
                    'sermons_videofile.required' => 'The Sermon Video File is required',
                    'sermons_videofile.mimes' => "The Video format is not allowed",
                    'sermons_videofile.max' => "Video upload size can't exceed 500MB",
                    'sermons_urlfile' => "Sermon URL is required",
                    'sermons_location.required' => 'Location of Sermon is required',
                    'sermons_preacher.required' => 'Name of Preacher is required',
                    'sermons_date.required' => 'Date when sermon was preached is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

         
            /*if($data['sermons_filetype'] == 'local') {
                if($request->hasFile('sermons_videofile') && !empty($request->file('sermons_videofile'))) {

                    $videoFile = $request->file('sermons_videofile');
                    $fileName = time() . '_' . $videoFile->getClientOriginalExtension();
                    $videoFile->storeAs('admin/videos/sermons', $fileName);
                   
                } else {
                    $fileName = $data['currentsermons_file'];
                }
            } */
              if($data['sermons_filetype'] == 'remote') {
                    $fileName = $data['sermons_urlfile'];
              }

              $store = [
            
                'sermoncategoriesid' => $data['sermoncategoriesid'],
                'sermons_title' => $data['sermons_title'],
                'sermons_filetype' => $data['sermons_filetype'],
                'sermons_file' => $fileName,
                'sermons_location' => $data['sermons_location'],
                'sermons_preacher' => $data['sermons_preacher'],
                'sermons_date' =>  $data['sermons_date'],
               
            ];

              Sermon::where('sermons_id',$data['sermons_id'])->update($store);
              return redirect('admin/sermon/'.$data['sermons_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sermonsid)
    {
        Sermon::where('sermons_id',$sermonsid)->delete();
        return redirect('admin/sermon')->with('success_message', 'Sermon deleted successfully');
    }


    public function updateSermonFile(Request $request) {
        $message = "Banner File changed succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations

                $rules = [
                'sermons_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ];
                 
                $customMessages = [
                    'sermons_file.required' => 'Sermon File is required',
                    'sermons_file.mimes' => "The Image format is not allowed",
                    'sermons_file.max' => "Image upload size can't exceed 10MB",
                ];
                   
            $this->validate($request,$rules,$customMessages);

                if($request->hasFile('sermons_file')) {
                    $image_tmp = $request->file('sermons_file');
                    if($image_tmp->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                    $image = $manager->read($image_tmp);
                    //$image = $image->resize(60,60);
        
                    $storePath = 'admin/img/sermons/';
                    //$image->toJpeg(80)->save($storePath . $imageName);
                    $image->save($storePath . $fileName);
                    
                    
                    
                    }
                } 

              $store = [
                'sermons_file' => $fileName,
                'sermons_date' => date('Y-m-d'),
               
            ];

            Sermon::where('sermons_id',$data['sermons_id'])->update($store);
            return redirect('admin/sermon/'.$data['sermons_id'])->with('success_message', $message);

         }
    }

}
