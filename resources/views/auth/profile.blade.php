<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - SI-CUTE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- NAVBAR SEDERHANA -->
    <nav class="bg-blue-800 shadow-md">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <div class="flex items-center gap-3 text-white">
                <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 p-2 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <span class="font-bold text-lg tracking-wide">Pengaturan Profil Admin</span>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @if(session('success'))
        <div class="mb-6 bg-emerald-100 text-emerald-800 px-4 py-3 rounded-xl shadow-sm border border-emerald-200">{{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="mb-6 bg-red-100 text-red-800 px-4 py-3 rounded-xl shadow-sm border border-red-200">{{ $errors->first() }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- INFO AKUN & UBAH EMAIL -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 col-span-1 md:col-span-2">
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2"><svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Informasi Akun</h3>
                <form action="{{ route('profil.update') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-xl bg-slate-100 text-slate-500 cursor-not-allowed" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-sm font-semibold shadow-sm transition">Perbarui Email</button>
                </form>
            </div>

            <!-- UBAH PIN KONFIRMASI -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-t-4 border-t-purple-500">
                <h3 class="font-bold text-lg mb-4 text-purple-700 flex items-center gap-2">🔒 PIN Keamanan</h3>
                <p class="text-xs text-slate-500 mb-4">Buat 6-digit PIN untuk otorisasi saat mengubah sisa cuti atau menghapus pegawai.</p>
                <form action="{{ route('profil.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">PIN 6-Digit Baru</label>
                        <input type="password" name="new_pin" maxlength="6" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none tracking-widest text-center font-mono text-lg" placeholder="••••••">
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Ulangi PIN</label>
                        <input type="password" name="new_pin_confirmation" maxlength="6" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none tracking-widest text-center font-mono text-lg" placeholder="••••••">
                    </div>
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-xl text-sm font-semibold shadow-sm transition">Simpan PIN</button>
                </form>
            </div>

            <!-- UBAH KATA SANDI -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 col-span-1 md:col-span-3">
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2"><svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg> Ubah Kata Sandi</h3>
                <form action="{{ route('profil.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Kata Sandi Baru</label>
                        <input type="password" name="new_password" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Ulangi Kata Sandi Baru</label>
                        <input type="password" name="new_password_confirmation" required class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="col-span-1 md:col-span-2 mt-2">
                        <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-semibold shadow-sm transition">Update Kata Sandi</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>