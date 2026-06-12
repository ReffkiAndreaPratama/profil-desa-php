@extends('layouts.admin')
@section('title', ($item ? 'Edit' : 'Tambah') . ' ' . $title)
@section('page_title', ($item ? 'Edit' : 'Tambah') . ' ' . $title)

@section('content')
<div class="max-w-3xl">
    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] overflow-hidden">
        <div class="bg-[#2E7D32] p-4"><h3 class="font-black text-white">{{ $item ? '✏️ Edit' : '➕ Tambah' }} {{ $title }}</h3></div>
        <form action="{{ $item ? route($updateRoute, $item->id) : route($storeRoute) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @if($item) @method('PUT') @endif

            @foreach($fields as $field)
            <div>
                <label class="block font-bold text-sm mb-2">{{ $field['label'] }} {{ ($field['required'] ?? false) ? '*' : '' }}</label>
                @if(($field['type'] ?? 'text') === 'textarea')
                <textarea name="{{ $field['name'] }}" rows="{{ $field['rows'] ?? 4 }}" {{ ($field['required'] ?? false) ? 'required' : '' }}
                    class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] resize-none">{{ old($field['name'], $item->{$field['name']} ?? '') }}</textarea>
                @elseif(($field['type'] ?? 'text') === 'select')
                <select name="{{ $field['name'] }}" class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] bg-white">
                    @foreach($field['options'] as $opt)
                    <option value="{{ $opt }}" {{ old($field['name'], $item->{$field['name']} ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
                @elseif(($field['type'] ?? 'text') === 'checkbox')
                <div class="flex items-center gap-2">
                    <input type="hidden" name="{{ $field['name'] }}" value="0"/>
                    <input type="checkbox" name="{{ $field['name'] }}" value="1" {{ old($field['name'], $item->{$field['name']} ?? true) ? 'checked' : '' }} class="w-4 h-4"/>
                    <span class="text-sm text-gray-600">{{ $field['hint'] ?? 'Aktifkan' }}</span>
                </div>
                @else
                <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}" value="{{ old($field['name'], $item->{$field['name']} ?? ($field['default'] ?? '')) }}" {{ ($field['required'] ?? false) ? 'required' : '' }}
                    placeholder="{{ $field['placeholder'] ?? '' }}"
                    class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32]"/>
                @endif
                @error($field['name'])<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            @endforeach

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="brutal-btn bg-[#2E7D32] text-white px-8 py-3 rounded-xl font-black">💾 Simpan</button>
                <a href="{{ route($indexRoute) }}" class="brutal-btn bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
