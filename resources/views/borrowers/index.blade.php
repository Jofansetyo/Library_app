@extends('layouts.app')

@section('title', 'Daftar Anggota / Peminjam')
@section('header_title', 'Manajemen Anggota Perpustakaan')

@section('content')
<div class="space-y-6">

    <!-- Header & Quick Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Data Anggota</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data peminjam buku, nomor kontak, dan alamat anggota perpustakaan.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('borrowers.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-150 cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>Tambah Anggota Baru</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Anggota</p>
                <p class="text-2xl font-heading font-bold text-slate-900 mt-1">{{ count($borrowers) }}</p>
                <p class="text-xs text-slate-400 mt-1">Pengguna terdaftar</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Status Keanggotaan</p>
                <p class="text-2xl font-heading font-bold text-emerald-600 mt-1">Aktif</p>
                <p class="text-xs text-slate-400 mt-1">Siap meminjam buku</p>
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
                       id="borrowerSearchInput"
                       placeholder="Cari nama, kontak, alamat..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all text-sm">
            </div>

            <span class="text-xs text-slate-500 font-medium self-end sm:self-center">
                Menampilkan <strong class="text-slate-900 font-semibold" id="borrowerCount">{{ count($borrowers) }}</strong> anggota
            </span>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="borrowersTable">
                <thead class="bg-slate-50/75 text-xs font-semibold uppercase text-slate-500 tracking-wider py-3.5 px-6 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="py-3.5 px-6">Nama Anggota</th>
                        <th scope="col" class="py-3.5 px-6">Nomor Telepon</th>
                        <th scope="col" class="py-3.5 px-6">Alamat</th>
                        <th scope="col" class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($borrowers as $borrower)
                    <tr class="hover:bg-slate-50/60 transition-colors duration-150 border-b border-slate-100 last:border-none borrower-row">
                        <!-- Nama Anggota -->
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($borrower->name, 0, 2)) }}
                                </div>
                                <span class="font-semibold text-slate-900 borrower-name">{{ $borrower->name }}</span>
                            </div>
                        </td>

                        <!-- Nomor Telepon -->
                        <td class="py-4 px-6 text-slate-600 whitespace-nowrap borrower-phone">
                            @if ($borrower->phone)
                                <span class="inline-flex items-center gap-1.5 text-xs font-mono text-slate-700">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    {{ $borrower->phone }}
                                </span>
                            @else
                                <span class="text-xs text-slate-400 italic">-</span>
                            @endif
                        </td>

                        <!-- Alamat -->
                        <td class="py-4 px-6 text-slate-600 borrower-address">
                            {{ $borrower->address ?: '-' }}
                        </td>

                        <!-- Aksi -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('borrowers.edit', $borrower->id) }}"
                                   title="Edit Anggota"
                                   class="p-1.5 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form action="{{ route('borrowers.destroy', $borrower->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota \'{{ addslashes($borrower->name) }}\'?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Hapus Anggota"
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
                        <td colspan="4" class="py-12 px-6 text-center text-slate-400">
                            <div class="max-w-xs mx-auto flex flex-col items-center">
                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-slate-600">Belum ada anggota terdaftar</p>
                                <p class="text-xs text-slate-400 mt-1">Daftarkan anggota perpustakaan baru untuk sirkulasi buku.</p>
                                <a href="{{ route('borrowers.create') }}" class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-xs cursor-pointer">
                                    Tambah Anggota
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
    document.getElementById('borrowerSearchInput')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.borrower-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.querySelector('.borrower-name')?.textContent.toLowerCase() || '';
            const phone = row.querySelector('.borrower-phone')?.textContent.toLowerCase() || '';
            const address = row.querySelector('.borrower-address')?.textContent.toLowerCase() || '';

            if (name.includes(query) || phone.includes(query) || address.includes(query)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const countEl = document.getElementById('borrowerCount');
        if (countEl) countEl.textContent = visibleCount;
    });
</script>
@endpush