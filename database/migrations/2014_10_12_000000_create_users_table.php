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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('system_id')->unique();
            $table->integer('status')->default(0);
            $table->integer('role_id')->default(2);
            $table->string('name');
            $table->string('referance_number')->nullable();
            $table->string('email')->unique();
            $table->string('country')->nullable();
            $table->string('is_primium')->nullable();
            $table->string('amount')->nullable();
            $table->string('method')->nullable();
            $table->string('txt_number')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->unique();
            $table->string('regis__country')->nullable();
            $table->string('regis__university')->nullable();
            $table->string('regis__program')->nullable();
            $table->string('regis__course')->nullable();
            $table->string('regis__uni__course')->nullable();
            $table->string('cgpa')->nullable();
            $table->string('o_level')->nullable();
            $table->string('a_level')->nullable();
            $table->string('graduate')->nullable();
            $table->string('post_graduate')->nullable();
            $table->string('nid')->nullable();
            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->string('others')->nullable();
            $table->string('f_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('dob')->nullable();
            $table->text('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
