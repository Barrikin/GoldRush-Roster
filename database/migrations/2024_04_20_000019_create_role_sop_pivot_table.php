<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleSopPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_sop', function (Blueprint $table) {
            $table->unsignedBigInteger('sop_id');
            $table->foreign('sop_id', 'sop_id_fk_9706287')->references('id')->on('sops')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_9706287')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
