@extends('layouts.admin')
@section('title', 'Kelola ' . $title)
@section('page_title', 'Kelola ' . $title)

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-black">{{ $title }} ({{ $items->total() }})</h2>
    <a href="{{ route($createRoute) }}" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">+ Tambah</a>
</div>

<div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[#2E7D32] text-white">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    @foreach($columns as $col)
                    <th class="px-4 py-3 text-left">{{ ucfirst(str_replace('_',' ',$col)) }}</th>
                    @endforeach
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($items as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-400">{{ $item->id }}</td>
                    @foreach($columns as $col)
                    <td class="px-4 py-3 max-w-xs truncate">{{ $item->$col }}</td>
                    @endforeach
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route($editRoute, $item->id) }}" class="brutal-btn bg-blue-500 text-white px-3 py-1.5 rounded-lg text-xs">✏️</a>
                            <form action="{{ route($deleteRoute, $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="brutal-btn bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="{{ count($columns)+2 }}" class="px-4 py-12 text-center text-gray-400">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t">{{ $items->links() }}</div>
</div>
@endsection
