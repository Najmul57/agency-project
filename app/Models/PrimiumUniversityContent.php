<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimiumUniversityContent extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function universityCourse()
    {
        return $this->belongsTo(PrimiumUniversityCourse::class, 'universitycourse_id');
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
    public function course()
    {
        return $this->belongsTo(PrimiumCourse::class, 'course_id');
    }
}
