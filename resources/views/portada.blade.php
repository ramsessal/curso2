@extends('publico')

   @section('titulo', 'Portada · Blog de Avisos')

   @section('contenido')
       <div class="bg-blue-950 text-center py-16 px-8">
           <h1 class="text-4xl font-bold text-white">Blog de Avisos de la Corporación</h1>
           <p class="text-blue-200 mt-3 text-lg">Avisos, operativos y noticias internas</p>
       </div>

       <div class="max-w-4xl mx-auto p-8">
           <div class="mb-6 flex justify-center">
               <a href="{{ route('avisos.create') }}"
                  class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                   Nuevo aviso
               </a>
           </div>

           <div class="grid md:grid-cols-2 gap-4">
               @foreach ($posts as $post)
                   <article class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
                       <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full mb-2">
                           {{ $post->categoria?->nombre ?? 'Sin categoría' }}
                       </span>
                       <h2 class="text-xl font-semibold text-gray-900">{{ $post->titulo }}</h2>
                       <p class="text-gray-600 mt-2">{{ Str::limit($post->contenido, 90) }}</p>
                       <p class="text-gray-400 text-xs mt-4">{{ $post->fecha }}</p>
                       <a href="{{ route('avisos.edit', $post) }}" class="text-blue-700 text-sm font-semibold hover:underline mt-4 inline-block">Editar</a>
                   </article>
               @endforeach
           </div>
       </div>
   @endsection