<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTrainingsTable extends Migration
{
    public function up()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->unsignedBigInteger('officer_id')->nullable();
            $table->foreign('officer_id', 'officer_fk_9706307')->references('id')->on('users');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_9706308')->references('id')->on('courses');
            $table->unsignedBigInteger('understood_fto_id')->nullable();
            $table->foreign('understood_fto_id', 'understood_fto_fk_9706310')->references('id')->on('users');
            $table->unsignedBigInteger('executed_fto_id')->nullable();
            $table->foreign('executed_fto_id', 'executed_fto_fk_9706313')->references('id')->on('users');
        });
    }
}
