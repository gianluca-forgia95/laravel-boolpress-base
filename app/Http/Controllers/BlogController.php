<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() 
    {
        //Query per filtrare 5 post pubblicati
        $posts = Post::where('published', 1)->orderBy('date', 'desc')->limit(5)->get();
        //Restituisco la homepage con i blog
        return view('guest.index' , compact('posts'));

    }
}
