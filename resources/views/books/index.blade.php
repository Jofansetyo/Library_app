@extends('layouts.app')

@section('title', 'Katalog Buku')
@section('header_title', 'Katalog & Koleksi Buku')

@section('content')
<div class="space-y-6">

    <!-- Header & Quick Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Koleksi Buku</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data buku, nomor ISBN, pengarang, dan lokasi rak arsip.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('books.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-150 cursor-pointer focus:outline-hidden focus:ring-4 focus:ring-blue-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Buku Baru</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Koleksi</p>
                <p class="text-2xl font-heading font-bold text-slate-900 mt-1">{{ count($books) }}</p>
                <p class="text-xs text-slate-400 mt-1">Judul terdaftar</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tahun Terlama</p>
                <p class="text-2xl font-heading font-bold text-slate-900 mt-1">
                    {{ count($books) > 0 ? $books->min('year') ?? '-' : '-' }}
                </p>
                <p class="text-xs text-slate-400 mt-1">Koleksi arsip</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tahun Terbaru</p>
                <p class="text-2xl font-heading font-bold text-slate-900 mt-1">
                    {{ count($books) > 0 ? $books->max('year') ?? '-' : '-' }}
                </p>
                <p class="text-xs text-emerald-600 font-medium mt-1">Edisi termutakhir</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Table Container Card -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xs">
        <!-- Search & Filter Bar -->
        <div class="p-4 sm:p-5 border-b border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 bg-slate-50/50">
            <div class="relative w-full sm:w-80">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text"
                       id="bookSearchInput"
                       placeholder="Cari judul, pengarang, ISBN..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all text-sm">
            </div>

            <span class="text-xs text-slate-500 font-medium self-end sm:self-center">
                Menampilkan <strong class="text-slate-900 font-semibold" id="bookCount">{{ count($books) }}</strong> buku
            </span>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="booksTable">
                <thead class="bg-slate-50/75 text-xs font-semibold uppercase text-slate-500 tracking-wider py-3.5 px-6 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="py-3.5 px-6">Informasi Buku</th>
                        <th scope="col" class="py-3.5 px-6">Tahun</th>
                        <th scope="col" class="py-3.5 px-6">ISBN</th>
                        <th scope="col" class="py-3.5 px-6">Lokasi Rak</th>
                        <th scope="col" class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($books as $book)
                    <tr class="hover:bg-slate-50/60 transition-colors duration-150 border-b border-slate-100 last:border-none book-row">
                        <!-- Judul & Pengarang -->
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 text-blue-700 flex items-center justify-center shrink-0 shadow-xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 leading-snug book-title">{{ $book->title }}</h4>
                                    <p class="text-xs text-slate-500 mt-0.5 book-author">Oleh {{ $book->author }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Tahun -->
                        <td class="py-4 px-6 text-slate-600 font-medium whitespace-nowrap">
                            {{ $book->year }}
                        </td>

                        <!-- ISBN -->
                        <td class="py-4 px-6 font-mono text-xs text-slate-500 whitespace-nowrap book-isbn">
                            {{ $book->isbn ?: '-' }}
                        </td>

                        <!-- Lokasi Rak -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            @if ($book->location)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-200">
                                    <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $book->location }}
                                </span>
                            @else
                                <span class="text-xs text-slate-400 italic">Belum diatur</span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('books.edit', $book->id) }}"
                                   title="Edit Buku"
                                   class="p-1.5 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($book->title) }}\'?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Hapus Buku"
                                            class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 px-6 text-center text-slate-400">
                            <div class="max-w-xs mx-auto flex flex-col items-center">
                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-slate-600">Belum ada buku terdaftar</p>
                                <p class="text-xs text-slate-400 mt-1">Mulai tambahkan buku pertama Anda ke koleksi perpustakaan.</p>
                                <a href="{{ route('books.create') }}" class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-xs cursor-pointer">
                                    Tambah Buku
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Live Client-side Search for books
    document.getElementById('bookSearchInput')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.book-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const title = row.querySelector('.book-title')?.textContent.toLowerCase() || '';
            const author = row.querySelector('.book-author')?.textContent.toLowerCase() || '';
            const isbn = row.querySelector('.book-isbn')?.textContent.toLowerCase() || '';

            if (title.includes(query) || author.includes(query) || isbn.includes(query)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const countEl = document.getElementById('bookCount');
        if (countEl) countEl.textContent = visibleCount;
    });
</script>
@endpush
