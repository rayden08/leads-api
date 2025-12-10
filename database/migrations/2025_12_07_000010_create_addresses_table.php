<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('province_code');
            $table->string('city_code');
            $table->string('district_code');
            $table->string('village_code');
            $table->string('postal_code')->nullable();
            $table->text('full_address');
            $table->timestamps();
            
            $table->foreign('province_code')->references('code')->on('provinces');
            $table->foreign('city_code')->references('code')->on('cities');
            $table->foreign('district_code')->references('code')->on('districts');
            $table->foreign('village_code')->references('code')->on('villages');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};