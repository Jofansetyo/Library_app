@extends('layouts.app')

@section('title', 'Tambah Buku Baru')
@section('header_title', 'Registrasi Buku Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <!-- Breadcrumb / Back Link -->
    <div>
        <a href="{{ route('books.index') }}"
           class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Katalog Buku
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <!-- Card Header -->
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-heading font-bold text-slate-900">Formulir Buku Baru</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Lengkapi data bibliografi buku untuk dimasukkan ke katalog perpustakaan.</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('books.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            <!-- Judul Buku -->
            <div>
                <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Judul Buku <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       required
                       placeholder="Contoh: Laskar Pelangi, Bumi Manusia..."
                       class="w-full px-4 py-2.5 bg-white border @error('title') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:ring-blue-500/10 focus:border-blue-500 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-4 transition-all">
                @error('title')
                    <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Penulis / Pengarang -->
            <div>
                <label for="author" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Nama Penulis / Pengarang <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       id="author"
                       name="author"
                       value="{{ old('author') }}"
                       required
                       placeholder="Contoh: Pramoedya Ananta Toer, Andrea Hirata..."
                       class="w-full px-4 py-2.5 bg-white border @error('author') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:ring-blue-500/10 focus:border-blue-500 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-4 transition-all">
                @error('author')
                    <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grid: Tahun Terbit, ISBN, Lokasi Rak -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <!-- Tahun Terbit -->
                <div>
                    <label for="year" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Tahun Terbit <span class="text-rose-500">*</span>
                    </label>
                    <input type="number"
                           id="year"
                           name="year"
                           value="{{ old('year', date('Y')) }}"
                           required
                           min="1800"
                           max="{{ date('Y') + 1 }}"
                           placeholder="2024"
                           class="w-full px-4 py-2.5 bg-white border @error('year') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:ring-blue-500/10 focus:border-blue-500 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:ring-4 transition-all">
                    @error('year')
                        <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor ISBN -->
                <div>
                    <label for="isbn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nomor ISBN
                    </label>
                    <input type="text"
                           id="isbn"
                           name="isbn"
                           value="{{ old('isbn') }}"
                           placeholder="978-602-03-..."
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-mono text-xs">
                </div>

                <!-- Lokasi Rak -->
                <div>
                    <label for="location" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Lokasi Rak
                    </label>
                    <input type="text"
                           id="location"
                           name="location"
                           value="{{ old('location') }}"
                           placeholder="Contoh: Rak A-02"
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('books.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-semibold transition-all cursor-pointer">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-150 cursor-pointer focus:outline-hidden focus:ring-4 focus:ring-blue-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Simpan Buku</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
