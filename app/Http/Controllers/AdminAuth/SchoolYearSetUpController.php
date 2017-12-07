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


class SchoolYearSetUpController extends Controller
{
    public function showSchoolYear()
    {

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

              

        return view('/admin.superadmin.schoolsetup.showschoolyear', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear'));
    }

    
    
    public function editSchoolYear($id)
    {

         //get current date
        $today = Carbon::today();

        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

        $school_year = School_year::find($id);

        
        $school_year_edit = School_year::where('id', '=', $school_year->id)
                                       ->first();
        

        return view('/admin.superadmin.schoolsetup.editschoolyear', compact('today', 'teacher', 'teacher_logged_in', 'school_year', 'school_year_edit'));
    }



        public function postSchoolYearUpdate(Request $r, $id)

    {
         $this->validate(request(), [

            'school_year' => 'required',
            'start_date' => 'required',
            'end_date'=> 'required',
            
            ]);


         //get current date
        $today = Carbon::today();

        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

        $school_year = School_year::find($id);

        
        $school_year_edit = School_year::where('id', '=', $school_year->id)
                                       ->first();

               

            $school_year_edit->school_year= $r->school_year;
            $school_year_edit->start_date= $r->start_date;
            $school_year_edit->end_date= $r->end_date;
            
          

            $school_year_edit->save();

            flash('School Year Updated Successfully')->success();

            return back();

            
            
            


     }
}
