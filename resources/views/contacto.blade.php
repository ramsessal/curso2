@extends('publico')

@section('titulo', 'Contacto')

@section('contenido')
    <main class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
     

        <form action="#" method="POST">
            @csrf

            <div class="mb-4">
              <label class="block text-sm font-medium
              text-gray-700 mb-1">Nombre</label>

<input class="w-full rounded-lg border
              border-gray-300 px-3 py-2
              focus:border-blue-500 focus:ring-2
              focus:ring-blue-200 outline-none my-4">

<button class="w-full bg-blue-900 text-white
               font-semibold rounded-lg py-2
               hover:bg-blue-800 transition">
    Enviar
</button>
</button>     
            </div>

           
        </form>
    </main>
@endsection
