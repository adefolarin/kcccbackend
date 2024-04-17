<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ReviewController extends Controller
{
            /**
     * Display a listing of the resource.
     */
    public function index($reviewsid = null)
    {
        Session::put("page", "reviews");

        $reviewsnumrw = DB::table('reviews')->count();

        $reviews = DB::table('reviews')->get()->toArray();

        if($reviewsid == null) {

            if($reviewsnumrw) {
              
               return view('admin.review')->with(compact('reviews'));
            } else {
               return view('admin.review')->with(compact('reviews'));
            }

        } else {
            $review = new Review;

            $reviewone = $review->where('reviews_id', $reviewsid)->first();

             return view('admin.review')->with(compact('reviews','reviewone'));
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

        $review = new Review;
    
        $message = "Review added succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            // Review Category Vallidations

                $rules = [
                    'reviews_year' => 'required',
                    'reviews_file' => 'required|mimes:mp4|max:100240',
                    
                ];
                $customMessages = [
                    'reviews_year.required' => 'Year of Review is required',
                    'reviews_file.required' => 'Name of Review File is required',
                    'reviews_file.mimes' => "The video format is not allowed",
                    'reviews_file.max' => "Video upload size can't exceed 100MB",
                ];
                     

               $this->validate($request,$rules,$customMessages);

               if ($request->hasFile('reviews_file')) {
                $videoFile = $request->file('reviews_file');
                $fileVideoName = time() . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->storeAs('public/admin/videos/reviews', $fileVideoName);
               }

              $reviews_date = date("Y-m-d");

              $store = [
                [
                'reviews_year' => $data['reviews_year'],
                'reviews_file' => $fileVideoName,
                'reviews_date' => $reviews_date,

               ]
            ];

                $review->insert($store);
                return redirect('admin/review')->with('success_message', $message);
              

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
    public function edit($reviewcategoriesid)
    {
        //$reviewcategoryone = ReviewCategory::find($reviewcategoriesid);
        //$banner = Banner::where('banner_id',$bannerid);
        //return view('admin.reviewcategory')->with(compact('reviewcategoryone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $message = "Review updated succesfully";

        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            //  Vallidations
            $rules = [
                'reviews_year' => 'required',
                'reviews_file' => 'mimes:mp4|max:100240',
                
            ];
            $customMessages = [
                'reviews_year.required' => 'Year of Review is required',
                'reviews_file.mimes' => "The video format is not allowed",
                'reviews_file.max' => "Video upload size can't exceed 100MB",
            ];

            $this->validate($request,$rules,$customMessages);

            if ($request->hasFile('reviews_file')) {
                $videoFile = $request->file('reviews_file');
                $fileVideoName = time() . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->storeAs('public/admin/videos/reviews', $fileVideoName);
            }else {
                $fileVideoName = $data['currentreviews_file'];
            }


              $reviews_date = date("Y-m-d");
              $store = [
                'reviews_year' => $data['reviews_year'],
                'reviews_file' => $fileVideoName,
                'reviews_date' => $reviews_date,
               
            ];

              Review::where('reviews_id',$data['reviews_id'])->update($store);
              return redirect('admin/review/'.$data['reviews_id'])->with('success_message', $message);

          }   
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($reviewsid)
    {
        Review::where('reviews_id',$reviewsid)->delete();
        return redirect('admin/review')->with('success_message', 'Review deleted successfully');
    }


}
