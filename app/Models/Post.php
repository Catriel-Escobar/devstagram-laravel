<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = ['titulo','descripcion','imagen','user_id'];

    public function user() {
        return $this->belongsTo(User::class); // 1 posts 1 user
        // return $this->belongsTo(User::class)->select(['id','username']); // 1 posts 1 user
    }

    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user) {
        return $this->likes()->where('user_id', $user->id)->count() > 0;  
    }
}
