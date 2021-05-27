<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function deleteComment(Comment $comment)
    {
        //Delete
        $comment->delete();
        //Redirect
        return back()->with('message', 'Il messaggio è stato eliminato con successo');
    }
}
