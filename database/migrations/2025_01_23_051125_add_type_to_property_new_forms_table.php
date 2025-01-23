<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPropertyNewFormsTable extends Migration
{
    public function up()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->string('type')->after('id'); // "type" کالم شامل کریں
        });
    }

    public function down()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->dropColumn('type'); // "type" کالم کو ہٹائیں
        });
    }
}
