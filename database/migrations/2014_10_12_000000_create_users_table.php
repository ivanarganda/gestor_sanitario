<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('password', 100);
            $table->string('email', 200)->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->timestamps();
            $table->string('colegiate', 50)->nullable();
            $table->string('phone', 15)->nullable();
            $table->enum('role', ['staff', 'medico', 'user', 'enfermero']);
            $table->enum('activated', ['0', '1'])->default('0');
            $table->string('remember_token', 200)->nullable();
            $table->string('session_id', 200)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

