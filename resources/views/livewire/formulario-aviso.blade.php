<form wire:submit="guardar" class="space-y-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div>
        <label for="titulo" class="mb-1 block text-sm font-medium text-slate-700">Título</label>
        <input
            id="titulo"
            type="text"
            wire:model="titulo"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Escribe el título del aviso"
        >
        @error('titulo')
            <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="contenido" class="mb-1 block text-sm font-medium text-slate-700">Contenido</label>
        <textarea
            id="contenido"
            wire:model="contenido"
            rows="5"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Escribe el contenido del aviso"
        ></textarea>
        @error('contenido')
            <span class="mt-1 block text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <button
        type="submit"
        class="rounded-lg bg-blue-950 px-4 py-2 font-semibold text-white hover:bg-blue-900"
    >
        Guardar aviso
    </button>
</form>
