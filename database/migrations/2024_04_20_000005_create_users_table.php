<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('call_sign')->nullable()->unique();
            $table->string('name')->nullable();
            $table->integer('badge')->nullable()->unique();
            $table->string('status')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->date('hired_on')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
