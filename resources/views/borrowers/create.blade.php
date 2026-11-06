@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
    <p class="eyebrow">Kenalan dengan pembaca</p>
    <h1>Tambahkan anggota</h1>
    <p class="page-intro">Simpan informasi anggota perpustakaan.</p>

    <form class="form-card" action="{{ route('borrowers.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="field">
                <label for="name">Nama lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="field">
                <label for="email">Alamat email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <label for="phone">Nomor telepon</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
            </div>
            <div class="form-actions">
                <button class="button button-primary" type="submit">Simpan anggota</button>
                <a class="button button-secondary" href="{{ route('borrowers.index') }}">Batal</a>
            </div>
        </div>
    </form>
@endsection
