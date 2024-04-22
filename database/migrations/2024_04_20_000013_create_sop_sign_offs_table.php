<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopSignOffsTable extends Migration
{
    public function up()
    {
        Schema::create('sop_sign_offs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('signed_off_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
