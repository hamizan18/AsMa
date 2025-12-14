@extends('layouts.app')

@section('content')

<title>Admin Aspirations Page</title>

<main class="container mx-auto px-4 py-8 md:px-10 lg:px-16 min-h-screen">

    {{-- ==================== Header & Alerts ==================== --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#C399E5] flex items-center space-x-3 mb-4 md:mb-0">
            <iconify-icon icon="mdi:history" width="36" class="text-white"></iconify-icon>
            <span class="text-white">Histori Aspirasi</span>
        </h1>

        {{-- Tombol Delete All (Ditempatkan di header agar lebih menonjol) --}}
        <form action="{{ route('aspiration.destroyAll') }}" method="POST" class="mt-4 md:mt-0">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    onclick="return confirm('PERINGATAN: Yakin ingin Hapus SEMUA Aspirasi? Aksi ini tidak dapat dibatalkan.')"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center shadow-lg transform hover:scale-[1.02]">
                <iconify-icon icon="mdi:delete-sweep-outline" width="20" class="mr-2"></iconify-icon>
                Delete All
            </button>
        </form>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="bg-green-500/80 text-white px-4 py-3 rounded-lg flex items-center space-x-3 mb-6 shadow-md">
            <iconify-icon icon="mdi:check-circle-outline" width="24"></iconify-icon>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- ==================== Tabel Aspirasi ==================== --}}
    <div class="bg-white/5 p-4 md:p-6 rounded-xl shadow-2xl overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-200">
            <thead class="text-xs uppercase bg-white/10 text-white">
                <tr>
                    <th scope="col" class="py-3 px-4 rounded-tl-lg">No</th>
                    <th scope="col" class="py-3 px-4">Judul</th>
                    <th scope="col" class="py-3 px-4">Kategori</th>
                    <th scope="col" class="py-3 px-4">Isi</th>
                    <th scope="col" class="py-3 px-4">Votes</th>
                    <th scope="col" class="py-3 px-4">Pengirim</th>
                    <th scope="col" class="py-3 px-4">Dikirim pada</th>
                    <th scope="col" class="py-3 px-4">Balasan?</th>
                    <th scope="col" class="py-3 px-4 rounded-tr-lg text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirasi as $index => $asp)
                    <tr class="border-b border-white/10 hover:bg-white/10 transition duration-150">
                        <td class="py-3 px-4 font-medium text-white">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 max-w-xs truncate">{{ $asp->title }}</td>
                        <td class="py-3 px-4">
                            <span class="text-xs font-semibold px-2 py-1 rounded-full 
                                @if($asp->category == 'fasilitas')
                                    bg-blue-600/70 text-blue-100
                                @elseif($asp->category == 'akademik')
                                    bg-yellow-600/70 text-yellow-100
                                @else
                                    bg-purple-600/70 text-purple-100
                                @endif
                            ">
                                {{ ucfirst($asp->category) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 max-w-md truncate text-gray-300">{{ $asp->content }}</td>
                        <td class="py-3 px-4 text-center font-bold text-lg text-green-400 flex items-center justify-center space-x-1">
                            <iconify-icon icon="mdi:thumb-up" width="16"></iconify-icon>
                            <span>{{ $asp->votes }}</span>
                        </td>
                        <td class="py-3 px-4 text-xs text-gray-400">
                            @if($asp->mahasiswa)
                                <span class="font-semibold text-white">{{ $asp->mahasiswa->nim }}</span>
                            @else
                                <span class="text-red-400 font-semibold">Anonim / Terhapus</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-xs text-gray-400">{{ $asp->created_at->format('d M Y, H:i') }}</td>
                        <td class="py-3 px-4">
                            @if($asp->reply)
                                <span class="text-green-400 font-medium flex items-center">
                                    <iconify-icon icon="mdi:check-circle" width="16" class="mr-1"></iconify-icon>
                                    Sudah
                                </span>
                            @else
                                <span class="text-yellow-400 font-medium flex items-center">
                                    <iconify-icon icon="mdi:clock-outline" width="16" class="mr-1"></iconify-icon>
                                    Belum
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center whitespace-nowrap">
                            {{-- Tombol Balas --}}
                            <a href="{{ route('aspiration.reply.form', $asp->id) }}"
                               class="bg-[#6E3FAE] hover:bg-purple-700 text-white text-sm font-medium py-1.5 px-3 rounded-lg transition duration-200 inline-flex items-center shadow-md mr-1">
                                <iconify-icon icon="mdi:reply" width="16" class="mr-1"></iconify-icon>
                                Balas
                            </a>

                            {{-- Tombol Delete --}}
                            <form action="{{ route('aspiration.destroy', $asp->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Yakin ingin hapus Aspirasi {{ $asp->title }}?')"
                                        class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-1.5 px-3 rounded-lg transition duration-200 inline-flex items-center shadow-md">
                                    <iconify-icon icon="mdi:trash-can-outline" width="16" class="mr-1"></iconify-icon>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="py-6 text-center text-lg text-gray-400">
                            <iconify-icon icon="mdi:folder-open-outline" width="30" class="mb-2 mx-auto"></iconify-icon>
                            Belum ada Aspirasi yang masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>
@endsection