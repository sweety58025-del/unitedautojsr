<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->text('description')->nullable()->after('slug');
            $table->enum('status', ['yes', 'no'])->default('yes')->after('notes');
            $table->unsignedInteger('sort_order')->default(0)->after('status');
            $table->index(['status', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['status', 'sort_order']);
            $table->dropColumn(['slug', 'description', 'status', 'sort_order']);
        });
    }
};
