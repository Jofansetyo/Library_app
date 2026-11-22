@extends('layouts.app')

@section('title', 'Tambah Anggota Baru')
@section('header_title', 'Registrasi Anggota Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <!-- Breadcrumb / Back Link -->
    <div>
        <a href="{{ route('borrowers.index') }}"
           class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Anggota
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <!-- Card Header -->
        <div class="p-6 border-b border-slate-200 bg-slate-50/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-heading font-bold text-slate-900">Formulir Pendaftaran Anggota</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Masukkan data pribadi anggota untuk mencatat izin peminjaman buku.</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('borrowers.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       placeholder="Contoh: Muhammad Rizky, Siti Aminah..."
                       class="w-full px-4 py-2.5 bg-white border @error('name') border-rose-400 focus:ring-rose-500/10 @else border-slate-300 focus:ring-blue-600/10 focus:border-blue-600 @enderror rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 transition-all">
                @error('name')
                    <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Nomor WhatsApp / Telepon
                </label>
                <input type="text"
                       id="phone"
                       name="phone"
                       value="{{ old('phone') }}"
                       placeholder="08123456789"
                       class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all font-mono text-xs">
            </div>

            <!-- Alamat Domisili -->
            <div>
                <label for="address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Alamat Domisili
                </label>
                <textarea id="address"
                          name="address"
                          rows="3"
                          placeholder="Jl. Pemuda No. 12, Surabaya..."
                          class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all">{{ old('address') }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
                <a href="{{ route('borrowers.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-sm font-semibold transition-all cursor-pointer">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-150 cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Simpan Anggota</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection