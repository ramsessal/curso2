<div>
    <input type="text" wire:model.live.debounce.300ms="busqueda" placeholder="Buscar aviso"
        class="w-full rounded-lg border border-gray-300 px-4 py-2">
    <p wire:loading class="text-sm text-gray-500 mt-2">Buscando...</p>
    <div class="grid gap-4 mt-4 md:grid-cols-2">
        @foreach ($avisos as $aviso)
            <x-tarjeta-post :post="$aviso" wire:key="{{ $aviso->id }}" />
        @endforeach
    </div>
</div>
