
@extends('layouts.app')

@section('content')

<title>Reply Page - Admin</title>

<main class="container mx-auto px-4 py-8 md:px-10 lg:px-16 min-h-screen">

    {{-- ==================== Header Halaman ==================== --}}
    <h1 class="text-3xl md:text-4xl font-extrabold text-white flex items-center space-x-3 mb-8">
        <iconify-icon icon="mdi:reply-all" width="36" class="text-[#C399E5]"></iconify-icon>
        <span>Balas Aspirasi</span>
    </h1>

    {{-- ==================== Kotak Aspirasi Asli ==================== --}}
    <div class="bg-white/10 p-6 rounded-xl shadow-lg border-l-4 border-[#C399E5] mb-8">
        <h2 class="text-xl md:text-2xl font-bold text-white mb-2 flex items-center">
            <iconify-icon icon="mdi:message-text-outline" width="24" class="mr-2 text-white/70"></iconify-icon>
            {{ $aspirasi->title}}
        </h2>
        
        <p class="mb-3 text-sm font-semibold text-gray-300">
            <iconify-icon icon="mdi:tag-multiple" width="16" class="mr-1 inline-block"></iconify-icon>
            Kategori: 
            <span class="text-xs font-bold px-2 py-0.5 rounded-full 
                @if($aspirasi->category == 'fasilitas')
                    bg-blue-600/70 text-blue-100
                @elseif($aspirasi->category == 'akademik')
                    bg-yellow-600/70 text-yellow-100
                @else
                    bg-purple-600/70 text-purple-100
                @endif
            ">
                {{ ucfirst($aspirasi->category) }}
            </span>
        </p>

        <p class="text-gray-200 mt-4 border-t border-white/20 pt-4">
            {{ $aspirasi->content }}
        </p>
    </div>

    {{-- ==================== Formulir Balasan Admin ==================== --}}
    <div class="bg-white p-6 md:p-8 rounded-xl shadow-2xl">
        
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <iconify-icon icon="mdi:pencil-outline" width="24" class="mr-2 text-[#6E3FAE]"></iconify-icon>
            Tulis Balasan
        </h2>

        <form action="{{ route('aspiration.reply.store', $aspirasi->id) }}" method="POST">
            @csrf
            
            <label for="reply" class="block text-sm font-medium text-gray-700 mb-2">
                Balasan Resmi dari Admin:
            </label>
            
            <textarea name="reply" id="reply" 
                      rows="6" required maxlength="2000"
                      class="w-full border border-gray-300 rounded-lg p-3 focus:ring-[#6E3FAE] focus:border-[#6E3FAE] 
                             transition duration-200 resize-none text-gray-800 placeholder-gray-400"
                      placeholder="Tuliskan balasan resmi Anda disini, maksimal 2000 karakter...">{{ old('reply', $aspirasi->reply) }}</textarea>

            <p class="mt-2 text-xs text-gray-500">
                Maksimal 2000 karakter. Balasan ini akan terlihat oleh mahasiswa.
            </p>

            <br>

            <button type="submit"
                    class="bg-[#6E3FAE] hover:bg-[#5C2A9A] text-white font-semibold py-3 px-6 rounded-lg 
                           transition duration-200 flex items-center justify-center shadow-lg mt-4 transform hover:scale-[1.02]">
                <iconify-icon icon="mdi:send-check-outline" width="20" class="mr-2"></iconify-icon>
                Kirim Balasan
            </button>
            
        </form>
    </div>
</main>
@endsection