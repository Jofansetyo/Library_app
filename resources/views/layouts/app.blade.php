<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan Digital') - Sistem Manajemen Perpustakaan</title>

    <!-- Google Fonts: Lexend (Heading) & Plus Jakarta Sans (Body/Data) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #F8FAFC;
            color: #0F172A;
        }
        h1, h2, h3, h4, .font-heading {
            font-family: 'Lexend', system-ui, -apple-system, sans-serif;
            letter-spacing: -0.02em;
        }
    </style>
</head>
<body class="h-full text-slate-900 antialiased flex flex-col md:flex-row bg-slate-50">

    <!-- Mobile Header -->
    <div class="md:hidden bg-blue-900 text-white px-4 py-3 flex items-center justify-between border-b border-blue-800 sticky top-0 z-40">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-white text-blue-900 flex items-center justify-center font-bold shadow-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <span class="font-heading font-semibold tracking-tight text-base text-white">PerpusApp</span>
        </a>
        <button id="mobileMenuBtn" type="button" class="p-2 rounded-lg text-blue-200 hover:text-white hover:bg-blue-800 focus:outline-hidden focus:ring-2 focus:ring-blue-400 cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Navigation (Deep Indigo #1E3A8A) -->
    <aside id="sidebar" class="hidden md:flex flex-col w-64 bg-blue-900 border-r border-blue-800 shrink-0 min-h-screen text-blue-100 transition-all duration-300 z-30">
        <!-- Brand Logo -->
        <div class="h-16 px-6 flex items-center gap-3 border-b border-blue-800/80">
            <div class="w-9 h-9 rounded-xl bg-white text-blue-900 flex items-center justify-center shadow-xs ring-2 ring-white/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <span class="font-heading font-bold text-white text-base tracking-tight block">PerpusApp</span>
                <span class="text-[11px] text-blue-300 font-medium block">Sistem Perpustakaan</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-3 py-6 space-y-1">
            <p class="px-3 pb-2 text-[11px] font-semibold text-blue-300 uppercase tracking-wider">Menu Utama</p>

            <!-- Nav: Data Buku -->
            <a href="{{ route('books.index') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('books.*') ? 'bg-blue-600 text-white shadow-xs font-semibold' : 'text-blue-100 hover:text-white hover:bg-blue-800/60' }} cursor-pointer">
                <svg class="w-5 h-5 {{ request()->routeIs('books.*') ? 'text-white' : 'text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span>Katalog Buku</span>
            </a>

            <!-- Nav: Data Peminjam -->
            <a href="{{ route('borrowers.index') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('borrowers.*') ? 'bg-blue-600 text-white shadow-xs font-semibold' : 'text-blue-100 hover:text-white hover:bg-blue-800/60' }} cursor-pointer">
                <svg class="w-5 h-5 {{ request()->routeIs('borrowers.*') ? 'text-white' : 'text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Anggota / Peminjam</span>
            </a>

            <!-- Nav: Transaksi Peminjaman -->
            <a href="{{ route('borrowings.index') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('borrowings.*') ? 'bg-blue-600 text-white shadow-xs font-semibold' : 'text-blue-100 hover:text-white hover:bg-blue-800/60' }} cursor-pointer">
                <svg class="w-5 h-5 {{ request()->routeIs('borrowings.*') ? 'text-white' : 'text-blue-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Peminjaman Buku</span>
            </a>
        </nav>

        <!-- User / Admin Profile Card at Bottom of Sidebar -->
        <div class="p-4 border-t border-blue-800/80">
            <div class="flex items-center gap-3 p-2.5 rounded-xl bg-blue-950/50 border border-blue-800/50">
                <div class="w-9 h-9 rounded-full bg-blue-800 text-white flex items-center justify-center font-bold text-xs border border-blue-700">
                    AD
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-semibold text-white truncate">Pustakawan</p>
                    <p class="text-[11px] text-blue-300 truncate">Petugas Aktif</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-h-screen min-w-0 overflow-y-auto">
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-slate-200 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            <div class="flex items-center gap-3">
                <h1 class="text-lg font-heading font-bold text-slate-900">
                    @yield('header_title', 'Perpustakaan')
                </h1>
            </div>

            <div class="flex items-center gap-3 text-xs text-slate-500">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 ring-1 ring-emerald-500/10 font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Sistem Aktif
                </span>
            </div>
        </header>

        <!-- Flash Message Notification -->
        @if (session('success'))
            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 ring-1 ring-emerald-500/10 text-emerald-800 flex items-center gap-3 shadow-xs">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl bg-rose-50 border border-rose-200 ring-1 ring-rose-500/10 text-rose-800 shadow-xs">
                <div class="flex items-center gap-2 mb-1 font-semibold text-sm">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Terjadi kesalahan validasi:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-0.5 text-rose-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Content -->
        <main class="flex-1 p-6 sm:p-8 max-w-7xl w-full mx-auto">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-6 sm:px-8 border-t border-slate-200 text-xs text-slate-500 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between gap-2 bg-white">
            <p>&copy; {{ date('Y') }} Sistem Perpustakaan. Dirancang dengan standar UI/UX Pro Max.</p>
            <p class="text-slate-400">Laravel 13 & Tailwind CSS</p>
        </footer>
    </div>

    <!-- Mobile Drawer Toggle Script -->
    <script>
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-h-screen min-w-0 overflow-y-auto">
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-slate-200/80 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            <div class="flex items-center gap-3">
                <h1 class="text-lg font-heading font-bold text-slate-900">
                    @yield('header_title', 'Perpustakaan')
                </h1>
            </div>

            <div class="flex items-center gap-3 text-xs text-slate-500">
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 font-medium border border-slate-200/60">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Sistem Siap Digunakan
                </span>
            </div>
        </header>

        <!-- Flash Message Notification -->
        @if (session('success'))
            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-xs">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 shadow-xs">
                <div class="flex items-center gap-2 mb-1 font-semibold text-sm">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Terjadi kesalahan validasi:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-0.5 text-rose-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Content -->
        <main class="flex-1 p-6 sm:p-8 max-w-7xl w-full mx-auto">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-6 sm:px-8 border-t border-slate-200 text-xs text-slate-500 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between gap-2 bg-white">
            <p>&copy; {{ date('Y') }} Sistem Perpustakaan. Dirancang dengan standar UI/UX Pro Max.</p>
            <p class="text-slate-400">Laravel 13 & Tailwind CSS</p>
        </footer>
    </div>

    <!-- Mobile Drawer Toggle Script -->
    <script>
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
