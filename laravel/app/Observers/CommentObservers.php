<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\CommentNotify;

class CommentObservers
{

    public function created(Comment $comment)
    {
        //dump($comment);
        $comment->article->user->notify(new CommentNotify($comment));
    }


    public function updated(Comment $comment)
    {
        //
    }


    public function deleted(Comment $comment)
    {
        //
    }


    public function restored(Comment $comment)
    {
        //
    }


    public function forceDeleted(Comment $comment)
    {
        //
    }
}
