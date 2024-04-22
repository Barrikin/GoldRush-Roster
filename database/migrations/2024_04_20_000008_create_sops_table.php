<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopsTable extends Migration
{
    public function up()
    {
        Schema::create('sops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('sop');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
