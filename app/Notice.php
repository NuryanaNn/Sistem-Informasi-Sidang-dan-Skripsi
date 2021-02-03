<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model

{
    protected $primaryKey = 'id_pengumuman';
    public $incrementing = false;
    protected $table = 'notices';
    protected $fillable = [
        'judul', 'isi'
    ];
}
