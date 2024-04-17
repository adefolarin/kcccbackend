<?php

namespace App\Http\Controllers\FrontEndApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\Models\AamUser;
use Dotenv\Validator as DotenvValidator;
use Intervention\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\AamUserMail;

class AamUserController extends Controller
{ 
    //
    public function dashboard() {
         Session::put('page', 'dashboard');
        //echo "<prev>"; print_r(Auth::guard('aamusers')->user()); die;
        return view('aamuser.dashboard');

    }

    public function index($aamuserid)
    {
  
      $aamusernumrw = DB::table('aamusers')->where('aamusers_id',$aamuserid)->count();
  
      if ($aamuserid != null) {
  

  
        $aamusernumrw = DB::table('aamusers')->where('aamusers_id',$aamuserid)->count();
  
        if ($aamusernumrw > 0) {
  
          $aamusers = DB::table('aamusers')->where('aamusers_id',$aamuserid)->first();
    
            $aamuserdata = array(
              'aamusers_id' => $aamusers->aamusers_id,
              'aamusers_name' => $aamusers->aamusers_name,
              'aamusers_email' => $aamusers->aamusers_email,
              'aamusers_pnum' => $aamusers->aamusers_pnum,
              'aamusers_address' => $aamusers->aamusers_address,
              'aamusers_state' => $aamusers->aamusers_state,
              'aamusers_country' => $aamusers->aamusers_country,
              'aamusers_city' => $aamusers->aamusers_city,
            );
          
        } else {
            $aamuserdata[] = array(
            'aamusers_name' => ''
          );
        }
  
          return response()->json(['aamusers' => $aamuserdata]);
  
      } 
    }

    public function store(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;

            $message = "Registration Succussful";

            $rules = [
              'aamusers_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'aamusers_email' => 'required|email|max:255',
              'aamusers_password' => 'required|max:30',
              'aamusers_confirmpassword' => 'required|max:30'
            ];

            $customMessages = [
              'aamusers_name.required' => 'Name is required',
              'aamusers_name.regex' => 'Valid Name is required',
              'aamusers_email.required' => 'Email is required',
              'aamusers_email.email' => 'Valid Email is required',
              'aamusers_password.required' => 'Password is required',
              'aamusers_confirmpassword.required' => 'Confirm Password is required',
            ];

            $store = [
                [
                   'aamusers_name' => $data['aamusers_name'],
                   'aamusers_email' => $data['aamusers_email'],
                   //'aamusers_password' => bcrypt($data['aamusers_password']),
                   'aamusers_password' => md5($data['aamusers_password']),
                ]
            ];

            $validator = Validator::make($data,$rules,$customMessages);

            if($validator->fails()) {
                return response()->json([$validator->errors(),422]);
            }


            if($data['aamusers_password'] != $data['aamusers_confirmpassword']) {
                return response()->json(['status' => false, 'message' => 'Passwords Must Match']);
            }
            else if($data['aamusers_name'] == "" || $data['aamusers_email'] == "" || $data['aamusers_password'] == "") {
                return response()->json(['status' => false, 'message' => 'All Fields Are Required']);
            }
            elseif (DB::table("aamusers")->where('aamusers_email', $data['aamusers_email'])->exists()) {
              return response()->json(['status' => false, 'message' => 'Email Already Exists']);
            } 
            else {

                DB::table("aamusers")->insert($store);
                return response()->json(['status' => true, 'message' => $message], 201);
            }



        }
    }

    public function login(Request $request ) {
        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;


            $rules = [
              'aamusers_email' => 'required|email|exists:aamusers',
              'aamusers_password' => 'required',
            ];

            $customMessages = [
              'aamusers_email.required' => 'Email is required',
              'aamusers_email.email' => 'Valid Email is required',
              'aamusers_email.exists' => 'Email does not exist',
              'aamusers_password.required' => 'Password is required',
            ];

            $validator = Validator::make($data,$rules,$customMessages);

            if($validator->fails()) {
                return response()->json([$validator->errors(),422]);
            }

            $usercount = DB::table("aamusers")->where("aamusers_email",$data['aamusers_email'])->count();


            if($usercount > 0) {
            $userdetails = DB::table("aamusers")->where("aamusers_email",$data['aamusers_email'])->first();
              if(md5($data['aamusers_password']) == $userdetails->aamusers_password) {
                //Session::regenerate();
                $data = array (
                  'userid' => $userdetails->aamusers_id,
                  'name' => $userdetails->aamusers_name,
                  'email' => $userdetails->aamusers_email,
                );
                

                return response()->json(['status' => true, 'message' => 'Login Successful', 'users' => $data], 201);
              } 
              
              else {
                return response()->json(['status' => false, 'message' => 'Invalid Email or Password']);
              }
            } else {
              return response()->json(['status' => false, 'message' => 'Invalid Email']);
            }
        }
        return response()->json(['status' => false, 'message' => 'Something went wrong']);
    }

    public function logout() {
      //Session::flush();
      //Session::regenerateToken();
      //Session::forget();
      Auth::guard('aamuser')->logout();
      return response()->json(['status' => true, 'message' => 'You have logged out successfully']);
    }

    /*public function updatePassword(Request $request) {
      //Session::put('page', 'update-aamuser-password');
      if($request->isMethod('post')) {
        $data = $request->all();
        // check if current aamusers_password is correct
        if(Hash::check($data['current_pwd'],Auth::guard('aamuser')->user()->aamusers_password)) {
          // Check if new aamusers_password and confirm aamusers_password match
          if($data['new_pwd'] == $data['confirm_pwd']) {
            // Update New Password
            AamUser::where('aamusers_id',Auth::guard('aamuser')->user()->id)->update(['aamusers_password' => bcrypt($data['new_pwd'])]);
            return response()->json(['status' => true, 'message' => 'Password Updated Succesfully']);
          } else {
            return response()->json(['status' => false, 'message' => 'New Password and Confirm Password Do Not Match']);
          }

        } else {
           return response()->json(['status' => false, 'message' => 'Your current aamusers_password is Incorrect!']);
        }
      }

    }*/

    public function updatePassword(Request $request) {
      //Session::put('page', 'update-aamuser-password');
      if($request->isMethod('post')) {
        $data = $request->all();
        // check if current aamusers_password is correct
            // Update New Password
            AamUser::where('aamusers_id',$data['aamusers_id'])->update(['aamusers_password' => md5($data['aamusers_password'])]);
            return response()->json(['status' => true, 'message' => 'Password Updated Succesfully']);
          

        
      }

    }

    public function updateEmail(Request $request) {
      //Session::put('page', 'update-aamuser-password');
      if($request->isMethod('post')) {
        $data = $request->all();

        $aamuser = DB::table("aamusers")->where('aamusers_id',$data['aamusers_id'])->first();
        // check if current aamusers_password is correct
            // Update New Password
          if($data['aamusers_email'] != $aamuser->aamusers_email) {
            AamUser::where('aamusers_id',$data['aamusers_id'])->update(['aamusers_email' => $data['aamusers_email']]);
            return response()->json(['status' => true, 'message' => 'Email Updated Succesfully']);
          } else {
            return response()->json(['status' => false, 'message' => 'Email already exists']);
          }
        
      }

    }

    public function updatePnum(Request $request) {
      //Session::put('page', 'update-aamuser-password');
      if($request->isMethod('post')) {
        $data = $request->all();

        $aamuser = AamUser::where('aamusers_id',$data['aamusers_id'])->first();
        // check if current aamusers_password is correct
            // Update New Password
          if($data['aamusers_pnum'] != $aamuser->aamusers_pnum) {
            AamUser::where('aamusers_id',$data['aamusers_id'])->update(['aamusers_pnum' => $data['aamusers_pnum']]);
            return response()->json(['status' => true, 'message' => 'Phone Number Updated Succesfully']);
          } else {
            return response()->json(['status' => false, 'message' => 'Phone Number already exists']);
          }
        
      }

    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        if(Hash::check($data['current_pwd'],Auth::guard('aamuser')->user()->aamusers_password)) {
          return response()->json(['status' => true, 'message' => 'true']);
        } else {
          return response()->json(['status' => false, 'message' => 'false']);
        }
    }

    public function updateAamUser(Request $request) {
      //Session::put('page', 'update-aamusers-details');

      if($request->isMethod('post')) {
        $data = $request->all();
        //echo "<prev>"; print_r($data); die;

        /*$rules = [
          'aamusers_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
          'aamusers_pnum' => 'required|numeric|min:10',
        ];

        $customMessages = [
          'aamusers_name.required' => 'Name is required',
          'aamusers_name.regex' => 'AamUser Name is not valid',
          'aamusers_mobile.required' => 'Valid Mobile is r equired',
          'aamusers_mobile.numeric' => 'Valid Phone Number is required',
          'aamusers_mobile.max' => 'Valid Mobile is required',
          'aamusers_mobile.min' => 'Valid Mobile is required',
        ];

        $this->validate($request,$rules,$customMessages);*/


        // Update AamUser Details

        AamUser::where('aamusers_id',$data['aamusers_id'])->update(
          [
          'aamusers_name' => $data['aamusers_name'], 
          'aamusers_address' => $data['aamusers_address'],
          'aamusers_country' => $data['aamusers_country'],
          'aamusers_state' => $data['aamusers_state'],
          'aamusers_city' => $data['aamusers_city'],
          ]
        );

        return response()->json(['status' => true, 'message' => 'Profile Updated Succesfully']);
    }


    }



    public function sendPasswordCode(Request $request) {
      //Session::put('page', 'update-aamuser-password');
      if($request->isMethod('post')) {
        $data = $request->all();

        $code = rand(100000,999999);

        $resetdate = date('Y-m-d H:i:s');

        $mailData = [
          'title' => 'Verification Code',
          'code' => $code,
          'body' => 'Do not share the code with anyone'
         ];

        //$aamuser = DB::table("aamusers")->where('aamusers_email',$data['aamusers_email'])->first();
        // check if current aamusers_password is correct
            // Update New Password
          if(DB::table("aamusers")->where('aamusers_email',$data['aamusers_email'])->exists()) {
            if(Mail::to($data['aamusers_email'])->send(new AamUserMail($mailData))) {
            AamUser::where('aamusers_email',$data['aamusers_email'])
            ->update(['aamusers_code' => $code, 'aamusers_resetdate' => $resetdate]);
              return response()->json(['status' => true, 'message' => 'A verification code has been sent to your mail']);
            } else {
              return response()->json(['status' => false, 'message' => 'Something went wrong. Try again later']);
            }
            
          } else {
            return response()->json(['status' => false, 'message' => 'There is no account with that email']);
          }
        
      }

    }


    public function resetPassword(Request $request) {
      //Session::put('page', 'update-aamuser-password');
      if($request->isMethod('post')) {
        $data = $request->all();


        $aamuser = DB::table("aamusers")->where('aamusers_email',$data['aamusers_email'])->first();
        // check if current aamusers_password is correct
            // Update New Password
          if($data['aamusers_code'] == $aamuser->aamusers_code) {

            AamUser::where('aamusers_email',$data['aamusers_email'])->update(['aamusers_password' => md5($data['aamusers_password'])]);
              return response()->json(['status' => true, 'message' => 'Password Reset Successfull']); 
            
          } else {
            return response()->json(['status' => false, 'message' => 'Invalid Verification Code']);
          }
        
      }

    }

  

}

