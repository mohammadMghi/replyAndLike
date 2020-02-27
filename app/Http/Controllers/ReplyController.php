<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use App\Reply;
use App\Like;

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
            'text' => $request->text
        ]);

        return back();
    }

    public function addlike($reply_id)
    {
        $like = new Like();
       //TODO :: problem => the program dosn't check reply exist in database or not !
        if (!$like->checkStatusLike(auth()->user()->id,$reply_id)) {
            //like
            $like->user_id = auth()->user()->id;
            $like->reply_id = $reply_id;
            $like->save();
         
            //reply
            $rep = Reply::find($reply_id);
            $rep->point =  $rep->point + 1;
            $rep->update();
            return json_encode(['status' => true]);
        }else
        return json_encode(['status' => false]);
    }



    public function countlike($id_reply)
    {
        $rep = Reply::find($id_reply);
        return json_encode($rep);
    }




    public function dislike($replyid)
    {
        $likes = Like::where('user_id', auth()->user()->id)->where('reply_id', $replyid)->first();
      
        if(!$likes == null){
          
            if ($likes->delete()) {
                $rep = Reply::find($replyid);
                if ($rep->point >= 0) {
                    $rep->point = $rep->point - 1;
                    $rep->save();
                    return json_encode(['status' => true]);
                }
            }
        }
        return json_encode(['status' => false]);
    }




    public function checkStatusLike($replyid)
    {
        $like = new Like();

        if ( $like->checkStatusLike(auth()->user()->id , $replyid) == true) {
            return json_encode(['status' => true]);
        } else{
            return json_encode(['status' => false]);
        }
     
    }
}
