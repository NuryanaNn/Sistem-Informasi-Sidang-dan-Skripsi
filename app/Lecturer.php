<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $primaryKey = 'nidn';
    public $incrementing = false;
}
