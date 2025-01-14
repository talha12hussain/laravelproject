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
        Schema::table('newproperty', function (Blueprint $table) {
            $table->dropColumn('property_unit');
        });
    }
    
    public function down()
    {
        Schema::table('newproperty', function (Blueprint $table) {
            $table->string('property_unit')->nullable(); // Ya jo type tha
        });
    }
    
};
