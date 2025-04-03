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
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('entity_name');
            $table->string('password');
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('credentials')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
