@extends('layouts.admin')
@section('title', 'Pesan Kontak')
@section('page_title', 'Pesan Kontak')
@section('content')
<div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
    <div class="bg-[#212121] p-4"><h3 class="font-black text-white">✉️ Pesan Masuk ({{ $pesan->total() }})</h3></div>
    <div class="divide-y divide-gray-100">
        @forelse($pesan as $p)
        <div class="p-4 flex items-start gap-4 {{ $p->sudah_dibaca ? '' : 'bg-blue-50' }}">
            <div class="w-10 h-10 {{ $p->sudah_dibaca ? 'bg-gray-100' : 'bg-blue-100' }} rounded-full flex items-center justify-center text-sm shrink-0">
                {{ $p->sudah_dibaca ? '✉️' : '📩' }}
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <p class="font-bold text-sm">{{ $p->nama }}</p>
                    @if(!$p->sudah_dibaca)<span class="text-[10px] bg-blue-500 text-white px-2 py-0.5 rounded-full font-bold">Baru</span>@endif
                </div>
                <p class="text-xs text-gray-400">{{ $p->email }} · {{ $p->subjek }}</p>
                <p class="text-gray-600 text-sm mt-1 line-clamp-2">{{ $p->pesan }}</p>
                <p class="text-gray-400 text-xs mt-1">{{ $p->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex gap-2 shrink-0">
                @if(!$p->sudah_dibaca)
                <form action="{{ route('admin.pesan-kontak.read', $p->id) }}" method="POST">@csrf @method('PATCH')
                    <button class="brutal-btn bg-blue-500 text-white px-2 py-1 rounded-lg text-xs">✓ Baca</button>
                </form>
                @endif
                <form action="{{ route('admin.pesan-kontak.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
                    <button class="brutal-btn bg-red-500 text-white px-2 py-1 rounded-lg text-xs">🗑️</button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-12 text-center text-gray-400">Belum ada pesan</div>
        @endforelse
    </div>
    <div class="p-4 border-t">{{ $pesan->links() }}</div>
</div>
@endsection
