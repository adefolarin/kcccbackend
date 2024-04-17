<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EventController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($eventsid = null)
    {
        Session::put("page", "events");

        $eventcategories = EventCategory::query()->get()->toArray();

        $events = DB::table('eventcategories')->orderByDesc('events_id')->join('events','eventcategories.eventcategories_id','=', 'events.eventcategoriesid')->select('events.*','eventcategories.eventcategories_name')->get()->toArray();

        if($eventsid == null) {
              
           return view('admin.event')->with(compact('events','eventcategories'));
           //dd($events); die;
           //echo "<prev>"; print_r($events); die;

        } else {
            $event = new Event;
            $eventcategory = new EventCategory;
            $eventone = $event->where('events_id', $eventsid)->first();

            $eventcategoryone = $eventcategory->where('eventcategories_id', $eventone['eventcategoriesid'])->first(); 
            
            //dd($eventcategoryone['eventcategories_name']); die;
            //$events = Event::query()->get()->toArray(); 
             return view('admin.event')->with(compact('events','eventone','eventcategoryone','eventcategories'));
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

        $event = new Event;
    
        $message = "Event added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Event Category Vallidations

                $rules = [
                    'eventcategoriesid' => 'required',
                    'events_title' => 'required',
                    'events_desc' => 'required',
                    'events_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                    'events_startdate' => 'required',
                    'events_enddate' => 'required',
                    'events_venue' => 'required',
                    'events_address' => 'required',
                    'events_organizer' => 'required',
                    'events_preacher' => 'required',
                    
                ];
                $customMessages = [
                    'eventcategoriesid.required' => 'Name of Event Category is required',
                    'events_title.required' => 'Name of Event Title is required',
                    'events_desc.required' => 'Name of Event Description is required',
                    'events_file.required' => 'Name of Event File is required',
                    'events_file.mimes' => "The Image format is not allowed",
                    'events_file.max' => "Image upload size can't exceed 5MB",
                    'events_startdate.required' => 'Name of Event Start Date is required',
                    'events_enddate.required' => 'Name of Event End Date is required',
                    'events_venue.required' => 'Name of Event Venue is required',
                    'events_address.required' => 'Name of Event Address is required',
                    'events_organizer.required' => 'Name of Event Organizer is required',
                    'events_preacher.required' => 'Name of Event Preacher is required',
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if($request->hasFile('events_file')) {
                $image_tmp = $request->file('events_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                ///$storePath = 'admin/img/events/';
                $storePath = public_path('admin/img/events/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                      
                }
              } 

              $timestamp = strtotime($data['events_startdate']);
              $events_date = date("Y-m-d", $timestamp);

              $store = [
                [
                'eventcategoriesid' => $data['eventcategoriesid'],
                'events_title' => $data['events_title'],
                'events_desc' => $data['events_desc'],
                'events_file' => $fileName,
                'events_startdate' => $data['events_startdate'],
                'events_enddate' => $data['events_enddate'],
                'events_venue' => $data['events_venue'],
                'events_address' => $data['events_address'],
                'events_organizer' => $data['events_organizer'],
                'events_preacher' => $data['events_preacher'],
                'events_date' => $events_date,

               ]
            ];

                $event->insert($store);
                return redirect('admin/event')->with('success_message', $message);
              

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
        //$eventcategoryone = EventCategory::find($eventcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.eventcategory')->with(compact('eventcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Event updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'eventcategoriesid' => 'required',
                'events_title' => 'required',
                'events_desc' => 'required',
                'events_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5240',
                'events_startdate' => 'required',
                'events_enddate' => 'required',
                'events_venue' => 'required',
                'events_address' => 'required',
                'events_organizer' => 'required',
                'events_preacher' => 'required',
            ];
            $customMessages = [
                'eventcategoriesid.required' => 'Name of Event Category is required',
                'events_title.required' => 'Name of Event Title is required',
                'events_desc.required' => 'Name of Event Description is required',
                'events_file.mimes' => "The Image format is not allowed",
                'events_file.max' => "Image upload size can't exceed 5MB",
                'events_startdate.required' => 'Name of Event Start Date is required',
                'events_enddate.required' => 'Name of Event End Date is required',
                'events_venue.required' => 'Name of Event Venue is required',
                'events_address.required' => 'Name of Event Address is required',
                'events_organizer.required' => 'Name of Event Organizer is required',
                'events_preacher.required' => 'Name of Event Preacher is required',
            ];

            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('events_file') && !empty($request->file('events_file'))) {
                $image_tmp = $request->file('events_file');
                if($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver());
                $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                $image = $manager->read($image_tmp);
                //$image = $image->resize(60,60);
    
                //$storePath = 'admin/img/events/';
                $storePath = public_path('admin/img/events/');
                //$image->toJpeg(80)->save($storePath . $imageName);
                $image->save($storePath . $fileName);
                            
                
                }
            } else {
                $fileName = $data['currentevents_file'];
            }

              $timestamp = strtotime($data['events_startdate']);
              $events_date = date("Y-m-d", $timestamp);
              $store = [
            
                'eventcategoriesid' => $data['eventcategoriesid'],
                'events_title' => $data['events_title'],
                'events_desc' => $data['events_desc'],
                'events_file' => $fileName,
                'events_startdate' => $data['events_startdate'],
                'events_enddate' => $data['events_enddate'],
                'events_venue' => $data['events_venue'],
                'events_address' => $data['events_address'],
                'events_organizer' => $data['events_organizer'],
                'events_preacher' => $data['events_preacher'],
                'events_date' => $events_date,
               
            ];

              Event::where('events_id',$data['events_id'])->update($store);
              return redirect('admin/event/'.$data['events_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($eventsid)
    {
        Event::where('events_id',$eventsid)->delete();
        return redirect('admin/event')->with('success_message', 'Event deleted successfully');
    }


    public function updateEventFile(Request $request) {
        $message = "Banner File changed succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Banner Vallidations

                $rules = [
                'events_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                ];
                 
                $customMessages = [
                    'events_file.required' => 'Event File is required',
                    'events_file.mimes' => "The Image format is not allowed",
                    'events_file.max' => "Image upload size can't exceed 10MB",
                ];
                   
            $this->validate($request,$rules,$customMessages);

                if($request->hasFile('events_file')) {
                    $image_tmp = $request->file('events_file');
                    if($image_tmp->isValid()) {
                    $manager = new ImageManager(new Driver());
                    $fileName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
                    $image = $manager->read($image_tmp);
                    //$image = $image->resize(60,60);
        
                    $storePath = 'admin/img/events/';
                    //$image->toJpeg(80)->save($storePath . $imageName);
                    $image->save($storePath . $fileName);
                    
                    
                    
                    }
                } 

              $store = [
                'events_file' => $fileName,
                'events_date' => date('Y-m-d'),
               
            ];

            Event::where('events_id',$data['events_id'])->update($store);
            return redirect('admin/event/'.$data['events_id'])->with('success_message', $message);

         }
    }

}
