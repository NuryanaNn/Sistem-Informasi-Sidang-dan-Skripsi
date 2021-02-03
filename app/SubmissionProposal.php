<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionProposal extends Model
{
    protected $primaryKey = 'id_pp';
    public $incrementing = false;
    protected $table = 'submissions_proposal';
}
