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
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
    
};
