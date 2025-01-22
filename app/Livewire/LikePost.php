<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    public function mount ($post) {
        $this->isLiked = $this->post->checkLike(Auth::user());
        $this->likes = $this->post->likes->count();
    }
    public function like () {
        if($this->post->checkLike(Auth::user())){
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes -=1;
        }else {
            $this->post->likes()->create([
                'user_id' => Auth::user()->id,
                'post_id' => $this->post->id
            ]);
            $this->isLiked = true;
            $this->likes +=1;
        }
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}
