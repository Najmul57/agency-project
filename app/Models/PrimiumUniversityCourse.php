<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimiumUniversityCourse extends Model
{
    use HasFactory;

    protected $guarded = [''];
    public function course()
    {
        return $this->belongsTo(PrimiumCourse::class, 'course_id');
    }
    public function programtype()
    {
        return $this->belongsTo(ProgramType::class, 'programtype_id', 'id');
    }
    public function program()
    {
        return $this->belongsTo(ProgramType::class, 'program_type_id', 'id');
    }

    public function university()
    {
        return $this->belongsTo(PrimiumUniversity::class, 'university_id');
    }
    public function country()
    {
        return $this->belongsTo(PrimiumCountry::class, 'country_id');
    }
}
