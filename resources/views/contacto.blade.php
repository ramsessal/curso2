@extends('layouts.publico')

@section('titulo', 'Contacto · Blog de Avisos')

@section('contenido')
    <div class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
        <form>

            <x-campo label="Nombre" name="nombre" />
            {{-- <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
            </div> --}}
            
            <x-campo label="Correo" name="correo" type="email" />
            {{-- <div class="mb-4">
                <label for="correo" class="block text-sm font-medium text-gray-700 mb-1">Correo</label>
                <input type="email" id="correo" name="correo" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
            </div> --}}

            {{-- <div class="mb-4">
                <label for="correo" class="block text-sm font-medium text-gray-700 mb-1">Correo</label>
                <input type="email" id="correo" name="correo" class="w-full rounded-lg border border-red-500 px-3 py-2 focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none">
                <p class="text-red-600 text-sm mt-1">El correo no es válido.</p>
            </div> --}}
            <div class="mb-4">
                <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="4" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"></textarea>
            </div>

            {{-- <button type="submit" class="w-full bg-blue-900 text-white font-semibold rounded-lg py-2 hover:bg-blue-800 transition">
                Enviar
            </button> --}}
            <button type="submit" class="w-full bg-marca hover:bg-marca/90 text-white font-semibold rounded-lg py-2 transition">
                Enviar
            </button>
        </form>
    </div>
@endsection