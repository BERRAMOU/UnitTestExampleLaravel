<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Likeability;
class Post extends Model
{
// use Likeability;
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }


    public function like()
    {
        $like = new  Like(['user_id' => Auth::id()]);
        $this->likes()->save($like);
    }

    public function unlike()
    {
        $this->likes()
            ->where(['user_id' => Auth::id()])
            ->delete();
    }

    public function isLiked()
    {

        return !!$this->likes()
            ->where('user_id', Auth::id())
            ->count();
    }

    public function toggle()
    {
        if ($this->isLiked()) {
            return $this->unlike();
        }

        return $this->like();
    }

//    public function likesCount(){
//        return $this->likes()
//                    ->count();
//    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

}
