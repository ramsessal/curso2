@extends('layouts.publico')

@section('titulo', 'Contacto')

@section('contenido')
    <main class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Contacto</h1>

        <form method="POST" action="{{ url('/contacto') }}" class="space-y-5">
            @csrf

            <x-campo label="Nombre" name="nombre" />

            <div>
                <x-campo label="Correo" name="correo" type="email"
                    class="border-red-500 focus:ring-red-200" />
                <p class="text-red-600 text-sm mt-1">El correo no es válido.</p>
            </div>

            <x-campo label="Mensaje" name="mensaje" type="textarea" />

            <button type="submit"
                class="w-full bg-marca text-white font-semibold rounded-lg py-2 hover:bg-marca/90 transition">
                Enviar mensaje
            </button>
        </form>
    </main>
@endsection