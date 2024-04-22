<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('officer_id')->nullable();
            $table->foreign('officer_id', 'officer_fk_9706294')->references('id')->on('users');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id', 'author_fk_9706295')->references('id')->on('users');
        });
    }
}
