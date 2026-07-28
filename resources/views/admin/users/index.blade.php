@extends('layouts.admin')

@section('title', 'Kelola User')
@section('page_title', 'Kelola User')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-black">Daftar User</h2>
    <a href="{{ route('admin.users.create') }}" class="brutal-btn bg-[#2E7D32] text-white px-4 py-2 rounded-xl font-bold text-sm">
        + Tambah User
    </a>
</div>

<div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b-2 border-[#212121]">
                <tr>
                    <th class="px-4 py-3 text-left font-black">Nama</th>
                    <th class="px-4 py-3 text-left font-black">Email</th>
                    <th class="px-4 py-3 text-left font-black">Role</th>
                    <th class="px-4 py-3 text-left font-black">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($users as $u)
                    <tr>
                        <td class="px-4 py-3 font-semibold">{{ $u->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $u->email }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-bold {{ $u->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="brutal-btn bg-[#1565C0] text-white px-3 py-1.5 rounded-lg text-xs">✏️ Edit</a>
                            @if($u->id !== auth()->id())
                                <form id="delete-user-form-{{ $u->id }}" action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" 
                                        onclick="showDeleteModal('{{ route('admin.users.destroy', $u->id) }}', 'Hapus User', 'Hapus user {{ addslashes($u->name) }} ({{ $u->email }})?')" 
                                        class="brutal-btn bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs">
                                    🗑️ Hapus
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
