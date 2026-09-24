<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('popup_image')->nullable()->after('favicon_icon');
        });

        DB::table('company_settings')->whereNull('popup_image')->update([
            'popup_image' => 'images/viswakarma-puja-poster.webp',
        ]);
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn('popup_image');
        });
    }
};