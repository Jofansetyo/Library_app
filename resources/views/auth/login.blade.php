<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Perpustakaan Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#0a0a0e] font-['Plus_Jakarta_Sans'] text-slate-100">
    <main class="relative flex min-h-screen items-center justify-center px-6 py-12">
        <div class="pointer-events-none absolute -left-32 top-[-10rem] h-[28rem] w-[28rem] rounded-full bg-blue-700/25 blur-[120px]"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-24 h-[30rem] w-[30rem] rounded-full bg-amber-500/20 blur-[130px]"></div>
        <div class="relative grid w-full max-w-5xl overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.04] shadow-2xl shadow-black/40 backdrop-blur-xl lg:grid-cols-[1.05fr_.95fr]">
            <section class="hidden flex-col justify-between border-r border-white/10 p-10 lg:flex xl:p-14">
                <a href="{{ route('landing') }}" class="font-['Syne'] text-xl font-extrabold tracking-wide">PUSTAKA<span class="text-cyan-400">.</span></a>
                <div>
                    <p class="mb-5 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-300">Ruang baca digital</p>
                    <h1 class="font-['Syne'] text-5xl font-extrabold leading-[.95] tracking-tight xl:text-6xl">Buka pintu menuju ide berikutnya.</h1>
                    <p class="mt-6 max-w-md leading-relaxed text-slate-400">Kelola koleksi, temukan bacaan, dan pantau aktivitas perpustakaan dari satu ruang yang tenang.</p>
                </div>
                <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Baca. Temukan. Tumbuh.</p>
            </section>
            <section class="p-7 sm:p-10 xl:p-14">
                <div class="mb-10 lg:hidden"><a href="{{ route('landing') }}" class="font-['Syne'] text-xl font-extrabold tracking-wide">PUSTAKA<span class="text-cyan-400">.</span></a></div>
                <div class="mb-8"><p class="mb-3 text-xs font-semibold uppercase tracking-[0.25em] text-amber-400">Selamat datang kembali</p><h2 class="font-['Syne'] text-3xl font-extrabold tracking-tight sm:text-4xl">Masuk ke perpustakaan</h2><p class="mt-3 text-sm leading-relaxed text-slate-400">Gunakan akun Anda untuk melanjutkan perjalanan membaca.</p></div>
                @if ($errors->any())<div class="mb-6 rounded-xl border border-rose-400/30 bg-rose-400/10 px-4 py-3 text-sm text-rose-200" role="alert">{{ $errors->first() }}</div>@endif
                <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                    @csrf
                    <div><label for="email" class="mb-2 block text-sm font-semibold text-slate-200">Email</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus placeholder="nama@contoh.com" class="w-full rounded-xl border border-white/15 bg-black/20 px-4 py-3 text-sm text-white outline-none transition focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10"></div>
                    <div><label for="password" class="mb-2 block text-sm font-semibold text-slate-200">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Masukkan password" class="w-full rounded-xl border border-white/15 bg-black/20 px-4 py-3 text-sm text-white outline-none transition focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10"></div>
                    <label class="flex cursor-pointer items-center gap-2 text-sm text-slate-400"><input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-white/20 bg-black/20 text-cyan-400 focus:ring-cyan-400"> Ingat saya</label>
                    <button type="submit" class="group flex w-full cursor-pointer items-center justify-center gap-3 rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-400/30">Masuk sekarang <span class="transition-transform group-hover:translate-x-1">→</span></button>
                </form>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-slate-500"><span>Belum punya akun?</span><a href="{{ route('register') }}" class="font-semibold text-cyan-300 transition hover:text-white">Buat akun</a></div>
                <a href="{{ route('landing') }}" class="mt-3 block text-center text-sm text-slate-500 transition hover:text-white">Kembali ke halaman utama</a>
            </section>
        </div>
    </main>
</body>
</html>
