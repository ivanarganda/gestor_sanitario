<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 50);
            $table->string('user_agent', 200);
            $table->dateTime('login_time')->nullable();
            $table->dateTime('logout_time')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['0', '1']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
