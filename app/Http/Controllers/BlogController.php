<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $articles = Blog::query();

        if ($request->has('q'))
        {
            $articles->where('title', 'like', '%'.$request->input('q').'%');
        }

        return view('frontend.blog.index', [
            'blogs' => $articles->paginate(),
        ]);
    }

    public function showArticle(Blog $blog)
    {
        return view('frontend.blog.show', [
            'blog' => $blog,
        ]);
    }
}
