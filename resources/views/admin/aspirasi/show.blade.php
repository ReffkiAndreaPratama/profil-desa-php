@extends('layouts.admin')

@section('title', 'Detail Aspirasi')
@section('page_title', 'Detail Aspirasi')

@section('content')

<div class="max-w-2xl">

    <a href="{{ route('admin.aspirasi.index') }}"
       class="text-sm font-bold text-[#2E7D32] mb-4 inline-block">
        ← Kembali
    </a>

    <div class="bg-white border-4 border-[#212121] rounded-2xl shadow-[4px_4px_0_#212121] p-6">

        {{-- ── Aspirasi detail ── --}}
        <p class="font-black text-lg mb-2">
            {{ $aspirasi->anonim ? 'Anonim' : $aspirasi->nama }}
        </p>
        <p class="text-sm text-gray-400 mb-4">
            {{ $aspirasi->kategori }} · {{ $aspirasi->created_at->format('d M Y H:i') }}
        </p>
        <p class="text-gray-700 mb-6">{{ $aspirasi->pesan }}</p>

        {{-- ── Update form ── --}}
        <form action="{{ route('admin.aspirasi.status', $aspirasi->id) }}"
              method="POST"
              class="space-y-4 border-t pt-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block font-bold text-sm mb-2">Status</label>
                <select name="status"
                        class="w-full mt-1 px-4 py-2 border-[3px] border-[#212121] rounded-xl bg-white
                               outline-none focus:border-[#2E7D32]">
                    @foreach(['diterima', 'diproses', 'selesai', 'ditolak'] as $s)
                        <option value="{{ $s }}" {{ $aspirasi->status === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold text-sm mb-2">Balasan</label>
                <textarea
                    name="balasan"
                    rows="3"
                    class="w-full mt-1 px-4 py-3 border-[3px] border-[#212121] rounded-xl
                           outline-none focus:border-[#2E7D32] resize-none">{{ $aspirasi->balasan }}</textarea>
            </div>

            <button
                type="submit"
                class="brutal-btn bg-[#2E7D32] text-white px-6 py-2 rounded-xl font-black">
                💾 Simpan
            </button>
        </form>

    </div>
</div>

@endsection
