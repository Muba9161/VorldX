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
        Schema::table('folders', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Add foreign key for user
        });
    }

    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropColumn('user_id'); // Remove the user_id column if needed
        });
    }
};
