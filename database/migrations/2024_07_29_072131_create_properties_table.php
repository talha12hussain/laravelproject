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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->decimal('plotSize', 8, 2);
            $table->decimal('dimFront',8,2);
            $table->decimal('dimWidth', 8,2);
            $table->string('totalSize');
             $table->decimal('leasedArea', 8,2);
             $table->string('nearestLand');
             $table->string('corner');
            //  $table->integer('floorNo');
            //  $table->integer('suitNo');
            //  $table->decimal('areaSqft', 8, 2);
            // $table->decimal('rateSqft', 8, 2);
            $table->integer('parkingcap');
            $table->decimal('demandSqft', 8, 2);
            $table->decimal('absValue', 8, 2);
            $table->string('agentname');
            $table->bigInteger('agentcontact');
            $table->text('agentdetail');
            $table->string('contactPerson');
            $table->string('file_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};           
