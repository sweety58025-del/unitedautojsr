<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->text('intro')->nullable();
            $table->longText('body')->nullable();
            $table->string('section_one_title')->nullable();
            $table->longText('section_one_body')->nullable();
            $table->string('section_two_title')->nullable();
            $table->longText('section_two_body')->nullable();
            $table->string('section_three_title')->nullable();
            $table->longText('section_three_body')->nullable();
            $table->string('section_four_title')->nullable();
            $table->longText('section_four_body')->nullable();
            $table->json('list_items')->nullable();
            $table->string('hours_title')->nullable();
            $table->json('hours_items')->nullable();
            $table->string('pricing_title')->nullable();
            $table->json('pricing_items')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
