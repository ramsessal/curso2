<div>
    <input class="p-4" wire:model.live="busqueda" placeholder="Buscar aviso">
    <button class="m-2 p-2" wire:click="limpiar">Limpiar</button>
    <div class="max-w-4xl mx-auto p-8">
        @if ($posts->isEmpty())
            <p class="text-gray-500">No hay avisos para esta búsqueda.</p>
        @else
            <div class="grid md:grid-cols-2 gap-4">
                @foreach ($posts as $post)
                    <x-tarjeta-post :post="$post" />
                @endforeach
            </div>
        @endif
    </div>
</div>
