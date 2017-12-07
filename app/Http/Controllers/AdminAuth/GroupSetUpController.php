<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\School_year;
use App\Event;
use App\Term;
use Carbon\Carbon;

use App\Http\Requests;
use Auth;
use Image;
use App\Student;
use App\Group;
use App\Staffer;
use App\User;

class GroupSetUpController extends Controller
{
    public function showGroups()
    {

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups = Group::get();

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.showgroups', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear', 'groups'));
    }

    public function addGroup()
    {

    	//get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups = Group::get();

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.addgroup', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear', 'groups'));
    }

    public function postGroup(Request $r) 
    {

               

        $this->validate(request(), [

            'name' => 'required|unique:groups',
            

            ]);


        Group::insert([

            'name'=>$r->name,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),                   
            
        ]);

       
        flash('Group Added Successfully')->success();

        return redirect('/schoolsetup/showgroups');
    }




    public function editGroup($id)
    {

       //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $group = Group::find($id);

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.editgroup', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear', 'group'));
    }



        public function postGroupUpdate(Request $r, $id)

        {
             $this->validate(request(), [

                
                'name' => 'required',
                
                ]);


            //get current date
	        $today = Carbon::today();

	        $schoolyear = School_year::first();

	        $group = Group::find($id);

	    
	        //get logged in user
	        $teacher_logged_in = Auth::guard('web_admin')->user();

	        
	        $reg_code = $teacher_logged_in->registration_code;

	        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

	         $group_edit = Group::where('id', '=', $group->id)->first();


            
            $group_edit->name= $r->name;
            
              

            $group_edit->save();

            flash('Group Updated Successfully')->success();

            return back();


         }

         public function deleteGroup($id)
         {
            Group::destroy($id);

            flash('Group has been deleted')->error();

            return back();
         }
}
