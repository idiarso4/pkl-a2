<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pkl_internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('guru_pembimbing_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('office_id')->nullable()->constrained('offices')->onDelete('set null');
            
            // Informasi perusahaan
            $table->string('company_leader')->nullable();
            $table->string('company_type')->nullable();
            $table->string('company_phone')->nullable();
            $table->text('company_description')->nullable();
            
            // Informasi PKL
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pkl_internships');
    }
}; 