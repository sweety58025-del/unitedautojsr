<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->enum('status', ['yes', 'no'])->default('yes');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });

        $now = now();
        DB::table('articles')->insert([
            [
                'title' => 'Top 5 Car Maintenance Tips for Summer',
                'slug' => 'top-5-car-maintenance-tips-for-summer',
                'excerpt' => 'Keep your vehicle running smoothly during hot summer months with our expert maintenance tips and advice.',
                'content' => "Hot weather can put extra stress on your vehicle. Check your coolant levels, inspect your tyres, keep the battery clean, replace worn wipers, and follow the service schedule to keep your car dependable through the summer.",
                'image' => 'images/blog/1.webp',
                'status' => 'yes',
                'published_at' => '2026-08-24',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Understanding Paint Protection Film (PPF)',
                'slug' => 'understanding-paint-protection-film-ppf',
                'excerpt' => 'Learn why PPF helps preserve your car paint and protect against scratches and road damage.',
                'content' => "Paint Protection Film is a clear, durable layer applied to vulnerable painted surfaces. It helps protect against stone chips, light scratches, and everyday road debris while keeping the original finish visible.",
                'image' => 'images/blog/2.webp',
                'status' => 'yes',
                'published_at' => '2026-08-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Ceramic Coating: Is It Worth the Investment?',
                'slug' => 'ceramic-coating-is-it-worth-the-investment',
                'excerpt' => 'Explore the benefits of ceramic coating and its long-lasting protection for your vehicle paint.',
                'content' => "Ceramic coating creates a bonded protective layer that makes a vehicle easier to clean and helps preserve its finish. The best results come from careful paint preparation and professional application.",
                'image' => 'images/blog/3.webp',
                'status' => 'yes',
                'published_at' => '2026-08-18',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};