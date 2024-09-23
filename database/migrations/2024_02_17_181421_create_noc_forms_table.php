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
        Schema::create('noc_forms', function (Blueprint $table) {
            $table->id();
            $table->string('system_id');
            $table->string('name');
            $table->string('f_name');
            $table->string('m_name');
            $table->string('passport');
            $table->string('address');
            $table->string('email');
            $table->string('number');
            $table->string('country');
            $table->string('university');
            $table->string('program_type');
            $table->string('department');
            $table->string('uni_course');
            $table->string('signature');
            $table->string('guirdiansignature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noc_forms');
    }
};
