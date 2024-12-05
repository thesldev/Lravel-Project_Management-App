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
        Schema::create('subtasks', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('issue_id')->constrained('backlog_issues'); // Foreign key referencing 'backlog_issues'
            $table->string('title', 255); // Title of the subtask
            $table->text('description')->nullable(); // Description, can be null
            $table->foreignId('assignee_id')->constrained('users'); // Foreign key referencing 'users'
            $table->enum('status', ['To Do', 'In Progress', 'Completed'])->default('To Do'); // Status of the subtask
            $table->unsignedBigInteger('created_by')->nullable()->default(null); // Foreign key referencing 'users'
            $table->timestamps(0); // Created and updated timestamps

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtasks');
    }
};
