<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('reports', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('title');       
        $table->text('description');    
        $table->string('image')->nullable(); 
        $table->string('location');    
        $table->enum('status', ['PENDING', 'PROCESSED', 'COMPLETED', 'REJECTED'])->default('PENDING');
        $table->date('date_time')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
