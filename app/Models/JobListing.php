<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobListing extends Model
{
    //
    public $guarded = [];
    // 
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $digits = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2);

            $model->job_ref = 'FJB-' . $digits . '-' . $letters;
        });
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    // public function applications(): HasMany
    // {
    //     return $this->hasMany(JobApplication::class);
    // }
}
