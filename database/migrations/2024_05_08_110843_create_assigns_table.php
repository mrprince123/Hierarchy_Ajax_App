<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assigns', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade'); // Employee Name

            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');  // Under Assigned To role ( FM )

            $table->unsignedBigInteger('under_employee_id')->nullable();
            $table->foreign('under_employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade'); // List of the FM


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigns');
    }
};
