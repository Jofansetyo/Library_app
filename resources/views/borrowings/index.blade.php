@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Perjalanan sebuah buku</p>
            <h1>Peminjaman</h1>
            <p class="page-intro">Lihat buku yang sedang menemani para pembaca.</p>
        </div>
        <a class="button button-primary" href="{{ route('borrowings.create') }}">+ Catat peminjaman</a>
    </div>

    <div class="table-card">
        <div class="table-scroll">
            <table>
                <thead>
                    <tr><th>Peminjam</th><th>Buku</th><th>Tanggal pinjam</th><th>Tanggal kembali</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($borrowings as $borrowing)
                        <tr>
                            <td>{{ $borrowing->borrower->name }}</td>
                            <td>{{ $borrowing->book->title }}</td>
                            <td>{{ $borrowing->borrow_date }}</td>
                            <td>{{ $borrowing->return_date ?? 'Belum kembali' }}</td>
                            <td>
                                <div class="actions">
                                    <a class="text-link" href="{{ route('borrowings.edit', $borrowing->id) }}">Ubah</a>
                                    <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-button" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Belum ada peminjaman yang dicatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
