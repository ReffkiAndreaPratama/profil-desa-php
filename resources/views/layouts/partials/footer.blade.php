{{-- ============================================================
     Partial: Footer
     Dipakai di: layouts/public.blade.php
     ============================================================ --}}

@php
// Footer fetches settings directly so it works from any layout context
$footerDesa = \App\Models\Pengaturan::pluck('value', 'key')->toArray();
$footerWa   = $footerDesa['whatsapp']        ?? '6281234567890';
$footerEm   = $footerDesa['email']           ?? 'desatalangmarap@gmail.com';
$footerAl   = $footerDesa['alamat']          ?? 'Jl. Raya Talang Marap No. 1';
$footerJam  = $footerDesa['jam_operasional'] ?? 'Senin–Jumat 08.00–16.00';
$footerWaFmt = '+62 ' . substr($footerWa, 2); // 628xxx → +62 8xxx
@endphp

<footer class="bg-[#212121] text-white border-t-4 border-[#2E7D32]">
    <div class="container-custom py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Brand --}}
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    @if(!empty($footerDesa['logo']))
                        <img src="@fotoUrl($footerDesa['logo'])" alt="Logo Desa" class="w-12 h-12 rounded-xl border-2 border-[#66BB6A] object-cover"/>
                    @else
                        <div class="w-12 h-12 rounded-xl bg-[#2E7D32] border-2 border-[#66BB6A]
                                    flex items-center justify-center">
                            <span class="text-white font-black text-xl">T</span>
                        </div>
                    @endif
                    <div>
                        <p class="font-black text-lg">{{ $footerDesa['nama_desa'] ?? 'Desa Talang Marap' }}</p>
                        <p class="text-gray-400 text-sm">
                            {{ $footerDesa['kecamatan'] ?? 'Kec. Kelam Tengah' }},
                            {{ $footerDesa['kabupaten'] ?? 'Kab. Kaur' }},
                            {{ $footerDesa['provinsi']  ?? 'Bengkulu' }}
                        </p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                    {{ $footerDesa['tagline'] ?? 'Mengenal Desa, Mengelola Data, Membangun Masa Depan.' }}
                </p>
                <p class="text-gray-500 text-xs">Dikembangkan oleh KKN UNIB Periode 108 Kelompok 146</p>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="font-black text-sm mb-4 text-[#66BB6A]" data-i18n="footer_layanan">LAYANAN</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('aspirasi') }}" class="hover:text-[#66BB6A] transition-colors">Aspirasi Masyarakat</a></li>
                    <li><a href="{{ route('peta') }}"     class="hover:text-[#66BB6A] transition-colors">Peta Interaktif</a></li>
                    <li><a href="{{ route('kalender') }}" class="hover:text-[#66BB6A] transition-colors">Kalender Kegiatan</a></li>
                    <li><a href="{{ route('data') }}"     class="hover:text-[#66BB6A] transition-colors">Data Statistik</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-black text-sm mb-4 text-[#66BB6A]" data-i18n="footer_kontak">KONTAK</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li class="flex items-start gap-2">📍 {{ $footerAl }}</li>
                    <li class="flex items-center gap-2">
                        📞 <a href="https://wa.me/{{ $footerWa }}" class="hover:text-[#66BB6A]">{{ $footerWaFmt }}</a>
                    </li>
                    <li class="flex items-center gap-2">✉️ {{ $footerEm }}</li>
                    <li class="flex items-center gap-2">🕐 {{ $footerJam }}</li>
                </ul>
            </div>

        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-gray-800 mt-8 pt-6
                    flex flex-col md:flex-row items-center justify-between gap-3
                    text-gray-500 text-xs">

            <span>
                © {{ date('Y') }}
                <span data-i18n="footer_copy">Smart Village Talang Marap. All rights reserved.</span>
            </span>

            {{-- Theme & language toggles --}}
            <div class="flex items-center gap-3">
                <button onclick="toggleDark()"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                               border border-gray-600 hover:border-[#66BB6A] hover:text-[#66BB6A]
                               transition-all text-xs font-bold">
                    <span id="darkIconFooter">🌙</span>
                    <span id="darkModeLabel">Mode Malam</span>
                </button>
                <button onclick="toggleLang()"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                               border border-gray-600 hover:border-[#66BB6A] hover:text-[#66BB6A]
                               transition-all text-xs font-bold">
                    🌐 <span id="langLabelFooter">EN</span>
                </button>
            </div>

        </div>
    </div>
</footer>
