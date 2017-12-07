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
use App\Course;
use App\School;
use File;

class SetUpController extends Controller
{
    
    public function schoolSetUp()
    {

        $school = School::first();
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups_count = Group::count();

        $students_count = Student::count();
        
        $staffers_count = Staffer::count();

        $courses_count = Course::count();

             

        return view('/admin.superadmin.schoolsetup', compact('school','today','schoolyear', 'groups_count','students_count', 'staffers_count', 'courses_count'));
    }

      public function update_logo(Request $request)

      {

        $school = School::first();
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $groups_count = Group::count();

        $students_count = Student::count();
        
        $staffers_count = Staffer::count();

        $courses_count = Course::count();

        

        // Handle the user upload of avatar
        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();

            // Delete current image before uploading new image
            if ($school->logo !== 'default_logo.jpg') {
                 $file = public_path('/assets/img/logo/' . $school->logo);

                if (File::exists($file)) {
                    unlink($file);
                }

            }

            Image::make($logo)->resize(300, 300)->save( public_path('/assets/img/logo/' . $filename ) );

           
            $school->logo = $filename;
            $school->save();
        }

        return view('/admin.superadmin.schoolsetup', compact('school','today','schoolyear', 'groups_count','students_count', 'staffers_count', 'courses_count'));

    }

        	
}
