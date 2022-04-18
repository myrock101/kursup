<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index', [
            'blogs' => Blog::query()->orderBy('id', 'desc')->paginate(),
        ]);
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required',
            'cover' => 'required',
        ]);

        Blog::query()->create([
            'title' => $request->input('title'),
            'meta_keywords' => $request->input('meta_keywords'),
            'meta_description' => $request->input('meta_description'),
            'description' => $request->input('description'),
            'cover' => $request->file('cover')->store('public/blog/covers'),
        ]);

        return redirect()->route('blog.index');
    }

    public function show(Blog $blog)
    {
        //
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', [
            'blog' => $blog,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        $blog->update([
            'title' => $request->input('title'),
            'meta_keywords' => $request->input('meta_keywords'),
            'meta_description' => $request->input('meta_description'),
            'description' => $request->input('description'),
        ]);

        if ($request->hasFile('cover'))
        {
            if (Storage::exists($blog['cover']))
            {
                Storage::delete($blog['cover']);
            }

            $blog->update([
                'cover' => $request->file('cover')->store('public/blog/covers'),
            ]);
        }

        return redirect()->route('blog.index');
    }

    public function destroy(Blog $blog)
    {
        if (Storage::exists($blog['cover']))
        {
            Storage::delete($blog['cover']);
        }

        $blog->delete();

        return redirect()->route('blog.index');
    }
}
