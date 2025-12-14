@extends('layouts.app')

@section('content')

<main class="container mx-auto px-4 py-8 md:px-10 lg:px-16 min-h-screen">

    {{-- Container Utama Dibuat Fokus dan Dark --}}
    <div class="max-w-xl mx-auto mt-10 bg-white/5 shadow-2xl rounded-xl p-8 border border-white/10">
        
        <h1 class="text-3xl font-extrabold text-white mb-6 flex items-center space-x-3">
            <iconify-icon icon="mdi:account-circle" width="32" class="text-[#C399E5]"></iconify-icon>
            <span>Profil Saya</span>
        </h1>

        {{-- Flash message sukses (Warna hijau yang menyatu dengan dark mode) --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-700/50 text-green-200 text-sm font-medium border border-green-500/50 flex items-center space-x-2 shadow-md">
                <iconify-icon icon="mdi:check-circle-outline" width="20"></iconify-icon>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Error (Warna merah yang kuat) --}}
        @if($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-700/50 text-red-200 text-sm border border-red-500/50 shadow-md">
                <ul class="list-none space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="flex items-center space-x-2">
                            <iconify-icon icon="mdi:alert-circle-outline" width="18"></iconify-icon>
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ==================== Kartu Data Diri ==================== --}}
        <div class="bg-white/10 p-5 rounded-lg mb-8 space-y-3 border border-white/20">
            <h2 class="text-xl font-semibold text-white mb-3 flex items-center space-x-2">
                 <iconify-icon icon="mdi:card-account-details-outline" width="20" class="text-[#C399E5]"></iconify-icon>
                Detail Pengguna
            </h2>
            
            <div class="space-y-2 text-gray-200">
                <p class="flex justify-between items-center pb-2 border-b border-white/10">
                    <span class="font-semibold text-white">Role:</span> 
                    <span class="text-sm font-medium px-3 py-1 rounded-full bg-[#6E3FAE]/70 text-white shadow-md">
                        {{ ucfirst($role) }}
                    </span>
                </p>

                @if($role === 'mahasiswa')
                    <p class="flex justify-between items-center pb-2 border-b border-white/10">
                        <span class="font-semibold">NIM:</span> 
                        <span class="text-white">{{ $user->nim ?? '-' }}</span>
                    </p>
                @endif

                <p class="flex justify-between items-center pb-2 border-b border-white/10">
                    <span class="font-semibold">Nama:</span> 
                    <span class="text-white">{{ $user->nama ?? $user->name ?? '-' }}</span>
                </p>
                
                @if(isset($user->email))
                    <p class="flex justify-between items-center">
                        <span class="font-semibold">Email:</span> 
                        <span class="text-white/70">{{ $user->email }}</span>
                    </p>
                @endif
            </div>
        </div>

        {{-- ==================== Form Ganti Password ==================== --}}
        <h2 class="text-xl font-bold text-white mb-4 pt-4 border-t border-white/20 flex items-center space-x-2">
            <iconify-icon icon="mdi:lock-reset" width="20" class="text-white/70"></iconify-icon>
            Ganti Password
        </h2>

        <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-300">Password Lama</label>
                <input type="password" name="current_password"
                    class="w-full border-none rounded-lg px-4 py-2.5 bg-white/10 text-white placeholder-gray-400 
                           focus:outline-none focus:ring-2 focus:ring-[#C399E5] transition"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-300">Password Baru</label>
                <input type="password" name="password"
                    class="w-full border-none rounded-lg px-4 py-2.5 bg-white/10 text-white placeholder-gray-400 
                           focus:outline-none focus:ring-2 focus:ring-[#C399E5] transition"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-300">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full border-none rounded-lg px-4 py-2.5 bg-white/10 text-white placeholder-gray-400 
                           focus:outline-none focus:ring-2 focus:ring-[#C399E5] transition"
                    required>
            </div>

            <button type="submit"
                class="w-full px-4 py-3 bg-[#6E3FAE] text-white font-semibold rounded-lg hover:bg-[#5C2A9A] 
                       transition duration-200 transform hover:scale-[1.01] shadow-lg flex items-center justify-center space-x-2">
                <iconify-icon icon="mdi:content-save-outline" width="20"></iconify-icon>
                <span>Simpan Password Baru</span>
            </button>
        </form>
    </div>

</main>
@endsection