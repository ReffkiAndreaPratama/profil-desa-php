{{-- ── Partial: Flash Messages (Neo-Brutalist & Dynamic Toast Style) ── --}}

@if(session('success'))
    <div x-data="{ show: true, progress: 100 }"
         x-show="show"
         x-init="
             let interval = setInterval(() => {
                 progress -= 2;
                 if (progress <= 0) {
                     clearInterval(interval);
                     show = false;
                 }
             }, 100);
         "
         x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-y-[-10px]"
         x-transition:enter-start="opacity-0 translate-y-[-10px]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300 transform opacity-0 translate-y-2"
         class="relative mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/20 border-4 border-emerald-600 rounded-2xl 
                text-emerald-900 dark:text-emerald-300 font-bold text-sm shadow-[4px_4px_0_#059669] flex items-center justify-between gap-4 overflow-hidden">
        <div class="flex items-center gap-3">
            <span class="text-xl shrink-0">✨</span>
            <div>
                <p class="font-black">Berhasil!</p>
                <p class="font-semibold text-xs opacity-90">{{ session('success') }}</p>
            </div>
        </div>
        <button @click="show = false" class="text-emerald-700 hover:text-emerald-950 dark:text-emerald-400 dark:hover:text-emerald-200 text-lg font-black shrink-0 transition-colors">
            ✕
        </button>
        {{-- Progress Bar Indicator --}}
        <div class="absolute bottom-0 left-0 h-1 bg-emerald-600 transition-all duration-100" :style="`width: ${progress}%`"></div>
    </div>
@endif

@if(session('error'))
    <div x-data="{ show: true, progress: 100 }"
         x-show="show"
         x-init="
             let interval = setInterval(() => {
                 progress -= 2;
                 if (progress <= 0) {
                     clearInterval(interval);
                     show = false;
                 }
             }, 100);
         "
         x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-y-[-10px]"
         x-transition:enter-start="opacity-0 translate-y-[-10px]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300 transform opacity-0 translate-y-2"
         class="relative mb-6 p-4 bg-rose-50 dark:bg-rose-950/20 border-4 border-rose-600 rounded-2xl 
                text-rose-900 dark:text-rose-300 font-bold text-sm shadow-[4px_4px_0_#e11d48] flex items-center justify-between gap-4 overflow-hidden">
        <div class="flex items-center gap-3">
            <span class="text-xl shrink-0">⚠️</span>
            <div>
                <p class="font-black">Gagal!</p>
                <p class="font-semibold text-xs opacity-90">{{ session('error') }}</p>
            </div>
        </div>
        <button @click="show = false" class="text-rose-700 hover:text-rose-950 dark:text-rose-400 dark:hover:text-rose-200 text-lg font-black shrink-0 transition-colors">
            ✕
        </button>
        {{-- Progress Bar Indicator --}}
        <div class="absolute bottom-0 left-0 h-1 bg-rose-600 transition-all duration-100" :style="`width: ${progress}%`"></div>
    </div>
@endif

@if($errors->any())
    <div x-data="{ show: true }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-y-[-10px]"
         x-transition:enter-start="opacity-0 translate-y-[-10px]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300 transform opacity-0 translate-y-2"
         class="relative mb-6 p-4 bg-rose-50 dark:bg-rose-950/20 border-4 border-rose-600 rounded-2xl 
                text-rose-900 dark:text-rose-300 font-bold text-sm shadow-[4px_4px_0_#e11d48] flex flex-col gap-2 overflow-hidden">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="text-xl shrink-0">⚠️</span>
                <p class="font-black">Terjadi Kesalahan Validasi Form!</p>
            </div>
            <button @click="show = false" class="text-rose-700 hover:text-rose-950 dark:text-rose-400 dark:hover:text-rose-200 text-lg font-black shrink-0 transition-colors">
                ✕
            </button>
        </div>
        <ul class="list-disc pl-8 font-semibold text-xs leading-relaxed space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
