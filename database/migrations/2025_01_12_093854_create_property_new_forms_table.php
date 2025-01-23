<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyNewFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_new_forms', function (Blueprint $table) {
            $table->id();
            $table->string('property_type'); // plot, commercial, residential
            $table->string('city');
            $table->string('property_types')->nullable(); // plot type, commercial type, etc.
            $table->string('address')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->string('floor')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->string('property_size')->nullable();
            $table->decimal('asking_price', 15, 2)->nullable();
            $table->enum('corner_property', ['yes', 'no'])->default('no'); // Update this field
            $table->json('images')->nullable(); // Store images as JSON
            $table->string('contact_no');
            $table->string('agent_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_new_forms');
    }
}
