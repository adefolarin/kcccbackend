<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventGallery;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EventGalleryController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($eventsid,$eventgalleriesid = null)
    {
        Session::put("page", "eventgalleries");

        $eventone = Event::find($eventsid);

        //$eventgalleries = EventGallery::query()->get()->toArray();

        $eventgalleriesnumrw = DB::table('eventgalleries')->where('eventsid',$eventsid)->orderByDesc('eventgalleries_id')->count();

        if($eventgalleriesid == null) {

            $eventgalleries = DB::table('eventgalleries')->where('eventsid',$eventsid)->orderByDesc('eventgalleries_id')->get()->toArray();

            if($eventgalleriesnumrw > 0) {
                
            return view('admin.eventgallery')->with(compact('eventone','eventgalleries'));
            //dd($events); die;
            //echo "<prev>"; print_r($events); die;

            } else {
             return view('admin.eventgallery')->with(compact('eventone','eventgalleries'));
            }
        } else {
            $eventgallerieswan = new EventGallery;
            $eventgalleriesnumrwone = $eventgallerieswan->where('eventgalleries_id', $eventgalleriesid)->count();

            $eventgalleries = DB::table('eventgalleries')->where('eventsid',$eventsid)->orderByDesc('eventgalleries_id')->get()->toArray();

            if($eventgalleriesnumrwone > 0) {
                $eventgalleriesone = $eventgallerieswan->where('eventgalleries_id', $eventgalleriesid)->first();

                return view('admin.eventgallery')->with(compact('eventone','eventgalleriesone','eventgalleries'));
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

        $eventgalleries = new EventGallery;
    
        $message = "Event Gallery Picture added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // EventGallery Category Vallidations

                $rules = [
                    'eventgalleries_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                    
                ];
                $customMessages = [
                    'events_file.required' => 'Name of EventGallery File is required',
                    'events_file.mimes' => "The Image format is not allowed",
                    'events_file.max' => "Image upload size can't exceed 5MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('eventgalleries_file')) {
                $image_tmp = $request->file('eventgalleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/events/';
                $storePath = public_path('admin/img/eventgalleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              $store = [
                [
                'eventsid' => $data['events_id'],
                'eventgalleries_file' => $fileName,

               ]
            ];

                $eventgalleries->insert($store);
                return redirect('admin/eventgallery/' . $data['events_id'])->with('success_message', $message);
              

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
    public function edit($eventcategoriesid)
    {
        //$eventcategoryone = EventGalleryCategory::find($eventcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.eventcategory')->with(compact('eventcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Event Gallery Picture updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'eventgalleries_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
            ];
            $customMessages = [
                'events_file.mimes' => "The Image format is not allowed",
                'events_file.max' => "Image upload size can't exceed 5MB",

            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('eventgalleries_file') && !empty($request->file('eventgalleries_file'))) {
                $image_tmp = $request->file('eventgalleries_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/events/';
                $storePath = public_path('admin/img/eventgalleries/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currenteventgalleries_file'];
            }

              $store = [
                'eventgalleries_file' => $fileName,
               
            ];

              EventGallery::where('eventgalleries_id',$data['eventgalleries_id'])->update($store);
              return redirect('admin/eventgallery/'. $data['eventsid'] . '/' . $data['eventgalleries_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($eventsid,$eventgalleriesid)
    {
        EventGallery::where('eventgalleries_id',$eventgalleriesid)->delete();
        return redirect('admin/eventgallery/'. $eventsid)->with('success_message', 'Event Gallery Picture deleted successfully');
    }

}
