<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class ImagenController extends Controller
{
    //
    public function store(Request $request) {
        $imagen = $request->file('file'); // 'file' debe ser el nombre usado por Dropzone
        if (!$imagen || !$imagen->isValid()) {
            return response()->json(['error' => 'Archivo no valido'], 400);
        }
        
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($imagen);
        $image->cover(1000, 1000);

        $imagenPath = public_path('uploads'). '/' . $nombreImagen;
        $image->save($imagenPath);
        return response()->json(['extension' => $nombreImagen]);
    }
}
