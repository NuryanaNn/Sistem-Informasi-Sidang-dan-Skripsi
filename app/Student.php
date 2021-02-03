<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
    protected $primaryKey = 'nim';
    public $incrementing = false;
}
