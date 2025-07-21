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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
             $table->string('title');
             $table->text('description')->nullable();
             $table->string('image')->nullable();
             $table->enum('priority', ['low', 'medium', 'high'])->default('low');

              $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');
              $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // User who created
              $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('cascade'); // Assigned user

             $table->timestamp('assigned_at')->nullable();
             $table->timestamp('completed_at')->nullable();

             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
