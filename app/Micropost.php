<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function favor()
    {
        return $this->belongsToMany(User::class, 'favorite', 'user_id', 'favorite_id')->withTimestamps();
    }    

public function favorite($userId)
{
    // 既にフォローしているかの確認
    $exist = $this->is_favorite($microposts);
    // 自分自身ではないかの確認
    $its_me = $this->id == $microposts;

    if ($exist || $its_me) {
        // 既にフォローしていれば何もしない
        return false;
    } else {
        // 未フォローであればフォローする
        $this->favor()->attach($microposts);
        return true;
    }
}
public function unfavorite($microposts)
{
    // 既にフォローしているかの確認
    $exist = $this->is_favorite($microposts);
    // 自分自身ではないかの確認
    $its_me = $this->id == $microposts;

    if ($exist && !$its_me) {
        // 既にフォローしていればフォローを外す
        $this->favor()->detach($microposts);
        return true;
    } else {
        // 未フォローであれば何もしない
        return false;
    }
}
public function is_favorite($userId) {
    return $this->favor()->where('favorite_id', $userId)->exists();

}



}
