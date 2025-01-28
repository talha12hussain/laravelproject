<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgentIdToPropertyNewFormsTable extends Migration
{
    public function up()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->integer('agent_id')->nullable();  // یہ کالم ایڈ کرے گا
        });
    }

    public function down()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->dropColumn('agent_id');  // یہ کالم ہٹائے گا
        });
    }
}
