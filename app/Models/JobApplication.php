<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    //
    public $guarded = [];
    public $with = ['job'];

    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_id', 'job_ref');
    }
}
