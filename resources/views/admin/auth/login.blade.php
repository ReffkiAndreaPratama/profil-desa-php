<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Panel — Smart Village Talang Marap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <style>
        body       { font-family: 'Inter', sans-serif; }
        .brutal-btn { border: 3px solid #111827; box-shadow: 4px 4px 0 #111827; font-weight: 700; transition: all .15s; cursor: pointer; }
        .brutal-btn:hover { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 #111827; }
    </style>
</head>
<body class="min-h-screen bg-[#060816] text-slate-100 flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        @php
        $loginLogo = \App\Models\Pengaturan::where('key', 'logo')->value('value');
        @endphp
        {{-- ── Logo & title ── --}}
        <div class="text-center mb-8">
            @if(!empty($loginLogo))
                <img src="{{ \App\Helpers\FotoHelper::url($loginLogo) }}" alt="Logo Desa" class="w-20 h-20 rounded-2xl border-4 border-[#111827] shadow-[6px_6px_0_#111827] object-cover mx-auto mb-4"/>
            @else
                <div class="w-20 h-20 bg-[#2E7D32] rounded-2xl border-4 border-[#111827]
                            shadow-[6px_6px_0_#111827] flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-black text-4xl">T</span>
                </div>
            @endif
            <h1 class="text-2xl font-black text-white">Smart Village Talang Marap</h1>
            <p class="text-slate-400 text-sm mt-1">Panel Login</p>
        </div>

        {{-- ── Login card ── --}}
        <div class="border-4 border-[#111827] rounded-2xl shadow-[8px_8px_0_#111827] bg-[#111827] p-8 text-slate-100">

            <h2 class="text-xl font-black mb-6 text-center">🔐 Login Panel</h2>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-950/70 border-2 border-red-500 rounded-xl text-red-200 text-sm font-semibold">
                    ❌ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block font-bold text-sm mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="admin@desatalangmarap.id"
                        class="w-full px-4 py-3 border-[3px] border-[#374151] rounded-xl bg-[#1f2937]
                               outline-none focus:border-[#2E7D32] text-sm text-slate-100 placeholder:text-slate-400"/>
                </div>

                <div>
                    <label class="block font-bold text-sm mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border-[3px] border-[#374151] rounded-xl bg-[#1f2937]
                               outline-none focus:border-[#2E7D32] text-sm text-slate-100 placeholder:text-slate-400"/>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-[#2E7D32]"/>
                    <label for="remember" class="text-sm font-medium cursor-pointer text-slate-300">Ingat saya</label>
                </div>

                <button
                    type="submit"
                    class="w-full brutal-btn bg-[#2E7D32] text-white py-3 rounded-xl font-black text-base">
                    Masuk ke Panel Login →
                </button>
            </form>

        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-[#2E7D32] font-semibold">
                ← Kembali ke Website
            </a>
        </div>

    </div>
</body>
</html>
