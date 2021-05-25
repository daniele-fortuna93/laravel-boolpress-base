<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', 1)->orderBy('date', 'desc')->limit(5)->get();
        return view('guest.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('guest.show', compact('post'));
    }
}
