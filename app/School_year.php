<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School_year extends Model
{
    //protected $dateFormat = 'Y-m-d H:i';

    protected $dates = ['start_date', 'end_date'];
    
}