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
            $table->unsignedBigInteger('agent_id')->nullable()->change(); // اگر یہ پہلے سے unsigned نہ ہو
            $table->foreign('agent_id') // فارن کی شامل کرنا
                  ->references('id')
                  ->on('agents')
                  ->onDelete('cascade') // اگر ایجنٹ ڈیلیٹ ہو تو متعلقہ پراپرٹیز بھی ڈیلیٹ ہو جائیں
                  ->onUpdate('cascade'); // اگر ایجنٹ اپڈیٹ ہو تو پراپرٹیز اپڈیٹ ہوں
        });
    }
    
    public function down()
    {
        Schema::table('property_new_forms', function (Blueprint $table) {
            $table->dropForeign(['agent_id']); // فارن کی ہٹانا
        });
    }
    
};
