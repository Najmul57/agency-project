<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class ProgramType extends Model
    {
    use HasFactory;

    protected $guarded = [''];

    public function typeList(){
        return $this->belongsTo(ProgramTypeList::class);
    }

    public function university()
    {
        return $this->belongsTo(PrimiumUniversity::class, 'university_id');
    }
    public function universities()
    {
        return $this->belongsToMany(PrimiumUniversity::class, 'primium_university_courses', 'course_id', 'university_id');
    }

    public function programtype()
    {
        return $this->belongsTo(ProgramType::class, 'programtype_id');
    }

    public function course()
    {
        return $this->belongsTo(PrimiumCourse::class, 'course_id');
    }

    public function countries()
    {
        return $this->belongsToMany(PrimiumCountry::class, 'course_country', 'course_id', 'country_id');
    }
}
