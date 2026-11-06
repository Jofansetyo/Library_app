@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <p class="eyebrow">Perbarui rak bacaan</p>
    <h1>Tambahkan buku</h1>
    <p class="page-intro">Catat cerita baru agar mudah ditemukan nanti.</p>

    <form class="form-card" action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="field">
                <label for="title">Judul buku</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="field">
                <label for="author">Penulis</label>
                <input type="text" id="author" name="author" value="{{ old('author') }}" required>
            </div>
            <div class="field">
                <label for="year">Tahun terbit</label>
                <input type="number" id="year" name="year" value="{{ old('year') }}" required>
            </div>
            <div class="form-actions">
                <button class="button button-primary" type="submit">Simpan buku</button>
                <a class="button button-secondary" href="{{ route('books.index') }}">Batal</a>
            </div>
        </div>
    </form>
@endsection
