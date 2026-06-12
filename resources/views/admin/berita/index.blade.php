@extends('layouts.admin')
@section('title', 'Kelola Berita')
@section('page_title', 'Kelola Berita')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..."
               class="px-4 py-2 border-2 border-[#212121] rounded-xl text-sm outline-none focus:border-[#2E7D32]"/>
        <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl text-sm">Cari</button>
    </form>
    <a href="{{ route('admin.berita.create') }}" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">
        + Tambah Berita
    </a>
</div>

<div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
    <div class="bg-[#2E7D32] p-4">
        <h3 class="font-black text-white">📰 Daftar Berita ({{ $berita->total() }})</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b-2 border-[#212121]">
                <tr>
                    <th class="px-4 py-3 text-left font-black">#</th>
                    <th class="px-4 py-3 text-left font-black">Judul</th>
                    <th class="px-4 py-3 text-left font-black">Kategori</th>
                    <th class="px-4 py-3 text-left font-black">Tanggal</th>
                    <th class="px-4 py-3 text-left font-black">Views</th>
                    <th class="px-4 py-3 text-left font-black">Status</th>
                    <th class="px-4 py-3 text-left font-black">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($berita as $b)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-400">{{ $b->id }}</td>
                    <td class="px-4 py-3 font-semibold max-w-xs">
                        <p class="truncate">{{ $b->judul }}</p>
                        <p class="text-xs text-gray-400">{{ $b->penulis }}</p>
                    </td>
                    <td class="px-4 py-3"><span class="bg-[#E8F5E9] text-[#2E7D32] px-2 py-1 rounded-full text-xs font-bold">{{ $b->kategori }}</span></td>
                    <td class="px-4 py-3 text-gray-500">{{ $b->tanggal->format('d M Y') }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $b->views }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-bold {{ $b->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $b->published ? 'Publik' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.berita.edit', $b->id) }}" class="brutal-btn bg-[#1565C0] text-white px-3 py-1.5 rounded-lg text-xs">✏️ Edit</a>
                            <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="brutal-btn bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-4 py-12 text-center text-gray-400">Belum ada berita</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-200">{{ $berita->links() }}</div>
</div>
@endsection
