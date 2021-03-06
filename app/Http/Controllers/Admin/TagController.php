<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index' , compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $tags = Tag::all();
         return view('admin.tags.create');
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
            $request->validate(['name' => 'required|string|max:50|unique:tags']);
            
            $data = $request->all();
            //Slug Setter
            $data['slug'] = Str::slug($data['name'] , '-');
            //Add to Model
            Tag::create($data);
            //Return
            return redirect()->route('admin.tags.index')->with('message', 'Il tag è stato creato!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , Tag $tag)
    {
        // validation
        $request->validate(['name' => 'required|string|max:50|unique:tags,name,' . $tag->id]);
        $data = $request->all();

        // imposto lo slug partendo dal title
        $data['slug'] = Str::slug($data['name'], '-');

        // Update
        $tag->update($data);

        return redirect()->route('admin.tags.index', $tag)->with('message', 'Il tag ' . $tag->name . ' è stato modificato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
         //Delete
         $tag->delete();
         //Redirect
         return redirect()->route('admin.tags.index')->with('message', 'Il tag è stato eliminato con successo');
    }
}
