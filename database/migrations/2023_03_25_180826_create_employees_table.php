<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('job_title');
            $table->longText('job_description');
            $table->string('gender');
            $table->string('nid');
            $table->string('bloop_group')->nullable();
            $table->string('photo')->nullable();
            $table->date('hire_date');
            $table->date('leave_date')->nullable();
            $table->date('dob');
            $table->longText('note');
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
