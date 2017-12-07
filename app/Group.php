<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Student;
use App\Staffer;
use App\Section;

class Group extends Model
{
    public function students()
    {
    	return $this->hasMany('App\Student');
    }

    public function staffers()
    {
    	return $this->hasMany('App\Staffer');
    }

    public function courses()
    {
    	return $this->hasMany('App\Course');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function fees()
    {
        return $this->hasMany('App\Fee');
    }

    public function daily_activities()
    {
        return $this->hasMany('App\DailyActivity');
    }
}
