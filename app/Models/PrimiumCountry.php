<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimiumCountry extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function universities()
    {
        return $this->hasMany(PrimiumUniversity::class,'country_id');
    }
    public function courses()
    {
        return $this->belongsToMany(PrimiumCourse::class, 'course_country', 'country_id', 'course_id');
    }

}
