<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Post;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{

    protected $validation = [
        'date' => 'required|date|',
        'content' => 'required|string',
        'image' => 'nullable|url',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // aggiungo all'array comune di validazione la validazione per il titolo unique
        $validation = $this->validation;
        $validation['title'] = 'required|string|max:255|unique:posts';
        
        // validazione
        $request->validate($validation);

        // inserisco i dati dentro la variabile $data
        $data = $request->all();
        
        // assegno alla checkbox il valore 0 o 1 a seconda se è flaggata o no
        $data['published'] = !isset($data['published']) ? 0 : 1;
        // imposto lo slug
        $data['slug'] = Str::slug($data['title'], '-');

        // assegno i dati creati ad una variabile $newPost
        $newPost = Post::create($data);    
        
        // aggiungo i tags al post
        $newPost->tags()->attach($data['tags']);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // aggiungo all'array comune di validazione la validazione per il titolo unique da non considerare quando vado a modificare il post 
        $validation = $this->validation;
        $validation['title'] = 'required|string|max:255|unique:posts,title,'. $post->id;

        $request->validate($validation);

        $data = $request->all();  
        
        // assegno alla checkbox il valore 0 o 1 a seconda se è flaggata o no
        $data['published'] = !isset($data['published']) ? 0 : 1;
        // imposto lo slug partendo dal title
        $data['slug'] = Str::slug($data['title'], '-');

        // Aggiorno tutti i dati passati
        $post->update($data);

        // aggiorno i tags con la funzione proprietà sync()
        $post->tags()->sync($data['tags']);

        // return
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'Il post è stato eliminato!');

    }
}
