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
        Schema::create('job_application', function (Blueprint $table) {
            $table->foreignId('user_id')->index();
            $table->foreign('user_id')->references('user_id')->on('users')->CascadeOnDelete();
            $table->foreignId('job_id')->index();
            $table->foreign('job_id')->references('job_id')->on('jobs')->CascadeOnDelete();
            $table->primary(['user_id', 'job_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_application');
    }
};
