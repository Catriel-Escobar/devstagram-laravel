@extends('layouts.app')


@section('titulo')
Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
        <form action="{{route('perfil.store')}}" enctype="multipart/form-data" method="POST" class="mt-10 md:mt-0" >
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">username</label>
                <input 
                type="text"
                id="username"
                name="username"
                placeholder="Tu username"
                class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                value="{{ auth()->user()->username }}"
                >
                @error('username')
                <p class="font-bold bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">username</label>
                <input 
                type="file"
                id="imagen"
                name="imagen"
                accept=".png,.jpg,.jpeg,.gif,.bmp"
                class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                value=""
                >
            </div>
            <input 
            type="submit" 
            value="Guardar cambios" 
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
</div>
@endsection