<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Like extends Model
{
    //
    protected $table = "likes_users";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reply()
    {
        return $this->hasMany(Reply::class, 'id', 'user_id');
    }

    public function checkStatusLike($id_user,$reply_id)
    {
        //when array is empty so user does't like reply
        $likes = Like::where('user_id',$id_user)->where('reply_id',$reply_id)->count();
        
        if ($likes > 0) {
            return true;
        } else
            return false;
    }
}
