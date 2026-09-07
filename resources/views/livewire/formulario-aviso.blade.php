<form wire:submit="guardar" class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
    <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
    <input id="titulo" wire:model.live.debounce.300ms="titulo"
           class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
    @error('titulo') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror

    <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1 mt-4">Categoría</label>
    <select id="categoria_id" wire:model="categoria_id"
            class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
        <option value="">Elige una categoría...</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
        @endforeach
    </select>
    @error('categoria_id') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror

    <label for="contenido" class="block text-sm font-medium text-gray-700 mb-1 mt-4">Contenido</label>
    <textarea id="contenido" wire:model="contenido" rows="4"
              class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"></textarea>
    @error('contenido') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror

    <button wire:loading.attr="disabled" class="w-full bg-blue-900 text-white font-semibold rounded-lg py-2 hover:bg-blue-800 transition mt-5">
        <span wire:loading.remove>Publicar aviso</span>
        <span wire:loading>Guardando...</span>
    </button>
</form>