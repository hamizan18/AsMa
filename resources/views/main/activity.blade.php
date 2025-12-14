@extends('layouts.app')

{{-- Tambahkan styling custom jika diperlukan (seperti font dan animasi) --}}
@section('content')

    {{-- CONTAINER UTAMA - Menggunakan Gradient Background --}}
    <div class="min-h-screen p-6 lg:p-12 font-poppins text-[#2D0C47]" 
         style="background: linear-gradient(135deg, #4B2268, #CAC5D3);">
        
        {{-- Header --}}
        <div class="max-w-4xl mx-auto mb-10 text-center">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight drop-shadow-lg">
                <i class="fas fa-chart-line mr-3 text-[#CAC5D3]"></i>
                Aktivitas Pengaduan
            </h1>
            <p class="text-white/80 mt-2 text-lg">Lihat aspirasi terbaru dan terpopuler dari mahasiswa.</p>
        </div>

        {{-- FILTER TABS (Modern & Interactive) --}}
        <div class="max-w-4xl mx-auto filter-box flex flex-wrap justify-center gap-3 mb-12 p-3 
             rounded-2xl bg-white/20 backdrop-blur-md shadow-lg border border-white/20">
            
            @php
                // Tentukan kategori aktif untuk styling
                $currentFilter = request()->segment(3) ?? 'all';
            @endphp

            @foreach (['Semua' => 'activity', 'Fasilitas' => 'fasilitas', 'Curhatan' => 'curhatan', 'Kampus' => 'kampus', 'Akademik' => 'akademik'] as $label => $filter)
                @php
                    $isActive = (strtolower($filter) == strtolower($currentFilter) || (strtolower($label) == 'semua' && $currentFilter == 'activity'));
                    $route = (strtolower($label) == 'semua') ? route('activity') : route('activity.filter', strtolower($filter));
                @endphp
                
                <a href="{{ $route }}"
                   class="py-2 px-4 rounded-full font-semibold text-sm transition duration-300 
                          {{ $isActive 
                            ? 'bg-[#2D0C47] text-white shadow-xl shadow-[#2D0C47]/50' 
                            : 'bg-white/50 text-[#4B2268] hover:bg-white/80 hover:scale-[1.02]' }}">
                    <i class="fas fa-tags mr-1.5"></i> {{ $label }}
                </a>
            @endforeach
        </div>

        <hr class="max-w-4xl mx-auto border-white/30 mb-10">

        {{-- LIST ASPIRASI --}}
        <div class="max-w-4xl mx-auto space-y-6">
            @foreach ($aspirasi as $index => $asp)
                
                @php
                    $isPopular = ($index === 0);
                    $hasReply = $asp->reply;
                @endphp

                {{-- KARTU ASPIRASI (Glassmorphism + Animasi Hover) --}}
                <div class="p-6 rounded-2xl backdrop-blur-md transition duration-300 relative
                            {{ $hasReply ? 'bg-white/30 border border-[#2D0C47]/40 shadow-xl' : 'bg-white/15 border border-white/30 shadow-lg' }}
                            hover:scale-[1.01] hover:shadow-2xl hover:-translate-y-1">

                    {{-- Populer Badge --}}
                    @if($isPopular)
                        <span class="absolute top-0 right-0 -mt-3 mr-4 py-1 px-4 rounded-full text-xs font-bold text-white 
                              bg-yellow-500 shadow-md transform rotate-1 transition duration-500 hover:rotate-0">
                            ⭐ Paling Populer ⭐
                        </span>
                    @endif

                    {{-- Kategori & Judul --}}
                    <p class="text-sm font-semibold mb-1 
                        {{ $isPopular ? 'text-yellow-600' : 'text-[#2D0C47]' }}">
                        Kategori: {{ ucfirst($asp->category) }}
                    </p>
                    <h3 class="text-xl lg:text-2xl font-bold mb-3 leading-snug text-[#2D0C47]">
                        {{ $asp->title }}
                    </h3>
                    <p class="text-gray-700 mb-4 line-clamp-3"> {{ $asp->content }} </p>

                    {{-- Balasan Admin --}}
                    @if($hasReply)
                        <div class="reply-box p-4 rounded-xl bg-white/70 border-l-4 border-[#2D0C47] mb-4 shadow-inner transition duration-300">
                            <strong class="text-[#2D0C47] flex items-center mb-1">
                                <i class="fas fa-reply-all mr-2 text-lg"></i> Balasan Admin:
                            </strong>
                            <p class="text-sm text-gray-800"> {{ $asp->reply }} </p>
                        </div>
                    @endif
                    
                    {{-- Footer: Pengirim, Votes, dan Interaksi --}}
                    <div class="flex flex-wrap items-center justify-between border-t border-white/50 pt-3 mt-3">
                        
                        {{-- Pengirim & Votes --}}
                        <div class="flex items-center space-x-4 text-sm font-medium text-gray-600">
                            
                            {{-- Pengirim --}}
                            <p class="flex items-center">
                                <strong>Pengirim:</strong> &nbsp;
                                @if($asp->is_anonymous)
                                    <span class="text-gray-800 flex items-center">
                                        <i class="fas fa-mask text-base mr-1 ml-0.5"></i> Anonim
                                    </span>
                                @elseif($asp->mahasiswa)
                                    <span class="text-[#4B2268] font-bold">{{ $asp->mahasiswa->nim }}</span>
                                @else
                                    -
                                @endif
                            </p>
                            
                            {{-- Votes --}}
                            <p class="flex items-center text-[#4B2268] font-bold">
                                <i class="fas fa-heart text-red-500 mr-1.5"></i> Votes: {{ $asp->votes }}
                            </p>
                        </div>

                        {{-- Tombol Interaksi Mahasiswa --}}
                        <div class="flex items-center space-x-3 mt-3 sm:mt-0">
                            
                            @if(auth()->guard('mahasiswa')->check())
                                @php
                                    $alreadyVoted = isset($votedIds) && in_array($asp->id, $votedIds);
                                    $alreadyReported = isset($reportedIds) && in_array($asp->id, $reportedIds);
                                @endphp

                                {{-- Vote Button --}}
                                @if(!$alreadyVoted)
                                    <form action="{{ route('aspiration.vote', $asp->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="btn-action bg-green-500 text-white hover:bg-green-600 shadow-md transition duration-200 transform hover:scale-105">
                                            <i class="fas fa-arrow-up mr-1"></i> Vote
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-500 p-2 rounded-lg bg-gray-100 italic">
                                        <i class="fas fa-check-circle mr-1"></i> Sudah Vote
                                    </span>
                                @endif
                                
                                {{-- Report Button --}}
                                @if(!$alreadyReported)
                                    <form action="{{ route('aspiration.report', $asp->id) }}" method="POST" class="flex items-center space-x-1">
                                        @csrf
                                        <input type="text" name="reason" placeholder="Alasan laporan" required
                                               class="p-2 text-xs rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-400 w-32 md:w-40 bg-white/70">
                                        <button type="submit" onclick="return confirm('Laporkan aspirasi ini ke admin?')"
                                                class="btn-action bg-red-500 text-white hover:bg-red-600 transition duration-200">
                                            <i class="fas fa-flag"></i> Report
                                        </button>
                                    </form>
                                @else 
                                    <span class="text-xs text-red-500 p-2 rounded-lg bg-red-100 italic">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Sudah Dilaporkan
                                    </span>
                                @endif
                            @endif
                            
                            {{-- Tombol Aksi Admin --}}
                            @if(auth()->guard('admin')->check())
                                
                                {{-- Tombol Balas --}}
                                @if(!$asp->reply)
                                    <a href="{{ route('aspiration.reply.form', $asp->id) }}">
                                        <button type="button" class="btn-action bg-[#4B2268] text-white hover:bg-[#2D0C47] transition duration-200">
                                            <i class="fas fa-reply mr-1"></i> Balas
                                        </button>
                                    </a>
                                @endif
                                
                                {{-- Hapus Balasan (Jika ada balasan) --}}
                                @if($hasReply)
                                    <form action="{{ route('aspiration.destroy', $asp->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus balasan?')"
                                                class="btn-action bg-yellow-500 text-white hover:bg-yellow-600 transition duration-200">
                                            <i class="fas fa-eraser mr-1"></i> Hapus Balasan
                                        </button>
                                    </form>
                                @endif
                                
                                {{-- Delete Aspirasi (Admin) --}}
                                <form action="{{ route('aspiration.destroy', $asp->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus aspirasi ini?')
                                            class="btn-action bg-red-700 text-white hover:bg-red-800 transition duration-200">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div> {{-- End of Aspirasi Card --}}
            @endforeach
        </div> {{-- End of List Aspirasi --}}

        {{-- Footer Admin Action (Delete All) --}}
        @if(auth()->guard('admin')->check())
            <div class="max-w-4xl mx-auto mt-10 p-4 text-center rounded-xl bg-white/20 backdrop-blur-sm border border-white/30">
                <form action="{{ route('aspiration.destroyAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS SEMUA aspirasi? Tindakan ini tidak dapat dibatalkan!')"
                            class="py-3 px-6 rounded-xl font-bold text-white bg-red-900 shadow-lg hover:bg-red-700 transition duration-300 transform hover:scale-[1.02]">
                        <i class="fas fa-radiation-alt mr-2"></i> DELETE SEMUA ASPIRASI
                    </button>
                </form>
            </div>
        @endif
    </div>

    {{-- KODE CSS TAMBAHAN UNTUK REUSABILITY --}}
    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
        .btn-action {
            padding: 8px 12px;
            font-size: 0.875rem; /* text-sm */
            border-radius: 0.5rem; /* rounded-lg */
            font-weight: 600; /* semi-bold */
        }
    </style>
@endsection