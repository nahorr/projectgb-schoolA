<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d');


        DB::table('terms')->insert(array(
             array('term'=>'1st Term','start_date'=>$now,'end_date'=>$now,'show_until'=>$now),
             array('term'=>'2nd Term','start_date'=>$now,'end_date'=>$now,'show_until'=>$now),
             array('term'=>'3rd Term','start_date'=>$now,'end_date'=>$now,'show_until'=>$now),
             

          ));
    }
}
