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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by'); 
            $table->string('creator_email'); 
            $table->string('title'); 
            $table->text('body'); 
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); 
            $table->string('service')->nullable(); 
            $table->timestamps(); 
            $table->softDeletes(); 

            // Foreign key constraint
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
