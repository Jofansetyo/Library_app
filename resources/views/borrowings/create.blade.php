@extends('layouts.app')

@section('title', 'Catat Peminjaman Buku')
@section('header_title', 'Transaksi Peminjaman Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <!-- Breadcrumb / Back Link -->
    <div>
        <a href="{{ route('borrowings.index') }}"
           class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Sirkulasi Peminjaman
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <!-- Card Header -->
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-heading font-bold text-slate-900">Formulir Peminjaman Baru</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Catat peminjaman buku oleh anggota dengan batas tenggat waktu pengembalian.</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('borrowings.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            <!-- Pilih Peminjam / Anggota -->
            <div>
                <label for="borrower_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Nama Peminjam / Anggota <span class="text-rose-500">*</span>
                </label>
                <select id="borrower_id"
                        name="borrower_id"
                        required
                        class="w-full px-4 py-2.5 bg-white border @error('borrower_id') border-rose-400 focus:ring-rose-500/10 @else border-slate-300 focus:ring-blue-600/10 focus:border-blue-600 @enderror rounded-xl text-sm text-slate-900 focus:outline-none focus:ring-4 transition-all cursor-pointer">
                    <option value="" disabled selected>-- Pilih Anggota --</option>
                    @foreach ($borrowers as $borrower)
                        <option value="{{ $borrower->id }}" {{ old('borrower_id') == $borrower->id ? 'selected' : '' }}>
                            {{ $borrower->name }} {{ $borrower->phone ? '(' . $borrower->phone . ')' : '' }}
                        </option>
                    @endforeach
                </select>
                @error('borrower_id')
                    <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilih Buku -->
            <div>
                <label for="book_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Judul Buku Yang Dipinjam <span class="text-rose-500">*</span>
                </label>
                <select id="book_id"
                        name="book_id"
                        required
                        class="w-full px-4 py-2.5 bg-white border @error('book_id') border-rose-400 focus:ring-rose-500/10 @else border-slate-300 focus:ring-blue-600/10 focus:border-blue-600 @enderror rounded-xl text-sm text-slate-900 focus:outline-none focus:ring-4 transition-all cursor-pointer">
                    <option value="" disabled selected>-- Pilih Buku --</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->title }} ({{ $book->author }} - {{ $book->year }})
                        </option>
                    @endforeach
                </select>
                @error('book_id')
                    <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grid: Tanggal Pinjam & Batas Pengembalian -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Tanggal Pinjam -->
                <div>
                    <label for="borrow_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Tanggal Pinjam <span class="text-rose-500">*</span>
                    </label>
                    <input type="date"
                           id="borrow_date"
                           name="borrow_date"
                           value="{{ old('borrow_date', date('Y-m-d')) }}"
                           required
                           class="w-full px-4 py-2.5 bg-white border @error('borrow_date') border-rose-400 focus:ring-rose-500/10 @else border-slate-300 focus:ring-blue-600/10 focus:border-blue-600 @enderror rounded-xl text-sm text-slate-900 focus:outline-none focus:ring-4 transition-all">
                    @error('borrow_date')
                        <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Batas Pengembalian (Jatuh Tempo) -->
                <div>
                    <label for="return_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Batas Pengembalian (Tenggat) <span class="text-rose-500">*</span>
                    </label>
                    <input type="date"
                           id="return_date"
                           name="return_date"
                           value="{{ old('return_date', date('Y-m-d', strtotime('+7 days'))) }}"
                           required
                           class="w-full px-4 py-2.5 bg-white border @error('return_date') border-rose-400 focus:ring-rose-500/10 @else border-slate-300 focus:ring-blue-600/10 focus:border-blue-600 @enderror rounded-xl text-sm text-slate-900 focus:outline-none focus:ring-4 transition-all">
                    @error('return_date')
                        <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
                <a href="{{ route('borrowings.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-sm font-semibold transition-all cursor-pointer">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-150 cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Simpan Peminjaman</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection