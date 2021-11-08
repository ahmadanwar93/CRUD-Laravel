<?php

namespace App\Http\Controllers;

use App\Models\Employeejob;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function jobManagement(){
        
        $job = Employeejob::get();
        $job = Employeejob::paginate(10);
        // $job = Job::paginate(10);

        return view('admin.job',[
        "jobs"=>$job]);        
    }

    public function jobEdit(Request $request){
        // return $request->id; //to get the parameter
        $status="";
        $jobs = Employeejob::where("id",$request->id)->first();
        // return $jobs;
        // return $request->title;
        if(isset($request->title)){
            $jobs->id =$request->id;
            $jobs->title = $request->title;
            $jobs->description = $request->description;
            $jobs->max_salary = $request->max_salary;
            $jobs->min_salary = $request->min_salary;
            $jobs->save();
            
            return redirect('admin/dashboard');
        }

        return view('admin.edit',[
            "job"=>$jobs
        ]); // we use . instead of / for folder directory in laravel

    }

    public function delete(Request $request){
        // return $request->id; //to get the parameter
        
        $jobs = Employeejob::where("id",$request->id)->first();
        $jobs->delete();
        return redirect('admin/dashboard');
    }

    // for department
    public function departmentManagement(){
        
        $department = Department::get();
        $department = Department::paginate(10);
        

        return view('admin.department',[
        "departments"=>$department]);        
    }

    public function departmentEdit(Request $request){
        
        $status="";
        $departments = Department::where("id",$request->id)->first();
        
        if(isset($request->department_name)){
            $departments->id =$request->id;
            $departments->department_name = $request->department_name;
            
            $departments->save();
            
            return redirect('admin/dashboard');
        }

        return view('admin.editDepartment',[
            "department"=>$departments
        ]); // we use . instead of / for folder directory in laravel

    }

    public function departmentDelete(Request $request){
        // return $request->id; //to get the parameter
        
        $departments = Department::where("id",$request->id)->first();
        $departments->delete();
        return redirect('admin/dashboard');
    }



    // for users
    
    public function userManagement(){
        
        $user = User::get();
        $user = User::paginate(10);
        

        return view('admin.user',[
        "users"=>$user]);        
    }

    public function userEdit(Request $request){
        
        $status="";
        $users = User::where("id",$request->id)->first();
        
        if(isset($request->name)){
            $users->id =$request->id;
            $users->name = $request->name;
            $users->email = $request->email;
            
            $users->save();
            
            return redirect('admin/dashboard');
        }

        return view('admin.editUser',[
            "user"=>$users
        ]); // we use . instead of / for folder directory in laravel

    }

    public function userDelete(Request $request){
                
        $users = User::where("id",$request->id)->first();
        $users->delete();
        return redirect('admin/dashboard');
    }
    
}
