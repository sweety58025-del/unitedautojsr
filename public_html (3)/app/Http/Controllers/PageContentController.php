<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageContentController extends Controller
{
    private const PAGES = [
        'home' => 'Homepage',
        'offers' => 'Offers',
        'insurance' => 'Insurance',
        'insurance-claim-partners' => 'Insurance Claim Partners',
        'insurance-renewal' => 'Insurance Renewal',
        'roadside-assistance' => 'Roadside Assistance',
    ];

    public function index(string $page = 'offers')
    {
        abort_unless(array_key_exists($page, self::PAGES), 404);

        return view('backend.website-content.page-content', [
            'pages' => self::PAGES,
            'page' => $page,
            'pageLabel' => self::PAGES[$page],
            'content' => PageContent::forPage($page),
        ]);
    }

    public function update(Request $request, string $page)
    {
        abort_unless(array_key_exists($page, self::PAGES), 404);

        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'intro' => ['nullable', 'string', 'max:2000'],
            'body' => ['nullable', 'string'],
            'section_one_title' => ['nullable', 'string', 'max:255'],
            'section_one_body' => ['nullable', 'string'],
            'section_two_title' => ['nullable', 'string', 'max:255'],
            'section_two_body' => ['nullable', 'string'],
            'section_three_title' => ['nullable', 'string', 'max:255'],
            'section_three_body' => ['nullable', 'string'],
            'section_four_title' => ['nullable', 'string', 'max:255'],
            'section_four_body' => ['nullable', 'string'],
            'list_items' => ['nullable', 'string'],
            'hours_title' => ['nullable', 'string', 'max:255'],
            'hours_items' => ['nullable', 'string'],
            'pricing_title' => ['nullable', 'string', 'max:255'],
            'pricing_items' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'trust_items' => ['nullable', 'string'],
            'hero_stats' => ['nullable', 'string'],
            'faq_items' => ['nullable', 'string'],
            'why_choose_items' => ['nullable', 'string'],
            'showcase_items' => ['nullable', 'string'],
        ]);

        $content = PageContent::query()->firstOrNew(['page_key' => $page]);
        $validated['list_items'] = collect(preg_split('/\r\n|\r|\n/', (string) ($validated['list_items'] ?? '')))
            ->map(fn (string $item) => trim($item))
            ->filter()
            ->values()
            ->all();
        foreach (['hours_items', 'pricing_items'] as $field) {
            $validated[$field] = collect(preg_split('/\r\n|\r|\n/', (string) ($validated[$field] ?? '')))
                ->map(fn (string $item) => trim($item))
                ->filter()
                ->values()
                ->all();
        }

            $validated['trust_items'] = $this->lines($validated['trust_items'] ?? '');
            $validated['hero_stats'] = $this->pairs($validated['hero_stats'] ?? '');
            $validated['faq_items'] = $this->pairs($validated['faq_items'] ?? '');
            $validated['why_choose_items'] = $this->pairs($validated['why_choose_items'] ?? '');
            $validated['showcase_items'] = $this->triples($validated['showcase_items'] ?? '');

        if (! $request->hasFile('image')) {
            unset($validated['image']);
        }

        if ($request->hasFile('image')) {
            $directory = public_path('front/assets/img/page-content');
            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $filename = Str::uuid()->toString() . '.' . $request->file('image')->extension();
            $request->file('image')->move($directory, $filename);
            $validated['image'] = 'front/assets/img/page-content/' . $filename;
        }

        $content->fill($validated)->save();

        return redirect()->route('page-content.edit', $page)->with('success', $page . ' content saved successfully.');
    }

    private function lines(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value))
            ->map(fn (string $item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    private function pairs(string $value): array
    {
        return collect($this->lines($value))
            ->map(fn (string $item) => array_pad(array_map('trim', explode('|', $item, 2)), 2, ''))
            ->filter(fn (array $item) => $item[0] !== '')
            ->values()
            ->all();
    }

    private function triples(string $value): array
    {
        return collect($this->lines($value))
            ->map(fn (string $item) => array_pad(array_map('trim', explode('|', $item, 3)), 3, ''))
            ->filter(fn (array $item) => $item[0] !== '')
            ->values()
            ->all();
    }
}
