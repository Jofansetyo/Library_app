@extends('layouts.app')

@section('title', 'Ubah Peminjaman')

@section('content')
    <p class="eyebrow">Perbarui catatan buku</p>
    <h1>Ubah peminjaman</h1>
    <p class="page-intro">Perbarui detail perjalanan buku ini.</p>

    <form class="form-card" action="{{ route('borrowings.update', $borrowing->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-grid">
            <div class="field">
                <label for="borrower_id">Anggota</label>
                <select id="borrower_id" name="borrower_id" required>
                    @foreach ($borrowers as $borrower)
                        <option value="{{ $borrower->id }}" {{ old('borrower_id', $borrowing->borrower_id) == $borrower->id ? 'selected' : '' }}>{{ $borrower->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="book_id">Buku</label>
                <select id="book_id" name="book_id" required>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="borrow_date">Tanggal pinjam</label>
                <input type="date" id="borrow_date" name="borrow_date" value="{{ old('borrow_date', $borrowing->borrow_date) }}" required>
            </div>
            <div class="field">
                <label for="return_date">Tanggal kembali (opsional)</label>
                <input type="date" id="return_date" name="return_date" value="{{ old('return_date', $borrowing->return_date) }}">
            </div>
            <div class="form-actions">
                <button class="button button-primary" type="submit">Simpan perubahan</button>
                <a class="button button-secondary" href="{{ route('borrowings.index') }}">Batal</a>
            </div>
        </div>
    </form>
@endsection
