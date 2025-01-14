<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('newproperty', function (Blueprint $table) {
            $table->string('address')->nullable();  // Add address column
            $table->string('property_types')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newproperty', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('property_types');
        });
    }
};
