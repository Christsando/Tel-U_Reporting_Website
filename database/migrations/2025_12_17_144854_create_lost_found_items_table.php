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
        Schema::create('lost_found_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('category_id')->nullable();
        $table->string('title');
        $table->text('description');
        $table->string('image')->nullable();
        $table->string('location');
        $table->enum('type', ['LOST', 'FOUND']);
        $table->enum('status', ['OPEN', 'CLAIMED', 'RESOLVED'])->default('OPEN');
        $table->date('date_event');
        $table->timestamps(); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_found_items');
        Schema::dropIfExists('category');
    }
};
