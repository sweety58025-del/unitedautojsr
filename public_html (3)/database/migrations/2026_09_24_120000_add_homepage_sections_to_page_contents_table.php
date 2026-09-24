<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_contents', function (Blueprint $table) {
            $table->json('trust_items')->nullable();
            $table->json('hero_stats')->nullable();
            $table->json('faq_items')->nullable();
            $table->json('why_choose_items')->nullable();
            $table->json('showcase_items')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('page_contents', function (Blueprint $table) {
            $table->dropColumn([
                'trust_items',
                'hero_stats',
                'faq_items',
                'why_choose_items',
                'showcase_items',
            ]);
        });
    }
};