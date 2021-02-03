<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guidance extends Model
{
    protected $table = 'guidances';
    protected $primaryKey = 'id_bimbingan';
    public $incrementing =false;
}
