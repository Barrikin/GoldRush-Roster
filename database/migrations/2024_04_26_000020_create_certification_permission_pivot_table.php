<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationPermissionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('certification_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('certification_id');
            $table->foreign('certification_id', 'certification_id_fk_9727384')->references('id')->on('certifications')->onDelete('cascade');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id', 'permission_id_fk_9727384')->references('id')->on('permissions')->onDelete('cascade');
        });
    }
}
