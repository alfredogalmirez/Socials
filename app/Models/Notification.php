<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'actor_id',
        'type',
        'post_id',
        'is_read'
    ];

    public function actor(){
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
