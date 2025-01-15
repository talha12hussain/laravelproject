<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLatitudeLongitudeFromPropertyNewFormsTable extends Migration
{
    public function up()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            // Remove latitude and longitude columns
            $table->dropColumn(['latitude', 'longitude']);
        });
    }

    public function down()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            // Add the columns back in case of rollback
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }
}


