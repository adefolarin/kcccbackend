<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\Models\Admin;
use Intervention\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{ 
    //
    public function dashboard() {
         Session::put('page', 'dashboard');
        //echo "<prev>"; print_r(Auth::guard('admin')->user()); die;
        return view('admin.dashboard');

    }

    public function login(Request $request ) {
        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            $rules = [
              'email' => 'required|email|max:255',
              'password' => 'required|max:30'
            ];

            $customMessages = [
              'email.required' => 'Email is required',
              'email.email' => 'Valid Email is required',
              'password.required' => 'Password is required',
            ];

            $this->validate($request,$rules,$customMessages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])) {
              //Session::regenerate();
               return redirect('admin/dashboard'); 
            } else {
               return redirect()->back()->with("error_message", "Invalid Email or Password");
            }
        }
        return view('admin.login');
    }

    public function logout() {
      //Session::flush();
      //Session::regenerateToken();
      //Session::forget();
      Auth::guard('admin')->logout();
      return redirect('admin/login');
    }

    public function updatePassword(Request $request) {
      Session::put('page', 'update-password');
      if($request->isMethod('post')) {
        $data = $request->all();
        // check if current password is correct
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)) {
          // Check if new password and confirm password match
          if($data['new_pwd'] == $data['confirm_pwd']) {
            // Update New Password
            Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
            return redirect()->back()->with('success_message', 'Password Updated Succesfully');
          } else {
            return redirect()->back()->with('error_message', 'New Password and Confirm Password Do Not Match');
          }

        } else {
           return redirect()->back()->with('error_message', 'Your current password is Incorrect!');
        }
      }

        return view('admin.update-password');
    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)) {
          return "true";
        } else {
          return "false";
        }
    }

    public function updateAdminDetails(Request $request) {
      Session::put('page', 'update-admin-details');

      if($request->isMethod('post')) {
        $data = $request->all();
        //echo "<prev>"; print_r($data); die;

        $rules = [
          'admin_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
          'admin_mobile' => 'required|numeric|min:10',
          'admin_image' => 'image',
        ];

        $customMessages = [
          'admin_name.required' => 'Name is required',
          'admin_name.regex' => 'Admin Name is not valid',
          'admin_mobile.required' => 'Valid Mobile is required',
          'admin_mobile.numeric' => 'Valid Phone Number is required',
          'admin_mobile.max' => 'Valid Mobile is required',
          'admin_mobile.min' => 'Valid Mobile is required',
          'admin_image.image' =>  'Valid Image is required'
        ];

        $this->validate($request,$rules,$customMessages);

        // Upload Admin Image
        if($request->hasFile('admin_image')) {
          $image_tmp = $request->file('admin_image');
          if($image_tmp->isValid()) {
            $manager = new ImageManager(new Driver());
            $imageName = hexdec(uniqid()).'.'.$image_tmp->getClientOriginalExtension();
            $image = $manager->read($image_tmp);
            //$image = $image->resize(60,60);

            $storePath = 'admin/img/photos/';
            //$image->toJpeg(80)->save($storePath . $imageName);
            $image->save($storePath . $imageName);
            
          
          }
        } else if(!empty($data['current_image'])) {
           $imageName = $data['current_image'];
        } else {
           $imageName = "";
        }

        // Update Admin Details

        Admin::where('email',Auth::guard('admin')->user()->email)->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'],'image' => $imageName]);

        return redirect()->back()->with('success_message', 'Admin Details Updated Succesfully');
    }

      return view('admin.update-admin-details');
    }

  

}

