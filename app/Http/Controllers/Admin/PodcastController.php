<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PodcastController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($podcastsid = null)
    {
        Session::put("page", "podcasts");

        $podcastcategories = PodcastCategory::query()->get()->toArray();

        $podcasts = DB::table('podcastcategories')->orderByDesc('podcasts_id')->join('podcasts','podcastcategories.podcastcategories_id','=', 'podcasts.podcastcategoriesid')->select('podcasts.*','podcastcategories.podcastcategories_name')->get()->toArray();

        if($podcastsid == null) {
              
           return view('admin.podcast')->with(compact('podcasts','podcastcategories'));
           //dd($podcasts); die;
           //echo "<prev>"; print_r($podcasts); die;

        } else {
            $podcast = new Podcast;
            $podcastcategory = new PodcastCategory;
            $podcastone = $podcast->where('podcasts_id', $podcastsid)->first();

            $podcastcategoryone = $podcastcategory->where('podcastcategories_id', $podcastone['podcastcategoriesid'])->first(); 
            
            //dd($podcastcategoryone['podcastcategories_name']); die;
            //$podcasts = Podcast::query()->get()->toArray(); 
             return view('admin.podcast')->with(compact('podcasts','podcastone','podcastcategoryone','podcastcategories'));
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

        $podcast = new Podcast;
    
        $message = "Podcast added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Podcast Category Vallidations

             if($data['podcasts_filetype'] == 'local') {
                $rules = [
                    'podcastcategoriesid' => 'required',
                    'podcasts_title' => 'required',
                    'podcasts_filetype' => 'required',
                    'podcasts_videofile' => 'required|mimes:mp4|max:500240',
                    'podcasts_location' => 'required',
                    'podcasts_preacher' => 'required',
                    'podcasts_date' => 'required',
                    
                ];
               } else if($data['podcasts_filetype'] == 'remote') {
                    $rules = [
                        'podcastcategoriesid' => 'required',
                        'podcasts_title' => 'required',
                        'podcasts_filetype' => 'required',
                        'podcasts_urlfile' => 'required',
                        'podcasts_location' => 'required',
                        'podcasts_preacher' => 'required',
                        'podcasts_date' => 'required',
                        
                    ];
               }
                $customMessages = [
                    'podcastcategoriesid.required' => 'Name of Podcast Category is required',
                    'podcasts_title.required' => 'Podcast Title is required',
                    'podcasts_filetype.required' => 'File Type is required',
                    'podcasts_videofile.required' => 'The Podcast Video File is required',
                    'podcasts_videofile.mimes' => "The Video format is not allowed",
                    'podcasts_videofile.max' => "Video upload size can't exceed 500MB",
                    'podcasts_urlfile' => "Podcast URL is required",
                    'podcasts_location.required' => 'Location of Podcast is required',
                    'podcasts_preacher.required' => 'Name of Preacher is required',
                    'podcasts_date.required' => 'Date when podcast was preached is required',
                ];
                     

               $this->validate($request,$rules,$customMessages);

               /*if($data['podcasts_filetype'] == 'local') {
                if ($request->hasFile('podcasts_videofile')) {
                    $videoFile = $request->file('podcasts_videofile');
                    $fileName = time() . '_' . $videoFile->getClientOriginalExtension();
                    $videoFile->storeAs('admin/videos/podcasts', $fileName);
                 }
                }*/
                if($data['podcasts_filetype'] == 'remote') {
                    $fileName = $data['podcasts_urlfile'];
                }

              $store = [
                [
                'podcastcategoriesid' => $data['podcastcategoriesid'],
                'podcasts_title' => $data['podcasts_title'],
                'podcasts_filetype' => $data['podcasts_filetype'],
                'podcasts_file' => $fileName,
                'podcasts_location' => $data['podcasts_location'],
                'podcasts_preacher' => $data['podcasts_preacher'],
                'podcasts_likes' => 0,
                'podcasts_shares' => 0,
                'podcasts_date' => $data['podcasts_date'],

               ]
            ];

                $podcast->insert($store);
                return redirect('admin/podcast')->with('success_message', $message);
              

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
    public function edit($podcastcategoriesid)
    {
        //$podcastcategoryone = PodcastCategory::find($podcastcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.podcastcategory')->with(compact('podcastcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Podcast updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;
    
            if($data['podcasts_filetype'] == 'local') {
                $rules = [
                    'podcastcategoriesid' => 'required',
                    'podcasts_title' => 'required',
                    'podcasts_filetype' => 'required',
                    'podcasts_videofile' => 'required|mimes:mp4|max:500240',
                    'podcasts_location' => 'required',
                    'podcasts_preacher' => 'required',
                    'podcasts_date' => 'required',
                    
                ];
               } else if($data['podcasts_filetype'] == 'remote') {
                    $rules = [
                        'podcastcategoriesid' => 'required',
                        'podcasts_title' => 'required',
                        'podcasts_filetype' => 'required',
                        'podcasts_urlfile' => 'required',
                        'podcasts_location' => 'required',
                        'podcasts_preacher' => 'required',
                        'podcasts_date' => 'required',
                        
                    ];
               }
                $customMessages = [
                    'podcastcategoriesid.required' => 'Name of Podcast Category is required',
                    'podcasts_title.required' => 'Podcast Title is required',
                    'podcasts_filetype.required' => 'File Type is required',
                    'podcasts_videofile.required' => 'The Podcast Video File is required',
                    'podcasts_videofile.mimes' => "The Video format is not allowed",
                    'podcasts_videofile.max' => "Video upload size can't exceed 500MB",
                    'podcasts_urlfile' => "Podcast URL is required",
                    'podcasts_location.required' => 'Location of Podcast is required',
                    'podcasts_preacher.required' => 'Name of Preacher is required',
                    'podcasts_date.required' => 'Date when podcast was preached is required',
                ];
                     

            $this->validate($request,$rules,$customMessages);

         
            /*if($data['podcasts_filetype'] == 'local') {
                if($request->hasFile('podcasts_videofile') && !empty($request->file('podcasts_videofile'))) {

                    $videoFile = $request->file('podcasts_videofile');
                    $fileName = time() . '_' . $videoFile->getClientOriginalExtension();
                    $videoFile->storeAs('admin/videos/podcasts', $fileName);
                   
                } else {
                    $fileName = $data['currentpodcasts_file'];
                }
            } */
              if($data['podcasts_filetype'] == 'remote') {
                    $fileName = $data['podcasts_urlfile'];
              }

              $store = [
            
                'podcastcategoriesid' => $data['podcastcategoriesid'],
                'podcasts_title' => $data['podcasts_title'],
                'podcasts_filetype' => $data['podcasts_filetype'],
                'podcasts_file' => $fileName,
                'podcasts_location' => $data['podcasts_location'],
                'podcasts_preacher' => $data['podcasts_preacher'],
                'podcasts_date' =>  $data['podcasts_date'],
               
            ];

              Podcast::where('podcasts_id',$data['podcasts_id'])->update($store);
              return redirect('admin/podcast/'.$data['podcasts_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($podcastsid)
    {
        Podcast::where('podcasts_id',$podcastsid)->delete();
        return redirect('admin/podcast')->with('success_message', 'Podcast deleted successfully');
    }


    public function updatePodcastFile(Request $request) {
        $message = "Banner File changed succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations

                $rules = [
                'podcasts_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ];
                 
                $customMessages = [
                    'podcasts_file.required' => 'Podcast File is required',
                    'podcasts_file.mimes' => "The Image format is not allowed",
                    'podcasts_file.max' => "Image upload size can't exceed 10MB",
                ];
                   
            $this->validate($request,$rules,$customMessages);

                if($request->hasFile('podcasts_file')) {
                    $image_tmp = $request->file('podcasts_file');
                    if($image_tmp->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                    $image = $manager->read($image_tmp);
                    //$image = $image->resize(60,60);
        
                    $storePath = 'admin/img/podcasts/';
                    //$image->toJpeg(80)->save($storePath . $imageName);
                    $image->save($storePath . $fileName);
                    
                    
                    
                    }
                } 

              $store = [
                'podcasts_file' => $fileName,
                'podcasts_date' => date('Y-m-d'),
               
            ];

            Podcast::where('podcasts_id',$data['podcasts_id'])->update($store);
            return redirect('admin/podcast/'.$data['podcasts_id'])->with('success_message', $message);

         }
    }

}
