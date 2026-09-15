<div class="space-y-3">
    @forelse ($avisos as $aviso)
        <div class="rounded-lg border border-slate-200 bg-white p-3 shadow-sm">
            <p class="font-medium text-slate-800">{{ $aviso->titulo }}</p>
        </div>
    @empty
        <p class="text-slate-500">No hay avisos todavía.</p>
    @endforelse
</div>
