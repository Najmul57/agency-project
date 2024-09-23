<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NocForm extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function country()
    {
        return $this->belongsTo(PrimiumCountry::class, 'country_id');
    }

    public function university()
    {
        return $this->belongsTo(PrimiumUniversity::class, 'university_id');
    }
    public function type()
    {
        return $this->belongsTo(ProgramType::class, 'program_type');
    }
    public function department()
    {
        return $this->belongsTo(PrimiumCourse::class, 'department');
    }
    public function unicourse()
    {
        return $this->belongsTo(PrimiumUniversityCourse::class, 'uni_course');
    }

   
}
