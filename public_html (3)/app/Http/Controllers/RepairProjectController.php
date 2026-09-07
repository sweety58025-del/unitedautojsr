<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\RepairProject;
use App\Models\RepairProjectImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class RepairProjectController extends Controller implements HasMiddleware
{
    private const IMAGE_DIRECTORY = 'front/assets/img/repair-projects';

    public static function middleware(): array
    {
        return [
            new Middleware('permission:show-repair-project', only: ['index']),
            new Middleware('permission:add-repair-project', only: ['create', 'store']),
            new Middleware('permission:edit-repair-project', only: ['edit', 'update', 'destroyImage', 'reorderImage']),
            new Middleware('permission:delete-repair-project', only: ['destroy']),
        ];
    }

    public function index()
    {
        return $this->renderIndex();
    }

    public function create()
    {
        return redirect()->route('repair-projects.index');
    }

    public function store(Request $request)
    {
        $validated = $this->validateProject($request);
        $project = RepairProject::create($this->projectAttributes($validated));
        $this->storeImages($request, $project);

        return redirect()->route('repair-projects.index')->with('success', 'Repair project created successfully.');
    }

    public function edit(RepairProject $repairProject)
    {
        return $this->renderIndex($repairProject->load('images'));
    }

    public function update(Request $request, RepairProject $repairProject)
    {
        $validated = $this->validateProject($request);
        $repairProject->update($this->projectAttributes($validated));
        $this->storeImages($request, $repairProject);

        foreach ($request->input('image_sort_order', []) as $imageId => $sortOrder) {
            $repairProject->images()->whereKey($imageId)->update([
                'sort_order' => max(0, (int) $sortOrder),
            ]);
        }

        return redirect()->route('repair-projects.edit', $repairProject)->with('success', 'Repair project updated successfully.');
    }

    public function destroy(RepairProject $repairProject)
    {
        $repairProject->load('images');
        foreach ($repairProject->images as $image) {
            $this->deleteImageFile($image->image);
        }
        $repairProject->delete();

        return redirect()->route('repair-projects.index')->with('success', 'Repair project deleted successfully.');
    }

    public function destroyImage(RepairProjectImage $image)
    {
        $this->deleteImageFile($image->image);
        $image->delete();

        return back()->with('success', 'Project image deleted successfully.');
    }

    public function reorderImage(Request $request, RepairProjectImage $image)
    {
        $validated = $request->validate(['sort_order' => ['required', 'integer', 'min:0']]);
        $image->update(['sort_order' => $validated['sort_order']]);

        return back()->with('success', 'Project image order updated.');
    }

    private function renderIndex(?RepairProject $project = null)
    {
        return view('backend.repair-project.index', [
            'projects' => RepairProject::with(['brand', 'images'])->orderBy('sort_order')->latest()->get(),
            'brands' => Brand::where('status', 'yes')->orderBy('name')->get(),
            'project' => $project,
        ]);
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'vehicle_name' => ['required', 'string', 'max:255'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'vehicle_model' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:yes,no'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'images.before.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'images.during.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'images.after.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'captions.before.*' => ['nullable', 'string', 'max:255'],
            'captions.during.*' => ['nullable', 'string', 'max:255'],
            'captions.after.*' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function projectAttributes(array $validated): array
    {
        return [
            'title' => $validated['title'],
            'vehicle_name' => $validated['vehicle_name'],
            'brand_id' => $validated['brand_id'] ?? null,
            'vehicle_model' => $validated['vehicle_model'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'sort_order' => $validated['sort_order'],
            'is_featured' => (bool) ($validated['is_featured'] ?? false),
        ];
    }

    private function storeImages(Request $request, RepairProject $project): void
    {
        $directory = public_path(self::IMAGE_DIRECTORY);
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        foreach (['before', 'during', 'after'] as $stage) {
            foreach ($request->file("images.$stage", []) as $index => $file) {
                $filename = Str::uuid()->toString() . '.' . $file->extension();
                $file->move(public_path(self::IMAGE_DIRECTORY), $filename);

                $project->images()->create([
                    'stage' => $stage,
                    'image' => self::IMAGE_DIRECTORY . '/' . $filename,
                    'caption' => $request->input("captions.$stage.$index"),
                    'sort_order' => $project->images()->where('stage', $stage)->max('sort_order') + 1,
                ]);
            }
        }
    }

    private function deleteImageFile(string $path): void
    {
        $directory = str_replace('/', DIRECTORY_SEPARATOR, self::IMAGE_DIRECTORY) . DIRECTORY_SEPARATOR;
        $relativePath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, ltrim($path, '/\\'));

        if (Str::startsWith($relativePath, $directory)) {
            $fullPath = public_path($relativePath);
            if (is_file($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
