{{-- ============================================================
     Partial: Page Header (gradient green banner)
     Usage: @include('layouts.partials.page-header', ['title' => '...', 'subtitle' => '...'])
     ============================================================ --}}

<div class="gradient-green border-b-4 border-[#212121] py-10">
    <div class="container-custom">
        <h1 class="text-3xl font-black text-white mb-1">{{ $title }}</h1>

        @isset($subtitle)
            <p class="text-white/70">{{ $subtitle }}</p>
        @endisset
    </div>
</div>
