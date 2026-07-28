<!DOCTYPE html>
<html lang="id" id="htmlRoot">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Smart Village Talang Marap')</title>
    <meta name="description" content="@yield('description', 'Smart Village Talang Marap - Portal resmi Desa Talang Marap - Kec. Kelam Tengah, Kab. Kaur, Bengkulu')"/>
    <meta name="theme-color" content="#2E7D32"/>

    {{-- Tailwind CDN + config --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary:   '#2E7D32',
                        secondary: '#43A047',
                        accent:    '#66BB6A',
                        cream:     '#FFFDF7',
                        dark:      '#212121',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    {{-- Apply dark mode BEFORE first paint to prevent flash --}}
    <script>
        (function () {
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>

    {{-- Global stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=20260627"/>

    {{-- Per-page styles --}}
    @stack('styles')
</head>
<body class="min-h-screen bg-[#FFFDF7] text-[#212121] transition-colors duration-300 dark:bg-[#121212] dark:text-gray-100">

    {{-- ── Navbar ── --}}
    @include('layouts.partials.navbar')

    {{-- ── Page content ── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── Footer ── --}}
    @include('layouts.partials.footer')

    {{-- Global JS (dark mode + language) --}}
    <script src="{{ asset('js/app.js') }}?v=20260627"></script>

    {{-- Per-page scripts --}}
    @stack('scripts')

</body>
</html>
