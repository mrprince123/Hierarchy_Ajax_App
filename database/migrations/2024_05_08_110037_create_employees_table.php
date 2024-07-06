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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('profile_pic');
            $table->string('mobile_number');
            $table->string('parents_name');
            $table->string('current_address');
            $table->string('parmanent_address');
            $table->string('adhar_number');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->string('emergency_contact_no');
            $table->string('email');
            $table->string('age');
            $table->unsignedBigInteger('roles_id');
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('highest_qualification', ['10th', '12th', 'ug', 'pg']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
