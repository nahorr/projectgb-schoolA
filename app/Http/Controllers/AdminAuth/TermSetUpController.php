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

class TermSetUpController extends Controller
{

	public function showTerms()
    {

        //get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $terms = Term::get();

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.showterms', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear', 'terms'));
    }

    
    public function addTerm()
    {

    	//get current date
        $today = Carbon::today();

        $schoolyear = School_year::first();

        $term = Term::get();

    
        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

      

        return view('/admin.superadmin.schoolsetup.addterm', compact('today', 'teacher', 'teacher_logged_in', 'schoolyear', 'term'));
    }

     public function postTerm(Request $r) 
    {

               

        $this->validate(request(), [

            'term' => 'required|unique:terms',
            'start_date' => 'required|unique:terms',
            'end_date'=> 'required|unique:terms',
            'show_until'=> 'required|unique:terms',

            ]);


        Term::insert([

            'term'=>$r->term,
            'start_date'=>$r->start_date,
            'end_date'=>$r->start_date,
            'show_until'=>$r->show_until,                   
            
        ]);

       
        flash('Term Added Successfully')->success();

        return redirect('/schoolsetup/showterms');
    }

    
    
    public function editTerm($id)
    {

         //get current date
        $today = Carbon::today();

        $term = Term::find($id);

        //get logged in user
        $teacher_logged_in = Auth::guard('web_admin')->user();

        
        $reg_code = $teacher_logged_in->registration_code;

        $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

                
        $term_edit = Term::where('id', '=', $term->id)->first();


        return view('/admin.superadmin.schoolsetup.editterm', compact('today', 'teacher', 'teacher_logged_in', 'term', 'term_edit'));
    }



        public function postTermUpdate(Request $r, $id)

        {
             $this->validate(request(), [

                
                'start_date' => 'required',
                'end_date'=> 'required',
                'show_until'=> 'required',
                
                ]);


            //get current date
            $today = Carbon::today();

            $term = Term::find($id);

            //get logged in user
            $teacher_logged_in = Auth::guard('web_admin')->user();

            
            $reg_code = $teacher_logged_in->registration_code;

            $teacher = Staffer::where('registration_code', '=', $reg_code)->first();

                    
            $term_edit = Term::where('id', '=', $term->id)->first();


            
            $term_edit->start_date= $r->start_date;
            $term_edit->end_date= $r->end_date;
            $term_edit->show_until= $r->show_until;
              

            $term_edit->save();

            flash('Term Updated Successfully')->success();

            return back();


         }

         public function deleteTerm($id)
         {
            Term::destroy($id);

            flash('Term has been deleted')->error();

            return back();
         }

    	
}
