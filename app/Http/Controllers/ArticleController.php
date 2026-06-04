<?php

namespace App\Http\Controllers;

use App\Models\ArticleComment;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use App\Models\ArticleCategory;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    function list(Request $request)
    {
        $query = Article::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('title', $request->sort);
        }

        $articles = $query->get();
        return view('article.list', ['articles' => $articles]);
    }
    function create(Request $request)
    {
        $articleCategories = ArticleCategory::orderBy('name')->get();

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => ['required', 'string', 'max:255', Rule::unique('articles', 'title')],
                'content' => ['required', 'string', 'max:2000'],
                'article_category_id' => ['required', 'integer', Rule::in($articleCategories->pluck('id'))]
            ]);

            $slug = Str::slug($request->title);
            if (Article::where('slug', '=', $slug)->exists()) {
                $slug .= '-' . uniqid();
            }

            $article = Article::create([
                'slug' => $slug,
                'title' => $request->title,
                'content' => $request->input('content'),
                'article_category_id' => $request->article_category_id
            ]);

            if ($article) {
                return redirect()->route('article.list')
                    ->withSuccess('Artikel berhasil dibuat');
            }

            return back()->withInput()
                ->withErrors([
                    'alert' => 'Gagal menyimpan artikel'
                ]);
        }
        return view('article.form', ['article_categories' => $articleCategories]);
    }

    function single(string $slug, Request $request)
    {
        $article = Article::where('slug', $slug)->first();
        if (!$article)
            return abort(404);

        return view('article.single', [
            'article' => $article
        ]);
    }

    function edit(string $id, Request $request)
    {
        $article = Article::where('id', $id)->first();
        $articleCategories = ArticleCategory::orderBy('name')->get();

        if (!$article)
            return abort(404);

        if ($request->isMethod('post')) {
            $request->validate([
                'title' => ['required', 'string', 'max:255', Rule::unique('articles', 'title')->ignore($article->id)],
                'content' => ['required', 'string', 'max:2000'],
                'article_category_id' => ['required', 'integer', Rule::in($articleCategories->pluck('id'))],
                'slug' => ['required', 'string', Rule::unique('articles')->ignore($article->id)],
            ]);

            $article->slug = $request->slug;
            $article->title = $request->title;
            $article->content = $request->input('content');
            $article->article_category_id = $request->article_category_id;
            $article->save();

            if ($article) {
                return redirect()->route('article.single', [
                    'slug' =>
                        $article->slug
                ])
                    ->withSuccess('Artikel berhasil diubah');
            }

            return back()->withInput()
                ->withErrors([
                    'alert' => 'Gagal menyimpan artikel'
                ]);
        }

        return view('article.form', [
            'article_categories' => $articleCategories,
            'article' => $article
        ]);
    }

    function delete(string $id, Request $request)
    {
        $article = Article::where('id', $id)->first();
        if (!$article)
            return abort(404);
        if ($article->delete()) {
            return redirect()->route('article.list')
                ->withSuccess('Artikel telah dihapus');
        }
        return back()->withInput()
            ->withErrors([
                'alert' => 'Gagal menghapus artikel'
            ]);
    }
}
