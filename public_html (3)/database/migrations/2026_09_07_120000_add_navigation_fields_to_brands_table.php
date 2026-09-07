<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->unsignedInteger('sort_order')->default(0)->after('image');
            $table->enum('status', ['yes', 'no'])->default('yes')->after('sort_order');
            $table->index(['status', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropIndex(['status', 'sort_order']);
            $table->dropColumn(['slug', 'sort_order', 'status']);
        });
    }
};