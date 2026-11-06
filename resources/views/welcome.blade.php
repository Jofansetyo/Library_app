@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">Perpustakaan kecil, kemungkinan tanpa batas</p>
            <h1>Temukan cerita yang <span>memanggilmu.</span></h1>
            <p>Tempat yang nyaman untuk merawat koleksi buku, mengenal para pembaca, dan memastikan setiap cerita menemukan jalannya pulang.</p>
            <a class="button button-primary" href="{{ route('books.index') }}">Jelajahi koleksi <span aria-hidden="true">→</span></a>
        </div>
        <div class="hero-art" aria-hidden="true">
            <div class="art-orbit"></div>
            <span class="sun"></span>
            <span class="spark spark-a">✳</span>
            <span class="spark spark-b">✦</span>
            <div class="book-stack">
                <span class="book book-one"></span>
                <span class="book book-two"></span>
                <span class="book book-three"></span>
            </div>
        </div>
    </section>

    <section class="section-head">
        <div>
            <p class="eyebrow">Semua tertata, tinggal dinikmati</p>
            <h2>Ruang untuk setiap cerita</h2>
            <p>Kelola perpustakaanmu dengan cara yang sederhana.</p>
        </div>
    </section>

    <section class="collection-grid" aria-label="Menu perpustakaan">
        <a class="collection-card" href="{{ route('books.index') }}">
            <span class="collection-icon" aria-hidden="true">▤</span>
            <div>
                <h3>Koleksi buku</h3>
                <p>Jelajahi dan rawat daftar bacaan.</p>
            </div>
            <span class="collection-arrow" aria-hidden="true">↗</span>
        </a>
        <a class="collection-card" href="{{ route('borrowers.index') }}">
            <span class="collection-icon" aria-hidden="true">♧</span>
            <div>
                <h3>Para pembaca</h3>
                <p>Kenali komunitas di balik setiap buku.</p>
            </div>
            <span class="collection-arrow" aria-hidden="true">↗</span>
        </a>
        <a class="collection-card" href="{{ route('borrowings.index') }}">
            <span class="collection-icon" aria-hidden="true">↗</span>
            <div>
                <h3>Peminjaman</h3>
                <p>Pantau buku yang sedang bertualang.</p>
            </div>
            <span class="collection-arrow" aria-hidden="true">↗</span>
        </a>
    </section>

    <aside class="note-band">
        <strong>Setiap buku punya tempatnya.</strong>
        <span>Mulai dengan menambahkan satu cerita baru ke koleksimu.</span>
    </aside>
@endsection
