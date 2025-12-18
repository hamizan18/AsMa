@extends('layouts.app')

@section('content')

<title>Reports Page - Admin</title>

<main class="container mx-auto px-4 py-8 md:px-10 lg:px-16 min-h-screen">

    {{-- ==================== Header Halaman & Title ==================== --}}
    <h1 class="text-3xl md:text-4xl font-extrabold text-white flex items-center space-x-3 mb-8">
        <iconify-icon icon="mdi:alert-box-multiple-outline" width="36" class="text-red-400"></iconify-icon>
        <span class="text-white">Daftar Laporan Aspirasi</span>
    </h1>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="bg-green-500/80 text-white px-4 py-3 rounded-lg flex items-center space-x-3 mb-6 shadow-md">
            <iconify-icon icon="mdi:check-circle-outline" width="24"></iconify-icon>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- ==================== Tabel Laporan ==================== --}}
    <div class="bg-white/5 p-4 md:p-6 rounded-xl shadow-2xl overflow-x-auto">
        
        <div class="text-sm font-semibold text-red-400 mb-4 flex items-center">
            <iconify-icon icon="mdi:warning-octagon-outline" width="20" class="mr-2"></iconify-icon>
            Laporan yang masuk perlu segera ditinjau oleh Administrator.
        </div>

        <table class="w-full text-left text-sm text-gray-200">
            <thead class="text-xs uppercase bg-white/10 text-white">
                <tr>
                    <th scope="col" class="py-3 px-4 rounded-tl-lg">No</th>
                    <th scope="col" class="py-3 px-4">Judul Aspirasi</th>
                    <th scope="col" class="py-3 px-4">Kategori</th>
                    <th scope="col" class="py-3 px-4">Pengirim Aspirasi</th>
                    <th scope="col" class="py-3 px-4">Pelapor</th>
                    <th scope="col" class="py-3 px-4">Alasan</th>
                    <th scope="col" class="py-3 px-4 rounded-tr-lg">Waktu Laporan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $index => $report)
                    <tr class="border-b border-white/10 hover:bg-red-900/10 transition duration-150">
                        <td class="py-3 px-4 font-medium text-red-300">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 font-semibold text-white/90 max-w-xs truncate">
                            {{ $report->aspiration->title ?? 'Aspirasi Terhapus' }}
                        </td>
                        <td class="py-3 px-4">
                            @if(isset($report->aspiration))
                                <span class="text-xs font-semibold px-2 py-1 rounded-full 
                                    @if($report->aspiration->category == 'fasilitas')
                                        bg-blue-600/70 text-blue-100
                                    @elseif($report->aspiration->category == 'akademik')
                                        bg-yellow-600/70 text-yellow-100
                                    @else
                                        bg-purple-600/70 text-purple-100
                                    @endif
                                ">
                                    {{ ucfirst($report->aspiration->category) }}
                                </span>
                            @else
                                <span class="text-xs font-semibold px-2 py-1 rounded-full bg-gray-500/70 text-gray-100">
                                    N/A
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-xs text-gray-400">
                            @if($report->aspiration && $report->aspiration->mahasiswa)
                                <span class="font-semibold text-white">{{ $report->aspiration->mahasiswa->nim }}</span>
                            @else
                                <span class="text-gray-400">Anonim/N/A</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-xs text-red-300">
                            @if($report->mahasiswa)
                                <span class="font-semibold text-white">{{ $report->mahasiswa->nim }}</span>
                            @else
                                <span class="text-red-400">Error/N/A</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 max-w-sm text-gray-300">
                            <span class="truncate block max-w-xs">
                                {{ $report->reason ?? 'Tidak ada alasan.' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-xs text-gray-400">
                            <iconify-icon icon="mdi:calendar-clock-outline" width="14" class="mr-1 inline-block"></iconify-icon>
                            {{ $report->created_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-lg text-gray-400">
                            <iconify-icon icon="mdi:check-circle-outline" width="30" class="mb-2 mx-auto text-green-400"></iconify-icon>
                            Tidak ada laporan yang masuk saat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>
@endsection