<div>
    <input class="p-4" wire:model.live="busqueda" placeholder="Buscar aviso">
    <button class="m-2 p-2" wire:click="limpiar">Limpiar</button>
    <div class="max-w-4xl mx-auto p-8">
        <div class="grid md:grid-cols-2 gap-4">
            @foreach ($posts as $post)
                <x-tarjeta-post :post="$post" />
        
            @endforeach
        </div>
    </div>
</div>
