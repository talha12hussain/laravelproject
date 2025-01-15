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
        // Add default values for latitude and longitude before altering the columns
        DB::table('property_new_forms')->whereNull('latitude')->update(['latitude' => '0']);
        DB::table('property_new_forms')->whereNull('longitude')->update(['longitude' => '0']);
    
        // Now modify the columns to not null
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->string('latitude')->nullable(false)->change();
            $table->string('longitude')->nullable(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->string('latitude')->nullable()->change();
            $table->string('longitude')->nullable()->change();
        });
    }
    
};
