<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sprint_activities', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('sprint_id')->constrained('sprints'); // Foreign key referencing 'sprints'
            $table->foreignId('issue_id')->constrained('backlog_issues'); // Foreign key referencing 'backlog_issues'
            $table->enum('action', ['Added to Sprint', 'Removed from Sprint', 'Status Updated']); // Action performed
            $table->foreignId('performed_by')->constrained('users'); // Foreign key referencing 'users'
            $table->timestamp('performed_at')->default(DB::raw('CURRENT_TIMESTAMP')); // Timestamp for when the action was performed
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sprint_activities');
    }
};
