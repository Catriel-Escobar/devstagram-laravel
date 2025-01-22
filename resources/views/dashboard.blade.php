@extends('layouts.app')

@section('titulo')
Perfil: {{ $user->username }}
@endsection

@section('contenido')
<div class="flex justify-center">

    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
    <div class="md:w-8/12 lg:w-6/12 px-5">
        <img src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg') }}" alt="Imagen de usuario" class="">
    </div>
    <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">

      <div class="flex gap-2 ">
        <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

        @auth
            @if($user->id === auth()->user()->id)
                <a href="{{ route('perfil.index') }}" class="text-gray-500 text-sm underline mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd" d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z" clip-rule="evenodd" />
                      </svg>
                      
                      
                </a>
            @endif
        @endauth
      </div>

        <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
            <span class="font-normal">{{$user->followers->count()}}</span> @choice('Seguidor|Seguidores', $user->followers->count())  
        </p>
        <p class="text-gray-800 text-sm mb-3 font-bold">
            <span class="font-normal">{{$user->followings->count()}}</span> Siguiendo
        </p>
        <p class="text-gray-800 text-sm mb-3 font-bold">
            <span class="font-normal">{{$user->posts->count()}}</span> @choice('Publicación|Publicaciones', $user->posts->count())
        </p>
      @auth
      @if($user->id !== auth()->user()->id)
      @if ($user->followers->contains(auth()->user()))
      <form action="{{route('users.unfollow', ['user' => $user])}}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Dejar Seguir">
    </form>
      @else
      <form action="{{route('users.follow', ['user' => $user])}}" method="POST">
        @csrf
        <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir">
    </form>
      @endif
      @endif
      @endauth
    </div>
    </div>
</div>

<section class="container mx-auto  mt-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
    @if($posts->count())
   <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach ($posts as $post)
    <div>
        <a href="{{route('posts.show', ['post' => $post,'user' => $user])}}">

            <img src="{{ asset('uploads/'.$post->imagen) }}" alt="Imagenl del post {{$post->titulo}}">
        </a>
    </div>
@endforeach
</div>
<div class="my-10">
    {{$posts->links('pagination::tailwind')}}
</div>
@else
<p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones</p>
@endif
</section>
@endsection