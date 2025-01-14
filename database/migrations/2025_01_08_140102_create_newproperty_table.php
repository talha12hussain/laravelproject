<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewpropertyTable extends Migration
{
    public function up()
    {
        Schema::create('newproperty', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('property_type');
            $table->json('property_types'); // New field for multiple property types
            $table->string('address'); // Add Address Field
            $table->string('floor');
            $table->string('city');
            $table->string('property_size');
            $table->string('property_unit');
            $table->string('nearest_landmark');
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('asking_price', 15, 2);
            $table->boolean('corner_property')->default(false);
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->string('contact_no');
            $table->string('agent_name')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('newproperty');
    }
}
