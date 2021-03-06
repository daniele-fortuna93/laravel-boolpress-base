<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    public function getAll(){

        $posts = Post::all();
        foreach ($posts as $post) {
            $post['comments'] = $post->comments;
            $post['tags'] = $post->tags;
        }

        return response()->json($posts);
    }
}
