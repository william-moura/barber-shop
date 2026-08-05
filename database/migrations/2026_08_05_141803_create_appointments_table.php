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
        Schema::create('appointments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('tenant_id')->constrained('tenants')->onDelete('cascade');
            
            // Chaves estrangeiras com integridade referencial
            $table->foreignUlid('barber_id')->constrained('barbers')->onDelete('cascade');
            $table->foreignUlid('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignUlid('service_id')->constrained('services')->onDelete('cascade');
            
            // Armazenamento do TimeSlot do DDD
            $table->dateTime('start_time')->index();
            $table->dateTime('end_time')->index();
            
            // Status do fluxo de atendimento
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
