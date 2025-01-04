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
        schema::table('properties', function(Blueprint $table){

            $table->enum('plot_type', ['commercial', 'warehouse', 'shop', 'showroom'])->nullable();
            $table->enum('size_type', ['sq_yard', 'acre', 'sq_fit'])->nullable();
        });

        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        scheme::table('properties', function (Bluprint $table){
                $table->dropColumn('plot_type');
                $table->dropColumn('size_type');
        });
    }
};
