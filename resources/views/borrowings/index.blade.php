@extends('layouts.app')

@section('title', 'Daftar Peminjaman')
@section('header_title', 'Sirkulasi & Peminjaman Buku')

@section('content')
<div class="space-y-6">

    <!-- Header & Quick Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Sirkulasi Peminjaman</h2>
            <p class="text-sm text-slate-500 mt-1">Pantau peminjaman aktif, batas waktu pengembalian, dan status denda.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('borrowings.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-150 cursor-pointer focus:outline-hidden focus:ring-4 focus:ring-blue-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Catat Peminjaman Baru</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    @php
        $totalBorrowings = count($borrowings);
        $activeBorrowings = $borrowings->whereNull('actual_return_date')->count();
        $returnedBorrowings = $borrowings->whereNotNull('actual_return_date')->count();
        $overdueBorrowings = $borrowings->filter(function($b) {
            return is_null($b->actual_return_date) && \Carbon\Carbon::parse($b->return_date)->isPast();
        })->count();
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Transaksi</p>
                <p class="text-2xl font-heading font-bold text-slate-900 mt-1">{{ $totalBorrowings }}</p>
                <p class="text-xs text-slate-400 mt-1">Catatan peminjaman</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sedang Dipinjam</p>
                <p class="text-2xl font-heading font-bold text-amber-600 mt-1">{{ $activeBorrowings }}</p>
                <p class="text-xs text-slate-400 mt-1">Buku di tangan pembaca</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Terlambat</p>
                <p class="text-2xl font-heading font-bold text-rose-600 mt-1">{{ $overdueBorrowings }}</p>
                <p class="text-xs text-rose-500 font-medium mt-1">Perlu tindakan denda</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sudah Kembali</p>
                <p class="text-2xl font-heading font-bold text-emerald-600 mt-1">{{ $returnedBorrowings }}</p>
                <p class="text-xs text-emerald-600 font-medium mt-1">Selesai tertib</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Table Container Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <!-- Search & Filter Bar -->
        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 bg-slate-50/50">
            <div class="relative w-full sm:w-80">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text"
                       id="borrowingSearchInput"
                       placeholder="Cari nama peminjam atau judul buku..."
                       class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder:text-slate-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all">
            </div>

            <span class="text-xs text-slate-500 font-medium self-end sm:self-center">
                Menampilkan <strong class="text-slate-900" id="borrowingCount">{{ count($borrowings) }}</strong> transaksi
            </span>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="borrowingsTable">
                <thead class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th scope="col" class="py-3.5 px-6">Peminjam</th>
                        <th scope="col" class="py-3.5 px-6">Buku Dipinjam</th>
                        <th scope="col" class="py-3.5 px-6">Tgl Pinjam</th>
                        <th scope="col" class="py-3.5 px-6">Tenggat Waktu</th>
                        <th scope="col" class="py-3.5 px-6">Status Pengembalian</th>
                        <th scope="col" class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($borrowings as $borrowing)
                    @php
                        $isReturned = !is_null($borrowing->actual_return_date);
                        $isOverdue = !$isReturned && \Carbon\Carbon::parse($borrowing->return_date)->isPast();
                    @endphp
                    <tr class="hover:bg-slate-50/70 transition-colors duration-150 borrowing-row">
                        <!-- Peminjam -->
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-slate-100 border border-slate-200 text-slate-700 flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($borrowing->borrower->name ?? '?', 0, 2)) }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 leading-snug borrower-name">{{ $borrowing->borrower->name ?? '-' }}</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $borrowing->borrower->phone ?? 'Tanpa kontak' }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Buku -->
                        <td class="py-4 px-6">
                            <div class="max-w-xs">
                                <p class="font-medium text-slate-900 line-clamp-1 book-title">{{ $borrowing->book->title ?? '-' }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">Oleh {{ $borrowing->book->author ?? '-' }}</p>
                            </div>
                        </td>

                        <!-- Tgl Pinjam -->
                        <td class="py-4 px-6 text-slate-600 whitespace-nowrap text-xs font-medium">
                            {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                        </td>

                        <!-- Tenggat Waktu -->
                        <td class="py-4 px-6 whitespace-nowrap text-xs font-medium">
                            <span class="{{ $isOverdue ? 'text-rose-600 font-bold' : 'text-slate-600' }}">
                                {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}
                            </span>
                        </td>

                        <!-- Status Pengembalian -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            @if ($isReturned)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Kembali ({{ \Carbon\Carbon::parse($borrowing->actual_return_date)->format('d M') }})
                                </span>
                            @elseif ($isOverdue)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                    Terlambat
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Dipinjam
                                </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('borrowings.edit', $borrowing->id) }}"
                                   title="Ubah Transaksi"
                                   class="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-150 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Hapus Transaksi"
                                            class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors duration-150 cursor-pointer">
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
                        <td colspan="6" class="py-12 px-6 text-center text-slate-400">
                            <div class="max-w-xs mx-auto flex flex-col items-center">
                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-slate-600">Belum ada transaksi peminjaman</p>
                                <p class="text-xs text-slate-400 mt-1">Catat transaksi peminjaman buku pertama oleh anggota perpustakaan.</p>
                                <a href="{{ route('borrowings.create') }}" class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-xs cursor-pointer">
                                    Catat Peminjaman
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
    // Live Client-side Search for borrowings
    document.getElementById('borrowingSearchInput')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.borrowing-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const borrower = row.querySelector('.borrower-name')?.textContent.toLowerCase() || '';
            const book = row.querySelector('.book-title')?.textContent.toLowerCase() || '';

            if (borrower.includes(query) || book.includes(query)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const countEl = document.getElementById('borrowingCount');
        if (countEl) countEl.textContent = visibleCount;
    });
</script>
@endpush