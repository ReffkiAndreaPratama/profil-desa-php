@extends('layouts.admin')
@section('title', 'Kelola Galeri')
@section('page_title', 'Kelola Galeri')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-black">Galeri Foto ({{ $galeri->total() }})</h2>
    <a href="{{ route('admin.galeri.create') }}" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">+ Tambah Foto</a>
</div>
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
    @forelse($galeri as $g)
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
        <img src="{{ $g->foto }}" alt="{{ $g->judul }}" class="w-full h-32 object-cover"/>
        <div class="p-3">
            <p class="font-bold text-xs truncate">{{ $g->judul }}</p>
            <p class="text-[10px] text-gray-400">{{ $g->kategori }} · {{ $g->tanggal->format('d M Y') }}</p>
            <div class="flex gap-2 mt-2">
                <a href="{{ route('admin.galeri.edit', $g->id) }}" class="text-xs text-blue-600 font-bold">Edit</a>
                <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-xs text-red-600 font-bold">Hapus</button></form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-4 text-center py-12 text-gray-400">Belum ada foto</div>
    @endforelse
</div>
<div class="mt-6">{{ $galeri->links() }}</div>
@endsection
