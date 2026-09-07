<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('vehicle_name');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('vehicle_model')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['yes', 'no'])->default('yes');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->index(['status', 'sort_order']);
        });

        Schema::create('repair_project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_project_id')->constrained()->cascadeOnDelete();
            $table->enum('stage', ['before', 'during', 'after']);
            $table->string('image');
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['repair_project_id', 'stage', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_project_images');
        Schema::dropIfExists('repair_projects');
    }
};