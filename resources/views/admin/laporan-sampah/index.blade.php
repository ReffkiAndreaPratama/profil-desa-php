@extends('layouts.admin')
@section('title', 'Laporan Sampah')
@section('page_title', 'Laporan Sampah')
@section('content')
<div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
    <div class="bg-red-500 p-4 flex items-center justify-between">
        <h3 class="font-black text-white">⚠️ Laporan Sampah ({{ $laporan->total() }})</h3>
        <div class="flex gap-2">
            @foreach([''=>'Semua','diterima'=>'Baru','diproses'=>'Diproses','selesai'=>'Selesai'] as $v=>$l)
            <a href="?status={{ $v }}" class="text-xs px-3 py-1 rounded-full font-bold {{ request('status','') === $v ? 'bg-white text-red-500' : 'bg-white/20 text-white' }}">{{ $l }}</a>
            @endforeach
        </div>
    </div>
    <div class="divide-y divide-gray-100">
        @forelse($laporan as $l)
        <div class="p-4 flex items-start gap-4">
            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-lg shrink-0">⚠️</div>
            <div class="flex-1">
                <p class="font-bold text-sm">{{ $l->nama }}</p>
                <p class="text-gray-500 text-xs">📍 {{ $l->lokasi }}</p>
                <p class="text-gray-600 text-sm mt-1">{{ $l->deskripsi }}</p>
                @if($l->catatan_admin)<p class="text-[#2E7D32] text-xs mt-2 bg-[#E8F5E9] p-2 rounded-lg">Admin: {{ $l->catatan_admin }}</p>@endif
                <p class="text-gray-400 text-xs mt-1">{{ $l->created_at->diffForHumans() }}</p>
            </div>
            <form action="{{ route('admin.laporan-sampah.status', $l->id) }}" method="POST" class="shrink-0 flex flex-col gap-1">
                @csrf @method('PATCH')
                <select name="status" class="text-xs border-2 border-[#212121] rounded-lg px-2 py-1">
                    @foreach(['diterima','diproses','selesai'] as $s)<option value="{{ $s }}" {{ $l->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>@endforeach
                </select>
                <input type="text" name="catatan_admin" placeholder="Catatan..." value="{{ $l->catatan_admin }}" class="text-xs border-2 border-[#212121] rounded-lg px-2 py-1"/>
                <button class="brutal-btn bg-[#2E7D32] text-white px-2 py-1 rounded-lg text-xs">Update</button>
            </form>
        </div>
        @empty
        <div class="p-12 text-center text-gray-400">Belum ada laporan</div>
        @endforelse
    </div>
    <div class="p-4 border-t">{{ $laporan->links() }}</div>
</div>
@endsection
