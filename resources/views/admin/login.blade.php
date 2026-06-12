<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Admin - Portal Desa Talang Marap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .brutal-btn { border: 3px solid #212121; box-shadow: 4px 4px 0 #212121; font-weight: 700; transition: all .15s; cursor: pointer; }
        .brutal-btn:hover { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 #212121; }
    </style>
</head>
<body class="min-h-screen bg-[#FFFDF7] flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-[#2E7D32] rounded-2xl border-4 border-[#212121] shadow-[6px_6px_0_#212121] flex items-center justify-center mx-auto mb-4">
                <span class="text-white font-black text-4xl">T</span>
            </div>
            <h1 class="text-2xl font-black text-[#212121]">Portal Desa Talang Marap</h1>
            <p class="text-gray-500 text-sm mt-1">Panel Administrasi</p>
        </div>

        <!-- Card -->
        <div class="border-4 border-[#212121] rounded-2xl shadow-[8px_8px_0_#212121] bg-white p-8">
            <h2 class="text-xl font-black mb-6 text-center">🔐 Login Admin</h2>

            @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 border-2 border-red-400 rounded-xl text-red-700 text-sm font-semibold">
                ❌ {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block font-bold text-sm mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="admin@desatalangmarap.id"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] text-sm"/>
                </div>
                <div>
                    <label class="block font-bold text-sm mb-2">Password</label>
                    <input type="password" name="password" required placeholder="••••••••"
                           class="w-full px-4 py-3 border-[3px] border-[#212121] rounded-xl outline-none focus:border-[#2E7D32] text-sm"/>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4"/>
                    <label for="remember" class="text-sm font-medium cursor-pointer">Ingat saya</label>
                </div>
                <button type="submit" class="w-full brutal-btn bg-[#2E7D32] text-white py-3 rounded-xl font-black text-base">
                    Masuk ke Panel Admin →
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-[#2E7D32] font-semibold">
                ← Kembali ke Website
            </a>
        </div>
    </div>
</body>
</html>
