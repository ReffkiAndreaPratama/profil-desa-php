@extends('layouts.admin')

@section('title', isset($user) ? 'Edit User' : 'Tambah User')
@section('page_title', isset($user) ? 'Edit User' : 'Tambah User')

@section('content')
<div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-6 max-w-2xl">
    <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div>
            <label class="block font-bold text-sm mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl" />
        </div>

        <div>
            <label class="block font-bold text-sm mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl" />
        </div>

        <div>
            <label class="block font-bold text-sm mb-2">Password {{ isset($user) ? '(opsional)' : '' }}</label>
            <input type="password" name="password" {{ isset($user) ? '' : 'required' }} class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl" />
        </div>

        <div>
            <label class="block font-bold text-sm mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl" />
        </div>

        <div>
            <label class="block font-bold text-sm mb-2">Role</label>
            <select name="role" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl bg-white">
                <option value="editor" {{ old('role', $user->role ?? 'editor') === 'editor' ? 'selected' : '' }}>Editor</option>
                <option value="admin" {{ old('role', $user->role ?? 'editor') === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-6 py-3 rounded-xl font-black">💾 Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">Batal</a>
        </div>
    </form>
</div>
@endsection
