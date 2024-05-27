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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('teacher_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('laboratory_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->enum('state_loan',['on_loan','delivered'])->default('on_loan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
