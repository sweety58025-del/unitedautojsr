<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('brands')->where('slug', 'maruti')->update([
            'image' => 'images/logo-brands/suzuki.png',
        ]);

        DB::table('brands')->where('slug', 'tata-motors')->update([
            'image' => 'images/logo-brands/tata.png',
        ]);

        DB::table('brands')->whereIn('slug', ['honda', 'skoda'])->update([
            'status' => 'no',
        ]);
    }

    public function down(): void
    {
        DB::table('brands')->where('slug', 'maruti')->update([
            'image' => 'images/logo-brands/maruti.png',
        ]);

        DB::table('brands')->where('slug', 'tata-motors')->update([
            'image' => 'images/logo-brands/tata-motors.png',
        ]);

        DB::table('brands')->whereIn('slug', ['honda', 'skoda'])->update([
            'status' => 'yes',
        ]);
    }
};
