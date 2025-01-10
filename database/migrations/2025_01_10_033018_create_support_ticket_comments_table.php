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
        Schema::create('support_ticket_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id'); // Foreign key referencing tickets table
            $table->unsignedBigInteger('user_id'); // Foreign key referencing users table
            $table->text('content'); // Content of the comment
            $table->unsignedBigInteger('parent_comment_id')->nullable(); // Optional parent comment for nested comments
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_ticket_comments');
    }
};
