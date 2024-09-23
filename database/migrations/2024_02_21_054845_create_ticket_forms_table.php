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
        Schema::create('ticket_forms', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->date('travel_date');
            $table->string('travelby');
            $table->string('from');
            $table->string('to');
            $table->string('person');
            $table->string('passport');
            $table->string('visa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_forms');
    }
};
