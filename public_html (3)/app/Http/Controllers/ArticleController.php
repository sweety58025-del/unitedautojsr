<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        return view('frontend.pages.articles', ['articles' => Article::published()->get()]);
    }

    public function show(Article $article)
    {
        abort_unless($article->status === 'yes' && (! $article->published_at || $article->published_at->isPast()), 404);

        return view('frontend.pages.article-details', compact('article'));
    }

    public function adminIndex(?Article $article = null)
    {
        return view('backend.article.index', [
            'articles' => Article::latest()->get(),
            'article' => $article,
        ]);
    }

    public function store(Request $request)
    {
        Article::create($this->attributes($request));

        return redirect()->route('articles.admin.index')->with('success', 'Article created successfully.');
    }

    public function update(Request $request, Article $article)
    {
        $article->update($this->attributes($request, $article));

        return redirect()->route('articles.admin.edit', $article)->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.admin.index')->with('success', 'Article deleted successfully.');
    }

    private function attributes(Request $request, ?Article $article = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'status' => ['required', 'in:yes,no'],
            'published_at' => ['nullable', 'date'],
        ]);

        $slug = Str::slug($validated['title']);
        $existing = Article::where('slug', $slug)->when($article, fn ($query) => $query->where('id', '!=', $article->id))->exists();
        if ($existing) {
            $slug .= '-' . Str::lower(Str::random(5));
        }

        $attributes = [
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'status' => $validated['status'],
            'published_at' => $validated['published_at'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid()->toString() . '.' . $file->extension();
            $file->move(public_path('images/blog'), $filename);
            $attributes['image'] = 'images/blog/' . $filename;
        }

        return $attributes;
    }
}