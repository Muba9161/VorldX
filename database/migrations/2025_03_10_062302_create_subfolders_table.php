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
        Schema::create('subfolders', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the subfolder
            $table->foreignId('folder_id')->constrained()->onDelete('cascade'); // Reference to the folders table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who owns the subfolder (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subfolders');
    }
};
