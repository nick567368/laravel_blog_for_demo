<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categorys = Category::all();  
        $posts = Post::when($request->search, function ($query) use ($request) {
            $search = $request->search;
            return $query->where('title', 'like', "%$search%")
                            ->orWhere('body', 'like', "%$search%");
        })->with('tags', 'category', 'user')
                    ->withCount('comments')
                    ->published()
                    ->orderBy('created_at','DESC')
                    ->Paginate(10);

        return view('frontend.index', compact('posts', 'categorys'));
    }
    public function category(Request $request, $category_id)
    {
        $categorys = Category::all();
        $posts = Post::when($request->search, function ($query) use ($request,$category_id) {
            $search = $request->search;
            return $query->where('title', 'like', "%$search%")
                ->where('category_id', $category_id)
            ->orWhere('body', 'like', "%$search%")
                ->where('category_id', $category_id);
        })->with('tags', 'category', 'user')
        ->withCount('comments')
        ->where('category_id',$category_id)
            ->orderBy('created_at', 'DESC')
                     ->published()
        ->Paginate(10);

        return view('frontend.index', compact('posts', 'categorys'));
    }


    public function post(Post $post)
    {
        $post = $post->load(['comments.user', 'tags', 'user', 'category']);

        return view('frontend.post', compact('post'));
    }

    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['body' => 'required']);

        $post->comments()->create([
            'body' => $request->body,
        ]);
        flash()->overlay('Comment successfully created');

        return redirect("/posts/{$post->id}");
    }
}