<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\RepairProject;
use App\Models\RepairProjectImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_and_content_pages_load(): void
    {
        $this->get(route('home'))->assertOk();
        $this->get(route('brands'))->assertOk();
        $this->get(route('gallery'))->assertOk();
        $this->get(route('offers'))->assertOk();
        $this->get(route('insurance'))->assertOk();
        $this->get(route('roadside-assistance'))->assertOk();
    }

    public function test_only_active_brands_are_publicly_rendered(): void
    {
        Brand::create(['name' => 'Maruti', 'slug' => 'maruti', 'status' => 'yes']);
        Brand::create(['name' => 'Hidden Brand', 'slug' => 'hidden-brand', 'status' => 'no']);

        $response = $this->get(route('brands'));

        $response->assertSee('Maruti');
        $response->assertDontSee('Hidden Brand');
    }

    public function test_repair_project_keeps_all_image_stages_together(): void
    {
        $project = RepairProject::create([
            'title' => 'Panel restoration',
            'vehicle_name' => 'Honda City',
            'status' => 'yes',
        ]);

        foreach (['before', 'during', 'after'] as $stage) {
            RepairProjectImage::create([
                'repair_project_id' => $project->id,
                'stage' => $stage,
                'image' => "gallery/{$stage}.jpg",
            ]);
        }

        $loaded = RepairProject::publicQuery()->findOrFail($project->id);

        $this->assertSame(['before', 'during', 'after'], $loaded->images->pluck('stage')->all());
    }
}