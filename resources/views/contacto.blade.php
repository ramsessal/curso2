@extends('layouts.publico')
@section('contenido')
    <div class="bg-blue-950 text-center py-16 px-8">
        <h1 class="text-4xl font-bold text-white">Contacto</h1>
        <p class="text-blue-200 mt-3 text-lg">Formulario de contacto</p>
    </div>
    <div>
        <form method="POST" action="/contacto">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="nombre">Nombre:</label>
                <input
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"
                    type="text" id="nombre" name="nombre" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Correo electrónico:</label>
                <input
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"
                    type="email" id="email" name="email" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1" for="mensaje">Mensaje:</label>
                <textarea
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"id="mensaje"
                    name="mensaje" required></textarea>
            </div>
            <button type="submit"
                class="w-full bg-blue-900 text-white font-semibold rounded-lg py-2 hover:bg-blue-800 transition">Enviar</button>
        </form>
    </div>
@endsection
