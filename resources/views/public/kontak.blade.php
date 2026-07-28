@extends('layouts.public')

@section('title', 'Kontak - Smart Village Talang Marap')

@section('content')

<div class="min-h-screen bg-[#FFFDF7] dark:bg-[#121212] pt-24">

    {{-- ── Page header ── --}}
    @include('layouts.partials.page-header', [
        'title'    => 'Hubungi Kami',
        'subtitle' => 'Kantor Desa Talang Marap siap melayani Anda',
    ])

    <div class="container-custom py-10">

        {{-- ── Flash messages ── --}}
        @include('layouts.partials.flash')

        {{-- ── Contact info + form grid ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Contact info --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-black mb-6">Informasi Kontak</h2>

                @php
                $contacts = [
                    ['icon' => '📍', 'label' => 'Alamat',          'value' => $desa['alamat'] ?? 'Jl. Raya Talang Marap No. 1'],
                    ['icon' => '📞', 'label' => 'WhatsApp',        'value' => '+62 ' . substr($desa['whatsapp'] ?? '6281234567890', 2)],
                    ['icon' => '✉️', 'label' => 'Email',            'value' => $desa['email'] ?? 'desatalangmarap@gmail.com'],
                    ['icon' => '🕐', 'label' => 'Jam Operasional', 'value' => $desa['jam_operasional'] ?? 'Senin-Jumat 08.00-16.00'],
                ];
                @endphp

                @foreach($contacts as $c)
                    <div class="brutal-card p-5 flex items-center gap-4">
                        <div class="text-3xl w-12 h-12 flex items-center justify-center
                                    bg-[#E8F5E9] rounded-xl border-2 border-[#2E7D32] shrink-0">
                            {{ $c['icon'] }}
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">{{ $c['label'] }}</p>
                            <p class="font-bold text-sm">{{ $c['value'] }}</p>
                        </div>
                    </div>
                @endforeach

                <a href="https://wa.me/{{ $desa['whatsapp'] ?? '6281234567890' }}"
                   target="_blank"
                   class="brutal-btn bg-green-500 text-white w-full py-3 rounded-xl
                          font-black text-center block mt-4">
                    💬 Chat via WhatsApp
                </a>
            </div>

            {{-- Contact form --}}
            <div class="brutal-card p-8">
                <h2 class="font-black text-xl mb-6">📬 Kirim Pesan</h2>

                <form action="{{ route('kontak.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-sm mb-2">Nama *</label>
                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama') }}"
                                required
                                class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                                       outline-none focus:border-[#2E7D32]
                                       @error('nama') border-red-500 @enderror"/>
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-bold text-sm mb-2">Telepon</label>
                            <input
                                type="text"
                                name="telepon"
                                value="{{ old('telepon') }}"
                                class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                                       outline-none focus:border-[#2E7D32]"/>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-sm mb-2">Email *</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                                   outline-none focus:border-[#2E7D32]
                                   @error('email') border-red-500 @enderror"/>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-sm mb-2">Subjek</label>
                        <input
                            type="text"
                            name="subjek"
                            value="{{ old('subjek') }}"
                            class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                                   outline-none focus:border-[#2E7D32]"/>
                    </div>

                    <div>
                        <label class="block font-bold text-sm mb-2">Pesan *</label>
                        <textarea
                            name="pesan"
                            rows="5"
                            required
                            class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                                   outline-none focus:border-[#2E7D32] resize-none
                                   @error('pesan') border-red-500 @enderror">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full brutal-btn bg-[#2E7D32] text-white py-3 rounded-xl font-black">
                        Kirim Pesan →
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
