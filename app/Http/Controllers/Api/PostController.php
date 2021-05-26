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

        return response()->json($posts);
    }
}
