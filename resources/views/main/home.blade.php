@extends('layouts.app') 

@section('content')

<style>
    /* Animasi Pulsing sederhana untuk gambar cacing */
    @keyframes pulse-slow-custom {
        0%, 100% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.03) rotate(1deg); } 
    }
    .animate-pulse-slow-custom {
        animation: pulse-slow-custom 3.5s infinite ease-in-out;
    }

    /* Gradient Utama Konten */
    .content-header-bg {
        /* Gradien dari #4B2E72 ke #6E3FAE */
        background-image: linear-gradient(to right, #2e253a, #8053af);
    }

    /* Kartu Keunggulan */
    .feature-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: rgba(255, 255, 255, 0.05); /* bg-white/5 */
        border: 1px solid transparent;
    }
    .feature-card:hover {
        background-color: rgba(255, 255, 255, 0.1); /* bg-white/10 */
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3); 
        border-color: #C399E5; 
    }
    
    /* Tombol Kirim Aspirasi Custom Styling */
    .aspirasi-btn {
        background-color: rgba(255, 255, 255, 0.9); /* bg-white/90 */
        color: #6E3FAE; /* Teks Ungu */
        transition: all 0.3s ease-in-out;
    }
    .aspirasi-btn:hover {
        background-color: #FFFFFF; /* bg-white */
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Interaktivitas Scroll: Efek Ikon */
    .scroll-icon-toggle {
        transition: transform 0.5s ease-out;
    }
    .scrolled .scroll-icon-toggle {
        transform: rotate(360deg); /* Animasi berputar penuh saat discroll */
    }

    /* Akordeon FAQ */
    .faq-item-bg {
        background-color: #f9fafb; 
    }
    .faq-question-bg:hover {
        background-color: #f3f4f6;
    }
</style>
<script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

<main class="flex-grow">
    
    {{-- ================================================= --}}
    {{-- I. HEADER KONTEN: SAMPAIKAN ASPIRASIMU (Gradien) --}}
    {{-- ================================================= --}}
    <section class="content-header-bg pt-16 pb-24 text-white">
        <div class="container mx-auto px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                
                <div class="w-full lg:w-3/5 space-y-6 text-center lg:text-left">
                    <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight">
                        Sampaikan Aspirasimu
                    </h1>
                    <p class="text-xl font-light text-white/90 max-w-xl mx-auto lg:mx-0">
                        Platform pengaduan online resmi untuk menyampaikan aspirasi, saran, dan keluhan mahasiswa secara cepat, mudah, dan transparan.
                    </p>
                    
                    {{-- Tombol Kirim Aspirasi --}}
                    <a href="{{ route('aspiration.store') }}"
                       class="mt-8 inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-semibold rounded-full shadow-lg 
                              aspirasi-btn transform space-x-2">
                        <iconify-icon icon="mdi:send-outline" width="20" class="mr-1"></iconify-icon>
                        <span>Kirim Aspirasi</span>
                    </a>
                </div>

                {{-- Gambar Pendamping dengan Animasi --}}
                <div class="w-full lg:w-2/5 mt-10 lg:mt-0 flex justify-center">
                    <img src="{{ asset('images/maskot.png') }}" alt="Cacing Wisuda AsMa" 
                         class="h-64 w-auto object-contain animate-pulse-slow-custom scroll-icon-toggle">
                </div>

            </div>
        </div>
    </section>

    {{-- ================================================= --}}
    {{-- III. KEUNGGULAN SISTEM (Interaktif) --}}
    {{-- ================================================= --}}
    <section class="bg-[#3b2c5a] py-16">
        <div class="container mx-auto px-8 lg:px-12">
            <h2 class="text-2xl font-semibold text-white/80 mb-8 text-center">Keunggulan Sistem Kami</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Kartu 1: Cepat Diproses --}}
                <div class="feature-card p-6 rounded-xl shadow-xl text-center text-white space-y-3">
                    <div class="text-4xl text-[#C399E5] mb-2">
                        <iconify-icon icon="mdi:fast-forward-outline"></iconify-icon>
                    </div>
                    <h3 class="text-xl font-bold">Cepat Diproses</h3>
                    <p class="text-sm opacity-70">Aspirasi Anda diproses cepat dan transparan tanpa hambatan birokrasi yang bertele-tele.</p>
                </div>

                {{-- Kartu 2: Terjamin Kerahasiaan --}}
                <div class="feature-card p-6 rounded-xl shadow-xl text-center text-white space-y-3">
                    <div class="text-4xl text-[#C399E5] mb-2">
                        <iconify-icon icon="mdi:lock-outline"></iconify-icon>
                    </div>
                    <h3 class="text-xl font-bold">Terjamin Kerahasiaan</h3>
                    <p class="text-sm opacity-70">Jaminan kerahasiaan data Anda, privasi dijamin penuh, bahkan dengan opsi anonim.</p>
                </div>

                {{-- Kartu 3: Lacak Status --}}
                <div class="feature-card p-6 rounded-xl shadow-xl text-center text-white space-y-3">
                    <div class="text-4xl text-[#C399E5] mb-2">
                        <iconify-icon icon="mdi:track-light"></iconify-icon>
                    </div>
                    <h3 class="text-xl font-bold">Lacak Status</h3>
                    <p class="text-sm opacity-70">Lacak status pengaduan Anda secara real-time dari penerimaan hingga keputusan akhir.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================= --}}
    {{-- III. APASAJA YANG BISA DILAPORKAN --}}
    {{-- ================================================= --}}
    <section class="bg-white/5 py-16">
        <div class="container mx-auto px-8 lg:px-12">
            <h2 class="text-2xl font-semibold text-white/80 mb-12 text-center">Apa saja yang bisa kamu laporkan disini?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                
                {{-- Blok 1: Fasilitas Kampus --}}
                <div class="flex space-x-4 text-white">
                    <div class="text-3xl text-[#C399E5] flex-shrink-0">
                        <iconify-icon icon="mdi:door-open"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-1">Fasilitas Kampus</h4>
                        <p class="text-sm opacity-70">Laporan terkait kerusakan/kekurangan fasilitas, lingkungan, atau proyeksi dana yang tidak dipertanggungjawabkan.</p>
                    </div>
                </div>

                {{-- Blok 2: Pelayanan Akademik --}}
                <div class="flex space-x-4 text-white">
                    <div class="text-3xl text-[#C399E5] flex-shrink-0">
                        <iconify-icon icon="mdi:book-open-outline"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-1">Pelayanan Akademik</h4>
                        <p class="text-sm opacity-70">Kritik terhadap sistem KRS, jadwal, nilai, dan administrasi akademik secara keseluruhan.</p>
                    </div>
                </div>

                {{-- Blok 3: Perilaku Dosen atau Staf --}}
                <div class="flex space-x-4 text-white">
                    <div class="text-3xl text-[#C399E5] flex-shrink-0">
                        <iconify-icon icon="mdi:account-tie-outline"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-1">Perilaku Dosen atau Staf</h4>
                        <p class="text-sm opacity-70">Pengaduan mengenai dosen atau staf yang tidak profesional, diskriminatif, atau tidak cakap.</p>
                    </div>
                </div>

                {{-- Blok 4: Pungutan Liar atau Biaya yang Tidak Jelas --}}
                <div class="flex space-x-4 text-white">
                    <div class="text-3xl text-[#C399E5] flex-shrink-0">
                        <iconify-icon icon="mdi:cash-multiple"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-1">Pungutan Liar atau Biaya yang Tidak Jelas</h4>
                        <p class="text-sm opacity-70">Laporan mengenai adanya biaya/dana yang tidak sesuai atau tidak transparan.</p>
                    </div>
                </div>

                {{-- Blok 5: Pelecehan atau Intimidasi --}}
                <div class="flex space-x-4 text-white">
                    <div class="text-3xl text-[#C399E5] flex-shrink-0">
                        <iconify-icon icon="mdi:alert-octagon-outline"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-1">Pelecehan atau Intimidasi</h4>
                        <p class="text-sm opacity-70">Pelaporan terkait perlakuan tidak etis, perundungan, pelecehan seksual, atau intimidasi yang mengganggu kenyamanan belajar.</p>
                    </div>
                </div>

                {{-- Blok 6: Lain-lain --}}
                <div class="flex space-x-4 text-white">
                    <div class="text-3xl text-[#C399E5] flex-shrink-0">
                        <iconify-icon icon="mdi:dots-horizontal-circle-outline"></iconify-icon>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold mb-1">Lain-lain</h4>
                        <p class="text-sm opacity-70">Jenis laporan lain yang tidak termasuk kategori di atas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================= --}}
    {{-- V. BAGIAN BAWAH: FAQ INTERAKTIF --}}
    {{-- ================================================= --}}
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-8 lg:px-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Pertanyaan yang Sering Diajukan (FAQ)</h2>

            <div class="max-w-3xl mx-auto space-y-4" x-data="{ open: null }"> 
                
                {{-- FAQ Item 1 --}}
                <div class="faq-item-bg rounded-lg shadow-md overflow-hidden">
                    <button @click="open = (open === 1 ? null : 1)" 
                            class="faq-question-bg w-full flex justify-between items-center p-5 text-lg font-semibold text-gray-700 transition duration-300">
                        <span>Apa itu AsMa?</span>
                        <iconify-icon icon="mdi:chevron-down" :class="{'rotate-180': open === 1}" class="text-2xl transition-transform"></iconify-icon>
                    </button>
                    <div x-show="open === 1" x-collapse>
                        <p class="px-5 pb-5 text-gray-600 border-t border-gray-200 pt-3">
                            AsMa adalah platform online resmi Politeknik Negeri Lhokseumawe untuk menyampaikan aspirasi, saran, atau keluhan oleh seluruh civitas akademika.
                        </p>
                    </div>
                </div>

                {{-- FAQ Item 2 --}}
                <div class="faq-item-bg rounded-lg shadow-md overflow-hidden">
                    <button @click="open = (open === 2 ? null : 2)" 
                            class="faq-question-bg w-full flex justify-between items-center p-5 text-lg font-semibold text-gray-700 transition duration-300">
                        <span>Apakah kerahasiaan saya terjamin?</span>
                        <iconify-icon icon="mdi:chevron-down" :class="{'rotate-180': open === 2}" class="text-2xl transition-transform"></iconify-icon>
                    </button>
                    <div x-show="open === 2" x-collapse>
                        <p class="px-5 pb-5 text-gray-600 border-t border-gray-200 pt-3">
                            Ya, kami menjamin kerahasiaan data Anda. Anda bahkan dapat memilih opsi anonim saat mengirim laporan. Privasi Anda adalah prioritas kami.
                        </p>
                    </div>
                </div>
                
                {{-- FAQ Item 3 --}}
                <div class="faq-item-bg rounded-lg shadow-md overflow-hidden">
                    <button @click="open = (open === 3 ? null : 3)" 
                            class="faq-question-bg w-full flex justify-between items-center p-5 text-lg font-semibold text-gray-700 transition duration-300">
                        <span>Siapa yang bisa mengakses laporan saya?</span>
                        <iconify-icon icon="mdi:chevron-down" :class="{'rotate-180': open === 3}" class="text-2xl transition-transform"></iconify-icon>
                    </button>
                    <div x-show="open === 3" x-collapse>
                        <p class="px-5 pb-5 text-gray-600 border-t border-gray-200 pt-3">
                            Hanya tim admin dan pihak berwenang internal yang ditunjuk yang dapat mengakses detail laporan Anda untuk proses tindak lanjut.
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

</main>

@endsection