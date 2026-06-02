<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\ArticleComment;

class ArticleCommentController extends Controller
{
    function comment(string $id, Request $request)
    {
        $article = Article::where('id', $id)->first();
        if (!$article)
            return abort(404);
        $comment = ArticleComment::create([
            'article_id' => $article->id,
            'content' => $request->comment
        ]);
        if ($comment) {
            return redirect()->route('article.single', ['slug' => $article->slug])
                ->withSuccess('Komentar berhasil ditambahkan');
        }
        return back()->withInput()
            ->withErrors([
                'message' => 'Gagal menambahkan komentar'
            ]);
    }

    function deleteComment(string $id, Request $request)
    {
        $comment = ArticleComment::where('id', $id)->first();
        if (!$comment) {
            return abort(404);
        }

        if ($comment->delete()) {
            return back()->withSuccess('Komentar berhasil dihapus');
        }

        return back()->withErrors([
            'message' => 'Gagal menghapus komentar'
        ]);
    }
}
