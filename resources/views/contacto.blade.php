@extends('publico')

@section('titulo', 'Contacto')

@section('contenido')
    <main class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
        @if (session('ok'))
            <p class="mb-4 rounded bg-green-100 px-4 py-2 text-sm text-green-800">
                {{ session('ok') }}
            </p>
        @endif

        <form action="{{ route('contacto.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input name="nombre" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none my-4">
            </div>

            <button class="w-full bg-blue-900 text-white font-semibold rounded-lg py-2 hover:bg-blue-800 transition">
                Enviar
            </button>
        </form>
    </main>
@endsection
