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
        Schema::create('todolist_missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('todolist_id')->constrained('todolists')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('mission_id')->constrained('missions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todolist_missions');
    }
};
