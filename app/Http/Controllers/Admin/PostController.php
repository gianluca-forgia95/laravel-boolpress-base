<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
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
        
         //Validation
         $request->validate([
            'title' => 'required|string|max:255|unique:posts',
             'date' => 'required|date',
             'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'content' => 'required|string'
         ]);
        $data = $request->all();
        //Published Setter
        $data['published'] = !isset($data['published']) ? 0 : 1;
        //Slug Setter
        $data['slug'] = Str::slug($data['title'] , '-');
        //Img Local Upload
        if ( isset($data['img']) ) {
            $data['img'] = Storage::disk('public')->put('images', $data['img']);
        }
        //Add to Model
        $newPost = Post::create($data);
        //Attach Tags
        if( isset($data['tags']) ) {
            $newPost->tags()->attach($data['tags']);
        }
        //Redirect
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
        //Add Tags
        $tags = Tag::all();
        //Return
        return view( 'admin.posts.edit' , compact('post', 'tags'));
     
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
          //Validation
        $request->validate([
            'title' => 'required|string|max:255|unique:posts,title,' . $post->id,
            'date' => 'required|date',
            'img' => 'nullable|url',
            'content' => 'required|string'
        ]);
        $data = $request->all();
        //Published Setter
        $data['published'] = !isset($data['published']) ? 0 : 1;
        //Slug Setter
        $data['slug'] = Str::slug($data['title'] , '-');
         // Update
         $post->update($data);
         //Sync Tags
         if ( !isset($data['tags'])) {
            $data['tags'] = [];
         }
         $post->tags()->sync($data['tags']);
         //Redirect
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
        //Delete
        $post->delete();
        //Redirect
        return redirect()->route('admin.posts.index')->with('message', 'Il post è stato eliminato con successo');
    }
}
