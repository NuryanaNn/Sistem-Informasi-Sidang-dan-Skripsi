<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramStudy extends Model
{
    protected $primaryKey = 'id_jurusan';
    public $incrementing = false;
    protected $table = 'program_study';
}
