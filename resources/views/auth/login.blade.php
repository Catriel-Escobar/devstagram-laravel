@extends('layouts.app')
@section('titulo')
Inicia sesion en DevStagram
@endsection

@section('contenido')

<div class="md:flex md:justify-center md:gap-6 md:items-center">
    <div class="md:w-2/3 p-5">
       <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuario">
    </div>

    <div class="md:w-1/3 bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('login') }}" method="POST" novalidate>
            @csrf

            @if(session('mensaje'))
            <p class="font-bold bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{session('mensaje')}}</p>

            @endif
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                <input 
                type="email"
                id="email"
                name="email"
                placeholder="Tu email de registro"
                class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                value="{{ old('email') }}"
                >
                @error('email')
                <p class="font-bold bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                <input 
                type="password"
                id="password"
                name="password"
                placeholder="Password de registro"
                class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                >
                @error('password')
                <p class="font-bold bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                    <input type="checkbox" name="remember" id=""> <label for="remember" class="uppercase text-gray-500 text-sm">Recuerdame</label>
            </div>
           
            <input 
            type="submit" 
            value="Iniciar sesion" 
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
</div>

@endsection