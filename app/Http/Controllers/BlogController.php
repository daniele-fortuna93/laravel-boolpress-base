<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Comment;
use App\Mail\CommentMail;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $posts = Post::where('published', 1)->orderBy('date', 'desc')->limit(5)->get();
        return view('guest.index', compact('posts', 'tags'));
    }

    public function show($slug)
    {
        $tags = Tag::all();
        $post = Post::where('slug', $slug)->first();
        return view('guest.show', compact('post', 'tags'));
    }

    public function addComment(Request $request, Post $post)
    {

        $request->validate([
            'name' => 'nullable|string|max:100',
            'content' => 'required|string',
        ]);

        $newComment = new Comment();
        $newComment->name = $request->name;
        $newComment->content = $request->content;
        $newComment->post_id = $post->id;
        $newComment->save();
        
        Mail::to('mail@mail.it')->send(new CommentMail($post, $newComment));
        return back();

    }
    public function filterTag($slug)
    {
        $tags = Tag::all();
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->where('published',1)->get();
        return view('guest.index', compact('posts', 'tags', 'tag'));
    }
}