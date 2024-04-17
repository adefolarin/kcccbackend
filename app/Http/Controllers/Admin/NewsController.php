<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class NewsController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($newsid = null)
    {
        Session::put("page", "news");

        $newscategories = NewsCategory::query()->get()->toArray();

        $news = DB::table('newscategories')->orderByDesc('news_id')->join('news','newscategories.newscategories_id','=', 'news.newscategoriesid')->select('news.*','newscategories.newscategories_name')->get()->toArray();

        if($newsid == null) {
              
           return view('admin.news')->with(compact('news','newscategories'));
           //dd($news); die;
           //echo "<prev>"; print_r($news); die;

        } else {
            $newss = new News;
            $newscategory = new NewsCategory;
            $newsone = $newss->where('news_id', $newsid)->first();

            $newscategoryone = $newscategory->where('newscategories_id', $newsone['newscategoriesid'])->first(); 
            
            //dd($newscategoryone['newscategories_name']); die;
            //$news = News::query()->get()->toArray(); 
             return view('admin.news')->with(compact('news','newsone','newscategoryone','newscategories'));
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

        $news = new News;
    
        $message = "News added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // News Category Vallidations

                $rules = [
                    'newscategoriesid' => 'required',
                    'news_title' => 'required',
                    'news_content' => 'required',
                    'news_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',

                    
                ];
                $customMessages = [
                    'newscategoriesid.required' => 'Name of News Category is required',
                    'news_title.required' => 'Name of News Title is required',
                    'news_content.required' => 'News Content is required',
                    'news_file.required' => 'News File is required',
                    'news_file.mimes' => "The Image format is not allowed",
                    'news_file.max' => "Image upload size can't exceed 5MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('news_file')) {
                $image_tmp = $request->file('news_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/news/';
                $storePath = public_path('admin/img/news/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              $store = [
                [
                'newscategoriesid' => $data['newscategoriesid'],
                'news_title' => $data['news_title'],
                'news_content' => $data['news_content'],
                'news_file' => $fileName,
                'news_date' => date("Y-m-d"),

               ]
            ];

                $news->insert($store);
                return redirect('admin/news')->with('success_message', $message);
              

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
    public function edit($newscategoriesid)
    {
        //$newscategoryone = NewsCategory::find($newscategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.newscategory')->with(compact('newscategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "News updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'newscategoriesid' => 'required',
                'news_title' => 'required',
                'news_content' => 'required',
                'news_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',

            ];
            $customMessages = [
                'newscategoriesid.required' => 'Name of News Category is required',
                'news_title.required' => 'Name of News Title is required',
                'news_content.required' => 'News Content is required',
                'news_file.mimes' => "The Image format is not allowed",
                'news_file.max' => "Image upload size can't exceed 5MB",
            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('news_file') && !empty($request->file('news_file'))) {
                $image_tmp = $request->file('news_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/news/';
                $storePath = public_path('admin/img/news/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentnews_file'];
            }

              $store = [
            
                'newscategoriesid' => $data['newscategoriesid'],
                'news_title' => $data['news_title'],
                'news_content' => $data['news_content'],
                'news_file' => $fileName,
                'news_date' => date("Y-m-d"),
               
            ];

              News::where('news_id',$data['news_id'])->update($store);
              return redirect('admin/news/'.$data['news_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($newsid)
    {
        News::where('news_id',$newsid)->delete();
        return redirect('admin/news')->with('success_message', 'News deleted successfully');
    }


    public function updateNewsFile(Request $request) {
        $message = "Banner File changed succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations

                $rules = [
                'news_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ];
                 
                $customMessages = [
                    'news_file.required' => 'News File is required',
                    'news_file.mimes' => "The Image format is not allowed",
                    'news_file.max' => "Image upload size can't exceed 10MB",
                ];
                   
            $this->validate($request,$rules,$customMessages);

                if($request->hasFile('news_file')) {
                    $image_tmp = $request->file('news_file');
                    if($image_tmp->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                    $image = $manager->read($image_tmp);
                    //$image = $image->resize(60,60);
        
                    $storePath = 'admin/img/news/';
                    //$image->toJpeg(80)->save($storePath . $imageName);
                    $image->save($storePath . $fileName);
                    
                    
                    
                    }
                } 

              $store = [
                'news_file' => $fileName,
                'news_date' => date('Y-m-d'),
               
            ];

            News::where('news_id',$data['news_id'])->update($store);
            return redirect('admin/news/'.$data['news_id'])->with('success_message', $message);

         }
    }

}
