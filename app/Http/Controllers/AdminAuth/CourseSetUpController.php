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
use DB;
use App\Course;
use Excel;

class CourseSetUpController extends Controller
{
    public function showCoursesTerms()
    {
    	//get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $terms = Term::get();

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.showcoursesterms', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear', 'terms'));
    }

    public function showCoursesGroups($term_id)
    {

       	$term = Term::find($term_id);

       	$groups = Group::get();


        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();


        
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

        $courses= Course::where('term_id', '=', $term->id)->first();
        
    

        return view('/admin.superadmin.schoolsetup.showcoursesgroups', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear','groups', 'term', 'courses'));
    }

    public function showCourses($group_id, $term_id)
    {

       
        $group = Group::find($group_id);
        $term = Term::find($term_id);
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $courses = Course::where('group_id', '=', $group->id)
        					->where('term_id', '=', $term->id)
        					->get();

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

        //get all teachers
        $staffers = Staffer::get();

        return view('/admin.superadmin.schoolsetup.showcourses', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear','group', 'term', 'courses', 'staffers'));
    }

    public function addCourse($group_id, $term_id)
    {

    	$group = Group::find($group_id);
        $term = Term::find($term_id);
        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $courses = Course::where('group_id', '=', $group->id)
        					->where('term_id', '=', $term->id)
        					->get();

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.addcourse', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear','group', 'term', 'courses'));
    }

    public function postCourse(Request $r, $group_id, $term_id) 
    {

               

        $this->validate(request(), [

            'term_id' => 'required',
            'group_id' => 'required',
            'course_code' => 'required|unique:courses',
            'name' => 'required',
            
            

            ]);


        Course::insert([

            'term_id'=>$r->term_id,
    		'group_id'=>$r->group_id,
            'course_code'=>$r->course_code,
            'name'=>$r->name,
            'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
                              
            
        ]);

        $group = Group::find($group_id);
        $term = Term::find($term_id);

       
        flash('Course Added Successfully')->success();

        
        return redirect()->route('showcourses', ['group_id' => $group->id, 'term_id' => $term->id ]);
    }

    public function editCourse($id, $group_id, $term_id)
    {

        $course = Course::find($id);
        $group = Group::find($group_id);
        $term = Term::find($term_id);
         //get current date
        $today = Carbon::today();

        

       
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

                
        
        return view('/admin.superadmin.schoolsetup.editcourse', compact('today', 'teacher', 'teacher_logged_in', 'course', 'group', 'term'));
    }



        public function postCourseUpdate(Request $r, $id, $group_id, $term_id)

        {
             $this->validate(request(), [

            'term_id' => 'required',
            'group_id' => 'required',
            'course_code' => 'required',
            'name' => 'required',
                
                ]);

            $course = Course::find($id);
            $group = Group::find($group_id);
	        $term = Term::find($term_id);
	         //get current date
	        $today = Carbon::today();

	        

	       
	        //get logged in user
	        $teacher_logged_in = Auth::guard('web_admin')->user();

	        
	        $reg_code = $teacher_logged_in->registration_code;

	        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

                    
            $course_edit = Course::where('id', '=', $course->id)->first();


            
            $course_edit->course_code= $r->course_code;
            $course_edit->name= $r->name;
            
              

            $course_edit->save();

            flash('Course Updated Successfully')->success();

            return redirect()->route('showcourses', ['group_id' => $group->id, 'term_id' => $term->id ]);


         }

         public function deleteCourse($id)
         {
            Course::destroy($id);

            flash('Course has been deleted')->error();

            return back();
         }


        public function importCourses(Request $request, $group_id, $term_id)
        {
           
            $group = Group::find($group_id);
            $term = Term::find($term_id);

            if($request->hasFile('import_file')){
                $path = $request->file('import_file')->getRealPath();

                $data = Excel::load($path, function($reader) {})->get();

                if(!empty($data) && $data->count()){

                    foreach ($data->toArray() as $key => $value) {
                        if(!empty($value)){
                            foreach ($value as $v) {        
                                $insert[] = [

                                    'term_id' => $term->id,
                                    'group_id' => $group->id,
                                    'course_code' => $v['course_code'], 
                                    'name' => $v['name'],
                                    'staffer_id' => $v['staffer_id'],
                                    ];
                            }
                        }
                    }

                    
                    if(!empty($insert)){
                        Course::insert($insert);
                        return back()->with('success','Insert Record successfully.');
                    }

                }

            }

            return back()->with('error','Please Check your file, Something is wrong there.');
        }



    
}
