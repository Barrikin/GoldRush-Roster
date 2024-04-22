<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinariesTable extends Migration
{
    public function up()
    {
        Schema::create('disciplinaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('comment')->nullable();
            $table->integer('points');
            $table->datetime('expire_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
