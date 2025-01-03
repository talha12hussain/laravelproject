<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('city');
            $table->string('address');
            $table->string('nearest_landmarks')->nullable();
            $table->enum('corner', ['Yes', 'No']);
            $table->string('size');
            $table->decimal('asking_price', 15, 2);
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('contact_number');
            $table->string('agent_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
