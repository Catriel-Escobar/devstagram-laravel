<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{


    public function index(User $user) {
        // dd(Auth::user());
        // dd($user);  
        // $posts = Post::where('user_id',$user->id)->paginate(5);
        $posts = $user->posts()->latest()->paginate(5);
        return view('dashboard',['user' => $user, 'posts' => $posts]);
    }

    public function create () {
        return view('posts.create');
    }


    public function store(Request $request) {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => Auth::user()->id 
        ]);

        return redirect()->route('posts.index',Auth::user()->username);       
    }

    public function show(User $user, Post $post) {
        return view('posts.show',['post' => $post, 'user' => $user]);
    }


 
    public function destroy(Post $post) {
        Gate::allows('delete',$post);
        $post->delete();

        // eliminar la imagen

        $imagen_path = public_path('uploads') . '/' . $post->imagen;
        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }
       return redirect()->route('posts.index',Auth::user()->username);
    }
}
