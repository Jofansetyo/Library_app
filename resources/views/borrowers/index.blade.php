@extends('layouts.app')

@section('title', 'Anggota')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Komunitas pembaca</p>
            <h1>Anggota</h1>
            <p class="page-intro">Orang-orang yang membawa cerita pulang.</p>
        </div>
        <a class="button button-primary" href="{{ route('borrowers.create') }}">+ Tambah anggota</a>
    </div>

    <div class="table-card">
        <div class="table-scroll">
            <table>
                <thead>
                    <tr><th>Nama</th><th>Email</th><th>Telepon</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($borrowers as $borrower)
                        <tr>
                            <td>{{ $borrower->name }}</td>
                            <td>{{ $borrower->email }}</td>
                            <td>{{ $borrower->phone }}</td>
                            <td>
                                <div class="actions">
                                    <a class="text-link" href="{{ route('borrowers.edit', $borrower->id) }}">Ubah</a>
                                    <form action="{{ route('borrowers.destroy', $borrower->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-button" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Belum ada anggota yang terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
