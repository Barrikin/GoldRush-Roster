<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('understood')->default(0)->nullable();
            $table->datetime('understood_at')->nullable();
            $table->boolean('executed')->default(0)->nullable();
            $table->datetime('executed_at')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
