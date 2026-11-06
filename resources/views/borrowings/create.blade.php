@extends('layouts.app')

@section('title', 'Catat Peminjaman')

@section('content')
    <p class="eyebrow">Satu cerita memulai perjalanan</p>
    <h1>Catat peminjaman</h1>
    <p class="page-intro">Pilih anggota dan buku yang akan dipinjam.</p>

    <form class="form-card" action="{{ route('borrowings.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="field">
                <label for="borrower_id">Anggota</label>
                <select id="borrower_id" name="borrower_id" required>
                    <option value="">Pilih anggota</option>
                    @foreach ($borrowers as $borrower)
                        <option value="{{ $borrower->id }}" {{ old('borrower_id') == $borrower->id ? 'selected' : '' }}>{{ $borrower->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="book_id">Buku</label>
                <select id="book_id" name="book_id" required>
                    <option value="">Pilih buku</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="borrow_date">Tanggal pinjam</label>
                <input type="date" id="borrow_date" name="borrow_date" value="{{ old('borrow_date') }}" required>
            </div>
            <div class="field">
                <label for="return_date">Tanggal kembali (opsional)</label>
                <input type="date" id="return_date" name="return_date" value="{{ old('return_date') }}">
            </div>
            <div class="form-actions">
                <button class="button button-primary" type="submit">Simpan peminjaman</button>
                <a class="button button-secondary" href="{{ route('borrowings.index') }}">Batal</a>
            </div>
        </div>
    </form>
@endsection
