{{-- ============================================================
     Partial: Foto Input (URL + Upload)
     Usage:
       @include('admin.shared.foto_input', [
           'currentFoto' => $item->foto ?? null,
           'label'       => 'Foto',    // optional
           'required'    => false,     // optional
       ])
     ============================================================ --}}

@php
    $fotoLabel    = $label    ?? 'Foto';
    $fotoRequired = $required ?? false;

    // Resolve current preview URL
    $previewUrl = null;
    if (!empty($currentFoto)) {
        if (str_starts_with($currentFoto, 'http')) {
            $previewUrl = $currentFoto;
        } else {
            $previewUrl = Storage::disk('public')->url($currentFoto);
        }
    }
@endphp

<div x-data="{ mode: '{{ $currentFoto && !str_starts_with($currentFoto, 'http') ? 'upload' : 'url' }}' }">

    <label class="block font-bold text-sm mb-2">{{ $fotoLabel }}</label>

    {{-- Mode toggle --}}
    <div class="flex gap-2 mb-3">
        <button type="button"
                @click="mode = 'url'"
                :class="mode === 'url'
                    ? 'bg-[#2E7D32] text-white border-[#2E7D32]'
                    : 'bg-white text-[#212121] border-[#212121]'"
                class="brutal-btn px-4 py-2 rounded-xl text-xs font-bold border-2 transition-all">
            🔗 Link URL
        </button>
        <button type="button"
                @click="mode = 'upload'"
                :class="mode === 'upload'
                    ? 'bg-[#2E7D32] text-white border-[#2E7D32]'
                    : 'bg-white text-[#212121] border-[#212121]'"
                class="brutal-btn px-4 py-2 rounded-xl text-xs font-bold border-2 transition-all">
            📁 Upload File
        </button>
    </div>

    {{-- URL input --}}
    <div x-show="mode === 'url'">
        <input
            type="url"
            name="foto"
            id="foto_url"
            value="{{ old('foto', $currentFoto && str_starts_with($currentFoto, 'http') ? $currentFoto : '') }}"
            placeholder="https://images.unsplash.com/..."
            :required="mode === 'url' && {{ $fotoRequired && !$previewUrl ? 'true' : 'false' }}"
            class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl
                   outline-none focus:border-[#2E7D32]"/>
        <p class="text-xs text-gray-400 mt-1">Masukkan URL gambar dari Unsplash, Imgur, atau hosting lain.</p>
    </div>

    {{-- File upload --}}
    <div x-show="mode === 'upload'" x-cloak>
        <div class="border-[3px] border-dashed border-[#212121] rounded-xl p-4
                    hover:border-[#2E7D32] transition-colors cursor-pointer"
             onclick="document.getElementById('foto_upload').click()">
            <input
                type="file"
                name="foto_upload"
                id="foto_upload"
                accept="image/jpeg,image/png,image/webp,image/gif"
                class="hidden"
                onchange="previewFoto(this)"/>
            <div class="text-center" id="uploadPlaceholder">
                <p class="text-3xl mb-2">📁</p>
                <p class="font-bold text-sm">Klik untuk pilih gambar</p>
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP · Maks 2MB</p>
            </div>
        </div>
    </div>

    {{-- Preview gambar (current atau yang baru dipilih) --}}
    @if($previewUrl)
    <div class="mt-3" id="fotoPreviewContainer">
        <p class="text-xs text-gray-400 mb-1">Preview saat ini:</p>
        <img id="fotoPreview"
             src="{{ $previewUrl }}"
             alt="Preview"
             class="h-32 w-auto object-cover rounded-xl border-2 border-[#212121]"/>
    </div>
    @else
    <div class="mt-3 hidden" id="fotoPreviewContainer">
        <p class="text-xs text-gray-400 mb-1">Preview:</p>
        <img id="fotoPreview" src="" alt="Preview"
             class="h-32 w-auto object-cover rounded-xl border-2 border-[#212121]"/>
    </div>
    @endif

</div>

@once
@push('scripts')
<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        var file = input.files[0];

        // Validate size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            return;
        }

        var reader = new FileReader();
        reader.onload = function(e) {
            var container = document.getElementById('fotoPreviewContainer');
            var preview   = document.getElementById('fotoPreview');
            var placeholder = document.getElementById('uploadPlaceholder');

            preview.src = e.target.result;
            container.classList.remove('hidden');

            if (placeholder) {
                placeholder.innerHTML = '<p class="text-sm font-bold text-[#2E7D32]">✅ ' + file.name + '</p>'
                    + '<p class="text-xs text-gray-400">' + (file.size / 1024).toFixed(1) + ' KB</p>';
            }
        };
        reader.readAsDataURL(file);
    }
}

// Sync URL input preview
document.addEventListener('DOMContentLoaded', function() {
    var urlInput = document.getElementById('foto_url');
    if (urlInput) {
        urlInput.addEventListener('blur', function() {
            var val = this.value.trim();
            if (val && val.startsWith('http')) {
                var preview = document.getElementById('fotoPreview');
                var container = document.getElementById('fotoPreviewContainer');
                if (preview) {
                    preview.src = val;
                    container.classList.remove('hidden');
                }
            }
        });
    }
});
</script>
@endpush
@endonce
