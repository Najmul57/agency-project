<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visa_forms', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('pdf_path')->nullable();
            $table->string('full_name');
            $table->string('f_name');
            $table->string('m_name');
            $table->date('dob');
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('spouse_name')->nullable();
            $table->string('personal_mobile');
            $table->string('father_mobile');
            $table->string('email');
            $table->string('embassy');
            $table->date('embassy_date');
            $table->string('expected_date');
            $table->string('travel_history');
            $table->string('travel_amother_country');
            $table->string('father_profession');
            $table->string('through_border');
            $table->string('nid');
            $table->string('passport');
            $table->string('admission_letter');
            $table->string('pre_travel_history');
            $table->string('f_profession_proof');
            $table->string('photo_scan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_forms');
    }
};
