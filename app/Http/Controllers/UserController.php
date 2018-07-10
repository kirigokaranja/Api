<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    public function login(Request $request){
        //no need for validation
        $user = new User();

        //check if the email address exists
        $email = $request->input('email');
        $user_pass = $request->input('password');
        $user['name'] = $email;

        if($user = User::where('name','=',$email)->first()){
            /*
             *  email exists
             *  Go to database and select password
             */

            if(User::where('user_type','=','3')){
                //$user['authorize'] = "authorized";

                //store a piece of info after login
//                session(['user_id'=>$user->id]);
//                session(['user_name'=>$user->name]);
//                session(['user_email'=>$user->email]);
//                session(['user_category'=>$user->category]);
                return view('Admin.Branch');

            }else{
                //$user['authorize'] = "Not Authorized";
                return back()->with('message','Invalid Email or password');
            }

        }else{

            return back()->with('message','Invalid Email or password');
        }

    }

}
