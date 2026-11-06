@extends('layouts.app')

@section('title', 'Koleksi Buku')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Rak buku</p>
            <h1>Koleksi buku</h1>
            <p class="page-intro">Semua cerita yang tersimpan di perpustakaanmu.</p>
        </div>
        <a class="button button-primary" href="{{ route('books.create') }}">+ Tambah buku</a>
    </div>

    <div class="table-card">
        <div class="table-scroll">
            <table>
                <thead>
                    <tr><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->year }}</td>
                            <td>
                                <div class="actions">
                                    <a class="text-link" href="{{ route('books.edit', $book->id) }}">Ubah</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-button" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Belum ada buku di koleksi. Tambahkan buku pertama untuk memulai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
