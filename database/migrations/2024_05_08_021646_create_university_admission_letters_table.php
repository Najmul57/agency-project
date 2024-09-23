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
        Schema::create('university_admission_letters', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('admissionFees');
            $table->string('tuitionFees');
            $table->string('otherFees');
            $table->string('universityId');
            $table->string('referanceId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_admission_letters');
    }
};
