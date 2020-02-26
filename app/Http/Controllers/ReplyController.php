<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use App\Reply;

class ReplyController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(Request $request, Topic $topic)
    {
        $topic->replies()->create([
            'user_id' => auth()->user()->id,
            'text'=> $request->text
        ]);

        return back();
    }

    public function addPoint($id)
    {
        $rep = Reply::find($id);
        $rep->point =  $rep->point +1;
        $rep->update();
    }
    public function getPoint($id)
    {
        $rep = Reply::find($id);
        return json_encode($rep);
    }
}

