<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class University extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'university_course', 'university_id', 'course_id');
    }
    public function unicourse()
    {
        return $this->hasMany(UniversityCourse::class, 'university_id');
    }

}
