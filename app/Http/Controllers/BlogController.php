<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentAdded;

class BlogController extends Controller
{
    public function index() 
    {
        //Query per filtrare 5 post pubblicati
        $posts = Post::where('published', 1)->orderBy('date', 'desc')->limit(5)->get();
         //Prendo tutti i tag
         $tags = Tag::all();
        //Restituisco la homepage con i blog
        return view('guest.index' , compact('posts' , 'tags'));

    }

    public function show($slug)
    {
        //prendo il singolo post dai dati
        $post = Post::where('slug', $slug)->first();
         //Prendo tutti i tag
         $tags = Tag::all();
        //Se lo slug non è corretto mostro error 404
        if ( $post == null ) {
            abort(404);
        }
        // restituisco in pagina il singolo post identificato con lo slug
        return view('guest.show', compact('post' , 'tags'));
    }

    public function storeComment( Request $request , Post $post )
    {
        //Validation del commento
        $request->validate([
            'name' => 'nullable|string|max:100',
            'content' => 'required|string',
        ]);
        //Istanzio il nuovo commento
        $storedComment = new Comment();
        $storedComment->name = $request->name;
        $storedComment->content = $request->content;
        $storedComment->post_id = $post->id;
        //Lo salvo
        $storedComment->save();
        //e-mail di notifica
         Mail::to('info@boolpress.com')->send(new CommentAdded($post));
        //Back sulla stessa pagina
        return back();
 
    }

    public function filterByTag($slug)
    {
        //Prendo tutti i tag
        $tags = Tag::all();
        //Filtro il tag identificandolo con lo slug
        $tag = Tag::where('slug' , $slug )->first();
        //Se non esiste error 404
        if ( $tag == null ) {
            abort(404);
        }
        //Prendo i post pubblicati anche per i tags con posts()
        $posts = $tag->posts()->where('published', 1)->get();
        //View
        return view('guest.index', compact('posts' , 'tags'));
    }
}
