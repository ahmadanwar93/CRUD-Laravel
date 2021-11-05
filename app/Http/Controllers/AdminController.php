<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\Job;
use App\Models\User;
use App\Models\Department;


class AdminController extends Controller
{
    //
    public function index(Request $request){
        if($request->isMethod('post')){
            $credentials = $request->validate([                
                'email' => ['required','email'], //rfc and dns to validate if the email is valid or not
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                if (Auth::user()->role == 1){
                    $request->session()->regenerate();
                    $jwt_token = JWTAuth::attempt($credentials);
                    session(['jwt_token' => $jwt_token]);
                    return redirect()->route('admin.dashboard');

                    // aku try bawah
                    // $userName = User::where("email",Auth::user()-> email)->first();
                    // $userName = $userName -> name;
                    // return view('admin.dashboard',[
                    //     "userId"=>$userName]);  
            }else {
                return redirect('admin/');
            }
            }

            return back()->withErrors([
                'email'=>'The provide credentials do not meet our record',
            ]);
        
        }
        return view('admin.login');
    }

    public function dashboard(){
        
        // dia punya
        $jwt_token = session('jwt_token');
        $user_total =User::get()->count();
        $jobCount = Job::get()->count(); 
        $departmentCount = Department::get()->count();
        // compact('jwt_token')
        // ["jwt_token"=>$jwt_token]
        return view('admin.dashboard', compact('jwt_token', 'user_total','jobCount','departmentCount'));


        // atas dia punya

        // $jobCount = Job::get()->count(); 
        // $departmentCount = Department::get()->count();
        // $userCount = User::get()->count();

        // return view('admin.dashboard',["jobCount"=>$jobCount,
        // "departmentCount"=>$departmentCount,
        // "userCount"=>$userCount,
        // ]);
        
    }

    public function logout(){
        if (Auth::check()){
            Auth::logout();
        }
        return redirect('admin');
    }
}
