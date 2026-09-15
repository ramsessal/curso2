<div class="max-w-4xl mx-auto p-4">
    <div class="flex gap-3 mb-4">
        <input
            wire:model.live="busqueda"
            type="text"
            placeholder="Buscar aviso"
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        <button
            wire:click="limpiar"
            type="button"
            class="bg-slate-200 text-slate-800 px-4 py-2 rounded-lg hover:bg-slate-300"
        >
            Limpiar
        </button>
    </div>

    @forelse ($avisos as $aviso)
        <div class="mb-3 rounded-lg border border-slate-200 bg-white p-3 shadow-sm">
            <p class="font-medium text-slate-800">{{ $aviso->titulo }}</p>
        </div>
    @empty
        <p class="text-slate-500">No hay avisos que coincidan con tu búsqueda.</p>
    @endforelse

    @if ($avisos->hasPages())
        <div class="mt-4">
            {{ $avisos->links() }}
        </div>
    @endif
</div>