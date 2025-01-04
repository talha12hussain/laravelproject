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
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrianed()->onDelete('cascade');
            // $table->enum('type', ['rent', 'sell']);
            $table->integer('floorNo');
            $table->integer('suitNo');
            $table->integer('areaSqft');
            $table->integer('rateSqft');
            $table->string('type');
            $table->timestamps();

            $table->unique(['floorNo', 'suitNo', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floors');
    }
};
