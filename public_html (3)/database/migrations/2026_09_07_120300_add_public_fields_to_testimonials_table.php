<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->after('username');
            $table->string('vehicle')->nullable()->after('customer_name');
            $table->string('vehicle_brand')->nullable()->after('vehicle');
            $table->text('review')->nullable()->after('feedback');
            $table->unsignedTinyInteger('rating')->nullable()->after('review');
            $table->string('image')->nullable()->after('rating');
            $table->enum('status', ['yes', 'no'])->default('yes')->after('image');
            $table->unsignedInteger('sort_order')->default(0)->after('status');
            $table->index(['status', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex(['status', 'sort_order']);
            $table->dropColumn([
                'customer_name', 'vehicle', 'vehicle_brand', 'review',
                'rating', 'image', 'status', 'sort_order',
            ]);
        });
    }
};
