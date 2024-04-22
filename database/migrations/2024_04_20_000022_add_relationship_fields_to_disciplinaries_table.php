<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDisciplinariesTable extends Migration
{
    public function up()
    {
        Schema::table('disciplinaries', function (Blueprint $table) {
            $table->unsignedBigInteger('officer_id')->nullable();
            $table->foreign('officer_id', 'officer_fk_9706278')->references('id')->on('users');
            $table->unsignedBigInteger('issued_by_id')->nullable();
            $table->foreign('issued_by_id', 'issued_by_fk_9706280')->references('id')->on('users');
        });
    }
}
