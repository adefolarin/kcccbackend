<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\Models\StoreUser;
use Dotenv\Validator as DotenvValidator;
use Intervention\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as FacadesHash;

class StoreUserController extends Controller
{
  //
  public function index($storeusersid = null)
  {

    //$storeusercategories = EventCategory::query()->get();

    //$storeusers = Event::get();

    $now = date("Y-m-d H:i");

    $storeusersnumrw = DB::table('storeusers')->count();

    if ($storeusersid == null) {

      if ($storeusersnumrw > 0) {
        $storeusers = DB::table('storeusers')->get();

        foreach ($storeusers as $storeuser) {

          $data[] = array(
            'storeusers_id' => $storeuser->storeusers_id,
            'storeusers_fname' => $storeuser->storeusers_fname,
            'storeusers_lname' => $storeuser->storeusers_lname,
            'storeusers_email' => $storeuser->storeusers_email,
            'storeusers_pnum' => $storeuser->storeusers_pnum,
            'storeusers_gender' => $storeuser->storeusers_gender,
          );
        }
      } else {
        $data[] = array(
          'storeusers_fname' => ''
        );
      }

      return response()->json(['storeusers' => $data]);
    } else {


      $storeuser = new Event;
      //$storeusercategory = new EventCategory;
      $storeuseronenumrw = $storeuser->where('storeusers_id', $storeusersid)->count();

      if ($storeuseronenumrw > 0) {
        $storeuserone = $storeuser->where('storeusers_id', $storeusersid)->first();

        $data = array(
          'storeusers_id' => $storeuserone->storeusers_id,
          'storeusers_fname' => $storeuser->storeusers_fname,
          'storeusers_lname' => $storeuser->storeusers_lname,
          'storeusers_email' => $storeuser->storeusers_email,
          'storeusers_pnum' => $storeuser->storeusers_pnum,
          'storeusers_gender' => $storeuser->storeusers_gender,
        );
      } else {
        $data = array(
          'storeusers_fname' => ''
        );
      }

      return response()->json(['storeuserone' => $data]);
    }
  }

  public function store(Request $request)
  {
    if ($request->isMethod('post')) {
      $data = $request->all();
      //echo "<prev>"; print_r($data); die;

      $message = "Registration Succussful";

      $rules = [
        'storeusers_fname' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
        'storeusers_lname' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
        'storeusers_gender' => 'required',
        'storeusers_email' => 'required|email|max:255',
        'storeusers_pnum' => 'required|numeric|min:10',
        'storeusers_password' => 'required|min:8',
        'storeusersconfirm_password' => 'required|min:8',
      ];

      $customMessages = [
        'storeusers_fname.required' => 'First Name is required',
        'storeusers_fname.regex' => 'Valid First Name is required',
        'storeusers_lname.required' => 'Last Name is required',
        'storeusers_gender.required' => 'Gender is required',
        'storeusers_lname.regex' => 'Valid Last Name is required',
        'storeusers_email.required' => 'Email is required',
        'storeusers_email.email' => 'Valid Email is required',
        'storeusers_password.required' => 'Password is required',
        'storeusers_password.min' => 'Password Cannot Be Less Than 8 characters',
        'storeusersconfirm_password.required' => 'Confirm Password is required',
        'storeusersconfirm_password.min' => 'Confirm Password Cannot Be Less Than 8 characters',
        'storeusers_pnum.required' => 'Valid Phone Number is required',
        'storeusers_pnum.numeric' => 'Phone Number Must Be Number',
        'storeusers_pnum.min' => 'Phone Number Cannot Be Less Than 10 digits',
      ];

      $store = [
        [
          'storeusers_fname' => $data['storeusers_fname'],
          'storeusers_lname' => $data['storeusers_lname'],
          'storeusers_gender' => $data['storeusers_gender'],
          'storeusers_pnum' => $data['storeusers_pnum'],
          'storeusers_email' => $data['storeusers_email'],
          'storeusers_password' => bcrypt($data['storeusers_password']),
        ]
      ];

      $validator = Validator::make($data, $rules, $customMessages);

      if ($validator->fails()) {
        return response()->json([$validator->errors(), 422]);
      }


      if ($data['storeusers_password'] != $data['storeusersconfirm_password']) {
        return response()->json(['status' => false, 'message' => 'Passwords Must Match']);
      } else if ($data['storeusers_fname'] == "" || $data['storeusers_lname'] == "" || $data['storeusers_password'] == "" || $data['storeusers_gender'] == "" || $data['storeusers_pnum'] == "" || $data['storeusers_email'] == "") {
        return response()->json(['status' => false, 'message' => 'All Fields Are Required']);
      } else {

        DB::table("storeusers")->insert($store);
        return response()->json(['status' => true, 'message' => $message], 201);
      }
    }
  }

  public function login(Request $request)
  {
    if ($request->isMethod('post')) {
      $data = $request->all();
      //echo "<prev>"; print_r($data); die;


      $rules = [
        'storeusers_email' => 'required|email|exists:storeusers',
        'storeusers_password' => 'required',
      ];

      $customMessages = [
        'storeusers_email.required' => 'Email is required',
        'storeusers_email.email' => 'Valid Email is required',
        'storeusers_email.exists' => 'Email does not exist',
        'storeusers_password.required' => 'Password is required',
      ];

      $validator = Validator::make($data, $rules, $customMessages);

      if ($validator->fails()) {
        return response()->json([$validator->errors(), 422]);
      }

      $usercount = DB::table("storeusers")->where("storeusers_email", $data['storeusers_email'])->count();


      if ($usercount > 0) {
        $userdetails = DB::table("storeusers")->where("storeusers_email", $data['storeusers_email'])->first();
        if (password_verify($data['storeusers_password'], $userdetails->storeusers_password)) {
          //Session::regenerate();
          $data = array(
            'storeusers_id' => $userdetails->storeusers_id,
            'storeusers_fname' => $userdetails->storeusers_fname,
            'storeusers_lname' => $userdetails->storeusers_lname,
            'storeusers_email' => $userdetails->storeusers_email,
            'storeusers_pnum' => $userdetails->storeusers_pnum,
            'storeusers_gender' => $userdetails->storeusers_gender,
          );
          return response()->json(['status' => true, 'message' => 'Login Successful', 'storeuserone' => $data], 201);
        } else {
          return response()->json(['status' => false, 'error_message' => 'Invalid Email or Password']);
        }
      } else {
        return response()->json(['status' => false, 'error_message' => 'Invalid Email']);
      }
    }
    return view('storeuser.login');
  }

  public function logout()
  {
    //Session::flush();
    //Session::regenerateToken();
    //Session::forget();
    //Auth::guard('storeuser')->logout();
    return response()->json(['status' => true, 'message' => 'You have logged out successfully']);
  }

  public function updatePassword(Request $request)
  {
    if ($request->isMethod('post')) {
      $data = $request->all();

      $storeusersid = $data['storeusers_id'];
      $storeuserspassword = $data['storeusers_password'];

      $userdetails = DB::table("storeusers")->where("storeusers_id", $storeusersid)->first();

      // check if current storeusers_password is correct
      if (Hash::check($storeuserspassword, $userdetails->storeusers_password)) {
        // Check if new storeusers_password and confirm storeusers_password match
        if ($data['new_password'] == $data['confirm_password']) {
          // Update New Password
          StoreUser::where('storeusers_id', $storeusersid)->update(['storeusers_password' => bcrypt($storeuserspassword)]);
          return response()->json(['status' => true, 'message' => 'Password Updated Succesfully']);
        } else {
          return response()->json(['status' => false, 'message' => 'New Password and Confirm Password Do Not Match']);
        }
      } else {
        return response()->json(['status' => false, 'message' => 'Your current storeusers_password is Incorrect!']);
      }
    }
  }

  public function checkCurrentPassword(Request $request)
  {
    $data = $request->all();

    $storeusersid = $data['storeusers_id'];
    $storeuserspassword = $data['storeusers_password'];

    $userdetails = DB::table("storeusers")->where("storeusers_id", $storeusersid)->first();
    if (Hash::check($storeuserspassword, $userdetails->storeusers_password)) {
      return response()->json(['status' => true, 'message' => 'true']);
    } else {
      return response()->json(['status' => false, 'message' => 'false']);
    }
  }

  public function updateStoreUserDetails(Request $request)
  {

    if ($request->isMethod('post')) {
      $data = $request->all();
      //echo "<prev>"; print_r($data); die;

      $rules = [
        'storeusers_fname' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
        'storeusers_lname' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
        'storeusers_gender' => 'required',
        'storeusers_email' => 'required|email|max:255',
        'storeusers_pnum' => 'required|numeric|min:10',
      ];

      $customMessages = [
        'storeusers_fname.required' => 'First Name is required',
        'storeusers_fname.regex' => 'Valid First Name is required',
        'storeusers_lname.required' => 'Last Name is required',
        'storeusers_gender.required' => 'Gender is required',
        'storeusers_lname.regex' => 'Valid Last Name is required',
        'storeusers_email.required' => 'Email is required',
        'storeusers_email.email' => 'Valid Email is required',
        'storeusers_pnum.required' => 'Valid Phone Number is required',
        'storeusers_pnum.numeric' => 'Phone Number Must Be Number',
        'storeusers_pnum.min' => 'Phone Number Cannot Be Less Than 10 digits',
      ];

      // Update StoreUser Details

      $store =
        [
          'storeusers_fname' => $data['storeusers_fname'],
          'storeusers_lname' => $data['storeusers_lname'],
          'storeusers_gender' => $data['storeusers_gender'],
          'storeusers_pnum' => $data['storeusers_pnum'],
          'storeusers_email' => $data['storeusers_email'],
        ];
      

      $validator = Validator::make($data, $rules, $customMessages);

      if ($validator->fails()) {
        return response()->json([$validator->errors(), 422]);
      }


     if ($data['storeusers_fname'] == "" || $data['storeusers_lname'] == "" || $data['storeusers_email'] == "" || $data['storeusers_gender'] == "" || $data['storeusers_pnum'] == "") {
        return response()->json(['status' => false, 'message' => 'All Fields Are Required']);
      } else {

        DB::table('storeusers')->where('storeusers_id', $data['storeusers_id'])->update($store);
        return response()->json(['status' => true, 'message' => "User Details Updated Successfully"], 201);
      }
    }
  }
}
