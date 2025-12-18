@extends('layouts.app')

@section('content')

    {{-- KODE CSS TAMBAHAN UNTUK STYLING & FONT --}}
    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    {{-- CONTAINER UTAMA - Menggunakan Gradient Background --}}
    <div class="min-h-screen p-8 lg:p-16 font-poppins" 
         style="background: linear-gradient(135deg, #4B2268, #CAC5D3); color: #2D0C47;">

        <div class="max-w-4xl mx-auto mt-5 lg:mt-10">
            
            {{-- HEADER VISUAL --}}
            <header class="text-center mb-12">
                <h1 class="text-5xl lg:text-6xl font-extrabold text-white tracking-tight drop-shadow-lg flex items-center justify-center">
                    <i class="fas fa-info-circle mr-4 text-[#CAC5D3]"></i>
                    Tentang Kami
                </h1>
                <p class="mt-4 text-xl text-white/90 font-light">Membangun lingkungan kampus yang responsif dan transparan.</p>
            </header>

            {{-- KONTEN UTAMA - Glassmorphism Card --}}
            <div class="p-8 lg:p-12 rounded-[32px] backdrop-blur-xl bg-white/10 
                        shadow-3xl border border-white/20 transition duration-500 space-y-10">

                {{-- Bagian 1: Visi Misi --}}
                <section>
                    <h2 class="text-3xl font-bold text-white mb-6 border-b border-white/30 pb-2 flex items-center">
                        <i class="fas fa-eye mr-3 text-[#CAC5D3]"></i> Visi & Misi
                    </h2>

                    <div class="grid md:grid-cols-2 gap-8">
                        
                        {{-- Visi Card --}}
                        <div class="p-6 rounded-2xl bg-white/70 shadow-lg border border-white/80">
                            <h3 class="text-xl font-semibold mb-3 text-[#2D0C47] flex items-center">
                                Visi
                            </h3>
                            <p class="text-gray-700">
                                Menjadi platform aspirasi digital terdepan yang mendorong budaya komunikasi terbuka dan konstruktif di lingkungan akademik.
                            </p>
                        </div>
                        
                        {{-- Misi Card --}}
                        <div class="p-6 rounded-2xl bg-white/70 shadow-lg border border-white/80">
                            <h3 class="text-xl font-semibold mb-3 text-[#2D0C47] flex items-center">
                                Misi
                            </h3>
                            <ul class="list-disc list-inside text-gray-700 space-y-2 text-sm">
                                <li>Menyediakan saluran umpan balik yang aman dan anonim.</li>
                                <li>Memastikan setiap aspirasi ditanggapi secara profesional oleh admin terkait.</li>
                                <li>Meningkatkan transparansi pengambilan keputusan kampus.</li>
                            </ul>
                        </div>
                    </div>
                </section>

                {{-- Divider --}}
                <hr class="border-white/30 my-8">

                {{-- Bagian 2: Nilai Inti --}}
                <section>
                    <h2 class="text-3xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-gem mr-3 text-[#CAC5D3]"></i> Nilai Inti
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                        
                        {{-- Nilai 1: Transparansi --}}
                        <div class="p-4 rounded-xl bg-white/70 shadow-md transform hover:scale-105 transition duration-300">
                            <i class="fas fa-hand-holding-usd text-4xl text-[#4B2268] mb-3"></i>
                            <h4 class="font-semibold text-[#2D0C47]">Transparansi</h4>
                            <p class="text-xs text-gray-600 mt-1">Setiap proses dapat dilihat publik.</p>
                        </div>
                        
                        {{-- Nilai 2: Keamanan --}}
                        <div class="p-4 rounded-xl bg-white/70 shadow-md transform hover:scale-105 transition duration-300">
                            <i class="fas fa-shield-alt text-4xl text-[#4B2268] mb-3"></i>
                            <h4 class="font-semibold text-[#2D0C47]">Keamanan</h4>
                            <p class="text-xs text-gray-600 mt-1">Anonimitas dan data pengguna terjamin.</p>
                        </div>
                        
                        {{-- Nilai 3: Responsivitas --}}
                        <div class="p-4 rounded-xl bg-white/70 shadow-md transform hover:scale-105 transition duration-300">
                            <i class="fas fa-clock text-4xl text-[#4B2268] mb-3"></i>
                            <h4 class="font-semibold text-[#2D0C47]">Responsivitas</h4>
                            <p class="text-xs text-gray-600 mt-1">Tanggapan cepat dan efektif.</p>
                        </div>
                    </div>
                </section>
                
                {{-- Divider --}}
                <hr class="border-white/30 my-8">

                {{-- Bagian 3: Hubungi Kami (Simulasi) --}}
                <section class="text-center">
                    <h2 class="text-2xl font-bold text-white mb-4">Punya Pertanyaan?</h2>
                    <p class="text-white/80 mb-6">Jangan ragu untuk menghubungi tim pengembang kami.</p>
                    
                    <a href="mailto:support@example.com"
                       class="inline-flex items-center py-3 px-8 rounded-xl font-bold text-white bg-[#2D0C47] shadow-xl shadow-[#2D0C47]/50 
                              hover:bg-[#4B2268] hover:shadow-2xl hover:shadow-[#4B2268]/70 transition duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-envelope mr-3"></i> Hubungi Kami
                    </a>
                </section>

            </div> {{-- End of Glassmorphism Card --}}
        </div>
    </div>
@endsection