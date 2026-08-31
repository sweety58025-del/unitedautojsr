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
        Schema::create('about_websites', function (Blueprint $table) {
            $table->id();
            $table->string('about_title')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('about_image')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();

            $table->string('why_choose_title_1')->nullable();
            $table->text('why_choose_content_1')->nullable();

            $table->string('why_choose_title_2')->nullable();
            $table->text('why_choose_content_2')->nullable();

            $table->string('why_choose_title_3')->nullable();
            $table->text('why_choose_content_3')->nullable();

            $table->string('why_choose_title_4')->nullable();
            $table->text('why_choose_content_4')->nullable();

            $table->text('service_terms')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_websites');
    }
};
