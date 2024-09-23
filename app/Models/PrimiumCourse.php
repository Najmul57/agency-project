<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimiumCourse extends Model
{
    use HasFactory;

    protected $guarded = [''];


    public function university()
    {
        return $this->belongsTo(PrimiumUniversity::class, 'university_id');
    }
      public function country()
    {
        return $this->belongsTo(PrimiumCountry::class, 'country_id');
    }
    public function universities()
    {
        return $this->belongsToMany(PrimiumUniversity::class, 'primium_university_courses', 'course_id', 'university_id');
    }

    public function countries()
    {
        return $this->belongsToMany(PrimiumCountry::class, 'course_country', 'course_id', 'country_id');
    }
    // In PrimiumCourse model
    public function programType()
    {
        return $this->belongsTo(ProgramType::class, 'program_type_id');
    }

}
