@extends('layouts.admin')
@section('title', 'Aspirasi Masyarakat')
@section('page_title', 'Aspirasi Masyarakat')
@section('content')
<div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
    <div class="bg-[#2E7D32] p-4 flex items-center justify-between">
        <h3 class="font-black text-white">💬 Aspirasi ({{ $aspirasi->total() }})</h3>
        <form method="GET" class="flex gap-2">
            @foreach([''=>'Semua','diterima'=>'Baru','diproses'=>'Diproses','selesai'=>'Selesai'] as $val=>$lab)
            <a href="?status={{ $val }}" class="text-xs px-3 py-1 rounded-full font-bold {{ request('status','') === $val ? 'bg-white text-[#2E7D32]' : 'bg-white/20 text-white' }}">{{ $lab }}</a>
            @endforeach
        </form>
    </div>
    <div class="divide-y divide-gray-100">
        @forelse($aspirasi as $a)
        <div class="p-4 flex items-start gap-4">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center shrink-0 font-black text-sm">{{ $a->anonim ? '👤' : strtoupper(substr($a->nama,0,1)) }}</div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <p class="font-bold text-sm">{{ $a->anonim ? 'Anonim' : $a->nama }}</p>
                    <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full">{{ $a->kategori }}</span>
                    @php $colors=['diterima'=>'bg-blue-100 text-blue-700','diproses'=>'bg-yellow-100 text-yellow-700','selesai'=>'bg-green-100 text-green-700','ditolak'=>'bg-red-100 text-red-700']; @endphp
                    <span class="text-xs px-2 py-0.5 rounded-full font-bold {{ $colors[$a->status] ?? '' }}">{{ ucfirst($a->status) }}</span>
                </div>
                <p class="text-gray-600 text-sm">{{ $a->pesan }}</p>
                @if($a->balasan)<p class="text-[#2E7D32] text-xs mt-2 font-medium bg-[#E8F5E9] p-2 rounded-lg">💬 Balasan: {{ $a->balasan }}</p>@endif
                <p class="text-gray-400 text-xs mt-1">{{ $a->created_at->diffForHumans() }}</p>
            </div>
            <div class="shrink-0">
                <form action="{{ route('admin.aspirasi.status', $a->id) }}" method="POST" class="flex flex-col gap-1">
                    @csrf @method('PATCH')
                    <select name="status" class="text-xs border-2 border-[#212121] rounded-lg px-2 py-1">
                        @foreach(['diterima','diproses','selesai','ditolak'] as $s)<option value="{{ $s }}" {{ $a->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>@endforeach
                    </select>
                    <input type="text" name="balasan" placeholder="Balasan..." value="{{ $a->balasan }}" class="text-xs border-2 border-[#212121] rounded-lg px-2 py-1"/>
                    <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-2 py-1 rounded-lg text-xs">Update</button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-12 text-center text-gray-400">Belum ada aspirasi</div>
        @endforelse
    </div>
    <div class="p-4 border-t">{{ $aspirasi->links() }}</div>
</div>
@endsection
