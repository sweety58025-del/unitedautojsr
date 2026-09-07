<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\RepairProject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RepairProjectAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_a_repair_project_with_stage_images(): void
    {
        $admin = User::factory()->create([
            'user_type' => 'admin',
            'is_active' => 'yes',
        ]);
        $brand = Brand::create(['name' => 'Mahindra', 'slug' => 'mahindra', 'status' => 'yes']);

        $response = $this->actingAs($admin)->post(route('repair-projects.store'), [
            'title' => 'Mahindra Thar Transformation',
            'vehicle_name' => 'Mahindra Thar',
            'vehicle_model' => 'Thar',
            'brand_id' => $brand->id,
            'description' => 'Full exterior transformation.',
            'status' => 'yes',
            'sort_order' => 1,
            'is_featured' => '1',
            'images' => [
                'before' => [UploadedFile::fake()->image('before.jpg')],
                'during' => [UploadedFile::fake()->image('during.jpg')],
                'after' => [UploadedFile::fake()->image('after.jpg')],
            ],
        ]);

        $project = RepairProject::with('images')->firstOrFail();
        $response->assertRedirect(route('repair-projects.index'));
        $this->assertSame(['before', 'during', 'after'], $project->images->pluck('stage')->all());

        foreach ($project->images as $image) {
            $this->assertFileExists(public_path($image->image));
        }

        $this->actingAs($admin)->put(route('repair-projects.update', $project), [
            'title' => 'Updated Thar Transformation',
            'vehicle_name' => 'Mahindra Thar',
            'vehicle_model' => 'Thar',
            'brand_id' => $brand->id,
            'description' => 'Updated description.',
            'status' => 'no',
            'sort_order' => 2,
        ])->assertRedirect(route('repair-projects.edit', $project));

        $this->assertDatabaseHas('repair_projects', [
            'id' => $project->id,
            'title' => 'Updated Thar Transformation',
            'status' => 'no',
        ]);

        $imagePaths = $project->images->pluck('image')->all();
        $this->actingAs($admin)->delete(route('repair-projects.destroy', $project))
            ->assertRedirect(route('repair-projects.index'));

        $this->assertDatabaseMissing('repair_projects', ['id' => $project->id]);
        foreach ($imagePaths as $path) {
            $this->assertFileDoesNotExist(public_path($path));
        }
    }
}
