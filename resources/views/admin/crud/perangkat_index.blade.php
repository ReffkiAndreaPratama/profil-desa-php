@extends('layouts.admin')
@section('title', 'Perangkat Desa')
@section('page_title', 'Perangkat Desa')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-black">Perangkat Desa ({{ $items->count() }})</h2>
    <a href="{{ route('admin.perangkat.create') }}" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">+ Tambah</a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($items as $p)
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-4 text-center">
        <img src="{{ $p->foto ?? 'https://ui-avatars.com/api/?name='.urlencode($p->nama).'&background=2E7D32&color=fff' }}" class="w-16 h-16 rounded-full mx-auto mb-2 border-4 border-[#2E7D32]"/>
        <p class="font-black text-sm">{{ $p->nama }}</p>
        <p class="text-[#2E7D32] text-xs font-bold">{{ $p->jabatan }}</p>
        <div class="flex gap-2 justify-center mt-3">
            <a href="{{ route('admin.perangkat.edit', $p->id) }}" class="text-xs text-blue-600 font-bold">Edit</a>
            <form action="{{ route('admin.perangkat.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-xs text-red-600 font-bold">Hapus</button></form>
        </div>
    </div>
    @endforeach
</div>
@endsection
