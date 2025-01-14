<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNearestLandmarkNullableOnNewPropertiesTable extends Migration
{
    public function up()
    {
        Schema::table('newproperty', function (Blueprint $table) {
            // Update nearest_landmark column to be nullable
            $table->string('nearest_landmark')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('newproperty', function (Blueprint $table) {
            // Revert nearest_landmark column back to NOT NULL if rolled back
            $table->string('nearest_landmark')->nullable(false)->change();
        });
    }
}
