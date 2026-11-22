<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Publik | Perpustakaan Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet"><script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#0a0a0e] font-['Plus_Jakarta_Sans'] text-slate-100">
    <header class="border-b border-white/10 bg-[#0a0a0e]/85 px-6 py-5 backdrop-blur-xl"><div class="mx-auto flex max-w-7xl items-center justify-between"><a href="{{ route('landing') }}" class="font-['Syne'] text-xl font-extrabold tracking-wide">PUSTAKA<span class="text-cyan-400">.</span></a><div class="flex items-center gap-3"><a href="{{ route('login') }}" class="rounded-full border border-white/15 px-4 py-2 text-sm font-semibold text-slate-300 transition hover:border-cyan-400 hover:text-white">Masuk Admin</a><a href="{{ route('landing') }}" class="hidden text-sm text-slate-400 transition hover:text-white sm:block">Kembali</a></div></div></header>
    <main class="mx-auto max-w-7xl px-6 py-16 sm:py-24">
        <div class="max-w-3xl"><p class="mb-4 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-300">Katalog terbuka untuk semua</p><h1 class="font-['Syne'] text-5xl font-extrabold leading-[.95] tracking-tight sm:text-7xl">Temukan bacaan yang menggerakkan pikiran.</h1><p class="mt-6 max-w-2xl text-base leading-relaxed text-slate-400 sm:text-lg">Jelajahi koleksi perpustakaan tanpa perlu login. Login hanya diperlukan untuk pengelolaan administrasi dan peminjaman.</p></div>
        <div class="mt-14 flex items-center justify-between border-b border-white/10 pb-4"><h2 class="font-['Syne'] text-2xl font-bold">Koleksi terbaru</h2><span class="text-sm text-slate-500">{{ $books->count() }} judul tersedia</span></div>
        @if ($books->isEmpty())<div class="mt-10 rounded-2xl border border-dashed border-white/15 px-6 py-16 text-center text-slate-500">Belum ada koleksi buku yang dipublikasikan.</div>@else
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">@foreach ($books as $book)<article class="group rounded-2xl border border-white/10 bg-white/[0.04] p-6 transition duration-300 hover:-translate-y-1 hover:border-cyan-400/40 hover:bg-white/[0.07]"><div class="mb-10 flex items-start justify-between"><span class="rounded-full border border-amber-400/20 bg-amber-400/10 px-3 py-1 text-xs font-semibold text-amber-300">{{ $book->location ?: 'Koleksi umum' }}</span><span class="font-mono text-xs text-slate-500">{{ $book->year }}</span></div><h3 class="font-['Syne'] text-2xl font-bold leading-tight text-white">{{ $book->title }}</h3><p class="mt-3 text-sm text-slate-400">Oleh {{ $book->author }}</p>@if ($book->isbn)<p class="mt-6 font-mono text-xs text-slate-600">ISBN {{ $book->isbn }}</p>@endif</article>@endforeach</div>@endif
    </main>
</body></html>
