<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimiumUniversity extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // PrimiumUniversity.php

    public function country()
    {
        return $this->belongsTo(PrimiumCountry::class);
    }

    public function courses()
    {
        return $this->belongsToMany(PrimiumCourse::class, 'primium_university_courses', 'university_id', 'course_id');
    }


    public function university()
    {
        return $this->belongsTo(PrimiumUniversity::class, 'university_id');
    }

    public function programTypes()
    {
        return $this->belongsToMany(ProgramType::class)->withPivot('id');
    }
}
