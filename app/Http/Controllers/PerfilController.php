<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class PerfilController extends Controller
{
    //

    public function index () {
        return view('perfil.index');
    }

    public function store (Request $request) {
        $request->request->add([ 'username' =>  Str::slug($request->username)]);
        $request->validate([
           'username' => ['required','max:30','min:3','unique:users,username,'.Auth::user()->id],
        ]);
       
        if($request->imagen) {
            $imagen = $request->file('imagen'); 
            // dd($imagen);// 'file' debe ser el nombre usado por Dropzone
            if (!$imagen || !$imagen->isValid()) {
                return response()->json(['error' => 'Archivo no valido'], 400);
        }
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($imagen);
            $image->cover(1000, 1000);
    
            $imagenPath = public_path('perfiles'). '/' . $nombreImagen;
            $image->save($imagenPath);
            $usuario = User::find(Auth::user()->id);
            $usuario->username = $request->username;
            $usuario->imagen = $nombreImagen ?? '';
            $usuario->save();
            return redirect()->route('posts.index',$usuario->username);
        }
    }
}
