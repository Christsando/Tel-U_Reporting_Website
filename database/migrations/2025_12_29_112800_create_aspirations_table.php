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
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title', 120);
            $table->text('content');
            $table->string('topic');
            $table->boolean('is_anonymous')->default(false);
<<<<<<< HEAD
            $table->enum('status', ['submitted', 'reviewed', 'accepted', 'rejected'])->default('submitted');
=======
            $table->enum('status', [
                'PENDING',
                'ACCEPTED',
                'ONPROGRESS',
                'DONE',
                'REJECTED'
            ])->default('PENDING');
>>>>>>> 3b40798c9fcfb82255f8e61a115e5ab14eddb430
            $table->text('admin_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
