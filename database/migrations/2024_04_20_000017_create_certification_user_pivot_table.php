<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('certification_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9706326')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('certification_id');
            $table->foreign('certification_id', 'certification_id_fk_9706326')->references('id')->on('certifications')->onDelete('cascade');
        });
    }
}
