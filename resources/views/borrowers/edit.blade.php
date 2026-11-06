@extends('layouts.app')

@section('title', 'Ubah Anggota')

@section('content')
    <p class="eyebrow">Kenalan dengan pembaca</p>
    <h1>Ubah detail anggota</h1>
    <p class="page-intro">Perbarui informasi anggota perpustakaan.</p>

    <form class="form-card" action="{{ route('borrowers.update', $borrower->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-grid">
            <div class="field">
                <label for="name">Nama lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $borrower->name) }}" required>
            </div>
            <div class="field">
                <label for="email">Alamat email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $borrower->email) }}" required>
            </div>
            <div class="field">
                <label for="phone">Nomor telepon</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $borrower->phone) }}" required>
            </div>
            <div class="form-actions">
                <button class="button button-primary" type="submit">Simpan perubahan</button>
                <a class="button button-secondary" href="{{ route('borrowers.index') }}">Batal</a>
            </div>
        </div>
    </form>
@endsection
