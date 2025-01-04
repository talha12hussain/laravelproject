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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('agencyName');
            $table->longText('agencyAddress')->nullable();
            $table->string('agencyCity');
            $table->string('memName');
            $table->decimal('memNumber');
            $table->string('agentName');
            $table->string('agentminName');
            $table->string('agentlastName');
            $table->decimal('cnicNum',13);
            $table->date('cnicExp');
            $table->string('agentProfile');
            $table->string('agentCertificate');
            $table->string('cnicVerify');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
