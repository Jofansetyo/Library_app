@extends('layouts.app')

@section('title', 'Ubah Buku')

@section('content')
    <p class="eyebrow">Perbarui rak bacaan</p>
    <h1>Ubah detail buku</h1>
    <p class="page-intro">Perbarui informasi buku di koleksimu.</p>

    <form class="form-card" action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-grid">
            <div class="field">
                <label for="title">Judul buku</label>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>
            </div>
            <div class="field">
                <label for="author">Penulis</label>
                <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
            </div>
            <div class="field">
                <label for="year">Tahun terbit</label>
                <input type="number" id="year" name="year" value="{{ old('year', $book->year) }}" required>
            </div>
            <div class="form-actions">
                <button class="button button-primary" type="submit">Simpan perubahan</button>
                <a class="button button-secondary" href="{{ route('books.index') }}">Batal</a>
            </div>
        </div>
    </form>
@endsection
