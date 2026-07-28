@extends('layouts.admin')

@section('title', 'Perangkat Desa')
@section('page_title', 'Perangkat Desa')

@section('content')

{{-- ── Header bar ── --}}
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-black">Perangkat Desa ({{ $items->count() }})</h2>
    <a href="{{ route('admin.perangkat.create') }}"
       class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">
        + Tambah
    </a>
</div>

{{-- ── Staff card grid ── --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse($items as $p)
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-4 text-center">
            <img src="{{ \App\Helpers\FotoHelper::url($p->foto, 'https://ui-avatars.com/api/?name=' . urlencode($p->nama) . '&background=2E7D32&color=fff') }}"
                 alt="{{ $p->nama }}"
                 class="w-16 h-16 rounded-full mx-auto mb-2 border-4 border-[#2E7D32]"/>
            <p class="font-black text-sm">{{ $p->nama }}</p>
            <p class="text-[#2E7D32] text-xs font-bold">{{ $p->jabatan }}</p>
            <div class="flex gap-2 justify-center mt-3">
                <a href="{{ route('admin.perangkat.edit', $p->id) }}"
                   class="text-xs text-blue-600 font-bold hover:underline">
                    Edit
                </a>
                <form id="del-perangkat-{{ $p->id }}"
                      action="{{ route('admin.perangkat.destroy', $p->id) }}"
                      method="POST"
                      style="display:none">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button"
                        onclick="showDeleteModal('{{ route('admin.perangkat.destroy', $p->id) }}', 'Hapus Perangkat', 'Hapus {{ $p->nama }}?')"
                        class="text-xs text-red-600 font-bold hover:underline">
                    Hapus
                </button>
            </div>
        </div>
    @empty
        <div class="col-span-4 text-center py-12 text-gray-400">
            <p class="text-4xl mb-2">👥</p>
            <p>Belum ada perangkat desa</p>
        </div>
    @endforelse
</div>

@endsection
