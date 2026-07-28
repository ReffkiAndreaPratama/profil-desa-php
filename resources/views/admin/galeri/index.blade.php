@extends('layouts.admin')

@section('title', 'Kelola Galeri')
@section('page_title', 'Kelola Galeri')

@section('content')

{{-- ── Header bar ── --}}
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-black">Galeri Foto ({{ $galeri->total() }})</h2>
    <a href="{{ route('admin.galeri.create') }}"
       class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">
        + Tambah Foto
    </a>
</div>

{{-- ── Photo grid ── --}}
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
    @forelse($galeri as $g)
        <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
            <img src="{{ \App\Helpers\FotoHelper::url($g->foto) }}"
                 alt="{{ $g->judul }}"
                 class="w-full h-32 object-cover"/>
            <div class="p-3">
                <p class="font-bold text-xs truncate">{{ $g->judul }}</p>
                <p class="text-[10px] text-gray-400">
                    {{ $g->kategori }} · {{ $g->tanggal->format('d M Y') }}
                </p>
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('admin.galeri.edit', $g->id) }}"
                       class="text-xs text-blue-600 font-bold hover:underline">
                        Edit
                    </a>
                    <form id="del-galeri-{{ $g->id }}"
                          action="{{ route('admin.galeri.destroy', $g->id) }}"
                          method="POST"
                          style="display:none">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button"
                            onclick="showDeleteModal('{{ route('admin.galeri.destroy', $g->id) }}', 'Hapus Foto', '{{ addslashes($g->judul) }}')"
                            class="text-xs text-red-600 font-bold hover:underline">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-4 text-center py-12 text-gray-400">
            Belum ada foto
        </div>
    @endforelse
</div>

{{-- ── Pagination ── --}}
<div class="mt-6">{{ $galeri->links() }}</div>

@endsection
