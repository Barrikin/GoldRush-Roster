<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSopSignOffsTable extends Migration
{
    public function up()
    {
        Schema::table('sop_sign_offs', function (Blueprint $table) {
            $table->unsignedBigInteger('officer_id')->nullable();
            $table->foreign('officer_id', 'officer_fk_9706320')->references('id')->on('users');
            $table->unsignedBigInteger('sop_id')->nullable();
            $table->foreign('sop_id', 'sop_fk_9706321')->references('id')->on('sops');
        });
    }
}
