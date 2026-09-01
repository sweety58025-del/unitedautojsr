<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Step 1: Service
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->string('service_name'); // snapshot, in case service is later renamed/removed
            $table->decimal('service_price', 10, 2)->nullable();

            // Step 2: Vehicle
            $table->string('vehicle_make_model');
            $table->string('registration_number');

            // Step 3: Date & Time
            $table->date('appointment_date');
            $table->string('appointment_time'); // stored as display string e.g. "10:30 AM"

            // Step 4: Customer Info
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->string('service_reason')->nullable();
            $table->string('preferred_contact_method')->default('phone');
            $table->text('additional_issues')->nullable();

            // Status tracking (managed from admin backend)
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
