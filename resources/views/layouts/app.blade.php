<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ruang Baca') · Ruang Baca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            --ink: #20342d;
            --muted: #75827a;
            --paper: #f7f6f0;
            --white: #fffefa;
            --green: #214f3c;
            --green-dark: #183c2d;
            --lime: #d7ed9f;
            --line: #e6e8df;
            --gold: #d7a956;
            font-family: "DM Sans", sans-serif;
            color: var(--ink);
            background: var(--paper);
        }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; background: var(--paper); }
        a { color: inherit; text-decoration: none; }
        button, input, select { font: inherit; }
        .site-header { position: sticky; top: 0; z-index: 5; border-bottom: 1px solid rgba(32, 52, 45, .08); background: rgba(255, 254, 250, .92); backdrop-filter: blur(16px); }
        .nav-wrap { width: min(1120px, calc(100% - 48px)); min-height: 76px; margin: auto; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: flex; align-items: center; gap: 11px; font-weight: 700; letter-spacing: -.04em; font-size: 19px; }
        .brand-mark { width: 36px; height: 36px; display: grid; place-items: center; border-radius: 12px; color: var(--lime); background: var(--green); font-size: 18px; }
        .nav-links { display: flex; align-items: center; gap: 7px; }
        .nav-link { padding: 10px 14px; border-radius: 999px; color: #647168; font-size: 13px; font-weight: 600; transition: .2s ease; }
        .nav-link:hover, .nav-link.active { color: var(--green); background: #edf2e8; }
        .nav-cta { padding: 11px 17px; border-radius: 999px; color: white; background: var(--green); font-size: 13px; font-weight: 700; transition: .2s ease; }
        .nav-cta:hover, .button-primary:hover { background: var(--green-dark); transform: translateY(-1px); }
        .page-wrap { width: min(1120px, calc(100% - 48px)); margin: 0 auto; padding: 52px 0 76px; min-height: calc(100vh - 150px); }
        .eyebrow { margin: 0 0 12px; color: #7d8d69; font-size: 11px; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; }
        h1, h2, h3, p { margin-top: 0; }
        h1, .serif { font-family: "Playfair Display", Georgia, serif; }
        h1 { margin-bottom: 10px; font-size: clamp(32px, 5vw, 46px); letter-spacing: -.045em; line-height: 1.12; }
        .page-intro { margin-bottom: 28px; color: var(--muted); font-size: 15px; }
        .page-heading { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 28px; }
        .button { display: inline-flex; min-height: 44px; align-items: center; justify-content: center; gap: 8px; padding: 0 18px; border: 0; border-radius: 999px; cursor: pointer; font-size: 13px; font-weight: 700; transition: .2s ease; }
        .button-primary { color: white; background: var(--green); }
        .button-secondary { color: var(--green); background: #edf2e8; }
        .button-secondary:hover { background: #e1ead9; }
        .table-card, .form-card { overflow: hidden; border: 1px solid var(--line); border-radius: 20px; background: var(--white); box-shadow: 0 10px 32px rgba(32, 52, 45, .04); }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 16px 21px; color: #879188; background: #fafbf7; font-size: 10px; font-weight: 700; letter-spacing: .11em; text-transform: uppercase; white-space: nowrap; }
        td { padding: 18px 21px; border-top: 1px solid #eef0e9; color: #59675e; font-size: 13px; }
        td:first-child { color: var(--ink); font-weight: 700; }
        tbody tr { transition: background .2s ease; }
        tbody tr:hover { background: #fbfcf8; }
        .actions { display: flex; align-items: center; gap: 13px; white-space: nowrap; }
        .text-link { color: var(--green); font-size: 12px; font-weight: 700; }
        .text-link:hover { text-decoration: underline; }
        .delete-button { padding: 0; border: 0; color: #b25d4a; background: none; cursor: pointer; font-size: 12px; font-weight: 700; }
        .delete-button:hover { text-decoration: underline; }
        .form-card { max-width: 650px; padding: 30px; }
        .form-grid { display: grid; gap: 20px; }
        .field { display: grid; gap: 8px; }
        .field label { color: #526157; font-size: 12px; font-weight: 700; }
        .field input, .field select { width: 100%; height: 48px; padding: 0 14px; border: 1px solid #e1e5db; border-radius: 11px; outline: none; color: var(--ink); background: #fff; transition: border-color .2s, box-shadow .2s; }
        .field input:focus, .field select:focus { border-color: #80a587; box-shadow: 0 0 0 4px rgba(81, 127, 91, .1); }
        .form-actions { display: flex; gap: 10px; margin-top: 8px; }
        .error-list { margin: 0 0 22px; padding: 15px 20px; border: 1px solid #f1c9bd; border-radius: 12px; color: #994d3c; background: #fff5f1; font-size: 13px; }
        .site-footer { padding: 22px 24px; border-top: 1px solid rgba(32, 52, 45, .08); color: #849087; text-align: center; font-size: 11px; }
        .hero { position: relative; display: grid; min-height: 420px; grid-template-columns: 1.05fr .95fr; align-items: center; gap: 36px; overflow: hidden; padding: clamp(28px, 6vw, 66px); border-radius: 28px; color: white; background: var(--green); }
        .hero:before { position: absolute; top: -170px; right: -120px; width: 470px; height: 470px; border: 1px solid rgba(255,255,255,.1); border-radius: 50%; content: ""; }
        .hero-copy { position: relative; z-index: 1; }
        .hero .eyebrow { color: var(--lime); }
        .hero h1 { max-width: 570px; margin-bottom: 18px; font-size: clamp(40px, 6vw, 66px); }
        .hero h1 span { color: var(--lime); }
        .hero-copy > p:not(.eyebrow) { max-width: 440px; margin-bottom: 26px; color: rgba(255,255,255,.72); font-size: 15px; line-height: 1.8; }
        .hero .button-primary { color: var(--green-dark); background: var(--lime); }
        .hero .button-primary:hover { background: #e5f6be; }
        .hero-art { position: relative; display: grid; min-height: 290px; place-items: center; }
        .art-orbit { position: absolute; width: 280px; height: 280px; border: 1px solid rgba(215,237,159,.28); border-radius: 50%; }
        .art-orbit:before, .art-orbit:after { position: absolute; border: 1px solid rgba(215,237,159,.18); border-radius: 50%; content: ""; }
        .art-orbit:before { inset: 20px; }
        .art-orbit:after { inset: 42px; }
        .book-stack { position: relative; width: 245px; height: 205px; transform: rotate(-7deg); }
        .book { position: absolute; width: 175px; height: 48px; border: 1px solid rgba(255,255,255,.15); border-radius: 6px 12px 12px 6px; box-shadow: 0 15px 26px rgba(8,28,20,.22); }
        .book:after { position: absolute; top: 10px; bottom: 10px; left: 16px; width: 2px; background: rgba(255,255,255,.35); content: ""; }
        .book-one { right: 12px; bottom: 23px; background: #d5a657; transform: rotate(7deg); }
        .book-two { bottom: 72px; left: 2px; background: #8caa75; transform: rotate(-6deg); }
        .book-three { top: 18px; right: 0; background: #d78360; transform: rotate(8deg); }
        .sun { position: absolute; top: 12px; right: 24px; width: 31px; height: 31px; border-radius: 50%; background: var(--lime); box-shadow: 0 0 42px rgba(215,237,159,.35); }
        .spark { position: absolute; color: var(--lime); font-size: 25px; }
        .spark-a { top: 48px; left: 7px; }
        .spark-b { right: 10px; bottom: 35px; font-size: 16px; }
        .section-head { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin: 54px 0 20px; }
        .section-head h2 { margin: 0; font-family: "Playfair Display", Georgia, serif; font-size: 27px; letter-spacing: -.03em; }
        .section-head p { margin: 6px 0 0; color: var(--muted); font-size: 13px; }
        .collection-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .collection-card { display: flex; min-height: 170px; flex-direction: column; justify-content: space-between; padding: 23px; border: 1px solid var(--line); border-radius: 18px; background: var(--white); transition: transform .2s, box-shadow .2s; }
        .collection-card:hover { transform: translateY(-4px); box-shadow: 0 15px 32px rgba(32, 52, 45, .08); }
        .collection-icon { display: grid; width: 40px; height: 40px; place-items: center; border-radius: 13px; color: var(--green); background: #edf2e8; font-size: 19px; }
        .collection-card h3 { margin: 17px 0 5px; font-family: "Playfair Display", Georgia, serif; font-size: 19px; }
        .collection-card p { margin: 0; color: var(--muted); font-size: 12px; }
        .collection-arrow { align-self: end; color: var(--green); font-size: 20px; }
        .note-band { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-top: 18px; padding: 21px 24px; border-radius: 16px; background: #ecefdf; }
        .note-band strong { font-family: "Playfair Display", Georgia, serif; font-size: 18px; }
        .note-band span { color: #657365; font-size: 12px; }
        @media (max-width: 720px) {
            .nav-wrap, .page-wrap { width: min(100% - 32px, 560px); }
            .nav-wrap { min-height: 68px; gap: 8px; }
            .nav-links { gap: 0; }
            .nav-link { padding: 9px 10px; font-size: 11px; }
            .nav-cta { display: none; }
            .page-wrap { padding-top: 36px; }
            .hero { grid-template-columns: 1fr; gap: 6px; padding: 34px 26px 18px; }
            .hero-art { min-height: 220px; }
            .art-orbit { width: 220px; height: 220px; }
            .book-stack { transform: scale(.85) rotate(-7deg); }
            .collection-grid { grid-template-columns: 1fr; }
            .collection-card { min-height: 145px; }
            .page-heading { align-items: start; flex-direction: column; }
            .form-card { padding: 22px; }
            th, td { padding: 15px; }
            .section-head { margin-top: 40px; }
        }
        @media (max-width: 390px) { .brand { font-size: 16px; } .nav-link { padding-inline: 7px; font-size: 10px; } }
    </style>
</head>
<body>
    <header class="site-header">
        <nav class="nav-wrap" aria-label="Navigasi utama">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark" aria-hidden="true">⌑</span>
                <span>ruang baca</span>
            </a>
            <div class="nav-links">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">Koleksi</a>
                <a class="nav-link {{ request()->routeIs('borrowers.*') ? 'active' : '' }}" href="{{ route('borrowers.index') }}">Anggota</a>
                <a class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}" href="{{ route('borrowings.index') }}">Peminjaman</a>
            </div>
            <a class="nav-cta" href="{{ route('books.create') }}">+ Tambah buku</a>
        </nav>
    </header>
    <main class="page-wrap">
        @if ($errors->any())
            <div class="error-list" role="alert">
                <strong>Periksa kembali data yang diisi:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
    <footer class="site-footer">Dibuat untuk cerita-cerita yang belum selesai dibaca. <span aria-hidden="true">✦</span></footer>
</body>
</html>
