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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->enum('priority', ['Low', 'Medium', 'High', 'Critical'])->default('Low');
            $table->enum('status', ['Open', 'In Progress', 'On Hold', 'Resolved', 'Closed'])->default('Open');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
