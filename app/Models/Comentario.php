<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //
    protected $fillable = ['comentario','post_id','user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
