<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRankPivotTable extends Migration
{
    public function up()
    {
        Schema::create('permission_rank', function (Blueprint $table) {
            $table->unsignedBigInteger('rank_id');
            $table->foreign('rank_id', 'rank_id_fk_9707819')->references('id')->on('ranks')->onDelete('cascade');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id', 'permission_id_fk_9707819')->references('id')->on('permissions')->onDelete('cascade');
        });
    }
}
