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
        Schema::create('services_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('url');
            $table->string('api_url');
            $table->boolean('status');
            $table->timestamps();
        });
        Schema::create('services_network_operators', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('network_id');
            $table->string('provider_network');
            $table->timestamps();
            
            $table->foreign('provider_id')->references('id')
                ->on('services_providers')->onDelete('cascade');
            
            $table->foreign('network_id')->references('id')
                ->on('network_operators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_providers');
        Schema::dropIfExists('services_network_operators');
    }
};
