<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $nextSortOrder = Article::max('sort_order') + 1;
        $categories = $this->getCategories();

        return view('admin.articles.create', compact('nextSortOrder', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'sort_order' => 'required|integer|min:1',
            'meta_description' => 'nullable|string|max:255',
        ]);

        // Set default value for is_published if not provided
        $validated['is_published'] = $request->has('is_published') ? (bool) $request->is_published : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        // Auto-generate excerpt if not provided
        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['content']), 150);
        }

        // Auto-calculate reading time
        $article = Article::create($validated);
        $article->reading_time = $article->calculateReadingTime();
        $article->save();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'สร้างบทความสำเร็จแล้ว');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = $this->getCategories();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'sort_order' => 'required|integer|min:1',
            'meta_description' => 'nullable|string|max:255',
        ]);

        // Set default value for is_published if not provided
        $validated['is_published'] = $request->has('is_published') ? (bool) $request->is_published : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        // Auto-generate excerpt if not provided
        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['content']), 150);
        }

        $article->update($validated);

        // Auto-calculate reading time
        $article->reading_time = $article->calculateReadingTime();
        $article->save();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'อัพเดทบทความสำเร็จแล้ว');
    }

    public function destroy(Article $article)
    {
        // Delete associated image
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'ลบบทความสำเร็จแล้ว');
    }

    private function getCategories(): array
    {
        return [
            'การบำรุงรักษาแอร์',
            'คำแนะนำการใช้งาน',
            'เทคนิคการประหยัดไฟ',
            'การซ่อมแซม',
            'ข่าวสาร',
            'อื่นๆ',
        ];
    }
}
