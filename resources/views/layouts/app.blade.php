<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aspirasi Mahasiswa - Politeknik Negeri Lhokseumawe</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Iconify (tetap diperlukan untuk tombol login dan footer) --}}
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Google Font: Inter --}}
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">

    <style>
        body {
            background-color: #3b2c5a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        /* Navbar gradient: #4B2E72 ke #6E3FAE */
        .header-bg-custom {
            background-image: linear-gradient(to right, #4B2E72, #6E3FAE);
        }

        /* Footer gradient: #2A1E3F ke #1E1530 */
        .footer-bg-custom {
            background-image: linear-gradient(to right, #2A1E3F, #1E1530);
        }
        
        /* Kustomisasi Logo AsMa (As Putih, Ma Ungu) */
        .logo-text {
            font-weight: 800;
            line-height: 1; 
        }
        .logo-text .text-white-p {
            color: #FFFFFF;
        }
        .logo-text .text-purple-p {
            color: #C399E5;
        }
        .logo-subtext {
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
            margin-top: -4px;
        }

        /* Nav Link Custom Style (Interaktif) */
        .nav-link-custom {
            color: white;
            font-weight: 500; 
            transition: all 0.2s ease-in-out;
            padding: 8px 12px;
        }
        .nav-link-custom:hover {
            color: #e5e7eb;
            opacity: 0.8;
            transform: translateY(-2px); 
        }

        /* Login Button Custom Style */
        .login-btn-custom {
            background-color: white;
            color: #6E3FAE; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease-in-out;
        }
        .login-btn-custom:hover {
            opacity: 0.9;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }
        
        /* Copyright Interaktif */
        .copyright-interactive:hover {
            color: #fff;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>

    {{-- =================== HEADER / NAVBAR =================== --}}
    <header class="header-bg-custom shadow-2xl border-b-4 border-white/20 sticky top-0 z-10">
        <div class="container mx-auto px-8">
            <div class="flex items-center justify-between h-[80px]">
                
                {{-- Kiri: Logo AsMa + Gambar (Diperbarui) --}}
                <div class="flex items-center space-x-2">
                    
                    {{-- Ganti Ikon dengan Gambar Logo Anda --}}
                    <img src="{{ asset('images/pesawat.png') }}" alt="AsMa Logo" class="h-12 w-auto mr-0">
                    
                    <a href="{{ route('home') }}" class="flex flex-col leading-none">
                        <div class="flex items-center">
                            <span class="text-3xl logo-text font-extrabold tracking-tight">
                                <span class="text-white-p">As</span>
                                <span class="text-purple-p">Ma</span>
                            </span>
                        </div>
                        <span class="logo-subtext">Politeknik Negeri Lhokseumawe</span>
                    </a>
                </div>

                {{-- Tengah: Menu navigasi --}}
                <nav class="hidden lg:flex space-x-4 md:space-x-8 text-lg items-center">
                    <a href="{{ route('home') }}" class="nav-link-custom">Home</a>
                    <a href="{{ route('about') }}" class="nav-link-custom">Tentang</a>
                    <a href="{{ route('aspiration.store') }}" class="nav-link-custom">Aspirasi</a>
                    <a href="{{ route('activity') }}" class="nav-link-custom">Activity</a>
                    <a href="{{ route('visitors') }}" class="nav-link-custom">Graphic</a>

                    @if(Auth::guard('admin')->check())
                        <a href="{{ route('admin.index') }}" 
                           class="text-white font-semibold text-sm px-3 py-1 rounded-lg transition duration-200 bg-white/20 hover:bg-white/30 hover:scale-[1.03]">
                            Kelola
                        </a>
                    @endif
                    @if(Auth::guard('admin')->check())
                        <a href="{{ route('admin.reports.index') }}" 
                           class="text-white font-semibold text-sm px-3 py-1 rounded-lg transition duration-200 bg-white/20 hover:bg-white/30 hover:scale-[1.03]">
                            Laporan
                        </a>
                    @endif
                </nav>


                {{-- Tombol Aksi (Rata Kanan) --}}
                <div class="flex items-center space-x-4">
                    @if (!Auth::guard('admin')->check() && !Auth::guard('dosen')->check() && !Auth::guard('mahasiswa')->check())
                        <a href="{{ route('login') }}"
                           class="px-5 py-2 text-base font-semibold login-btn-custom rounded-xl shadow-md transition duration-200 flex items-center space-x-2"
                           title="Login">
                            <iconify-icon icon="mdi:user" width="18"></iconify-icon>
                            <span>Login</span>
                        </a>
                    @else
                        {{-- DIUBAH: Menambahkan inline-block untuk memastikan link mematuhi padding vertikal --}}
                        <a href="{{ route('profile') }}"
                            class="text-white hover:text-gray-200 transition duration-200 px-4 py-2 rounded-lg text-sm font-medium inline-block"
                            title="My Profile">
                            Profile
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600/70 rounded-lg hover:bg-red-600 transition duration-200 shadow-md"
                                title="Logout">
                                Logout
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </header>

    {{-- =================== MAIN CONTENT =================== --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- =================== FOOTER =================== --}}
    <footer class="footer-bg-custom text-white mt-auto w-full">
        <div class="container mx-auto px-10 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 justify-between items-start">

                {{-- Kiri: Logo & Kontak Paling Bawah --}}
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        {{-- Ganti Ikon di Footer dengan Gambar Logo Anda (Opsional) --}}
                        <img src="{{ asset('images/pesawat.png') }}" alt="AsMa Logo" class="h-12 w-auto mt-0 mr-0">

                        <div class="flex flex-col leading-none">
                            <span class="text-3xl logo-text font-extrabold tracking-tight">
                                <span class="text-white-p">As</span>
                                <span class="text-purple-p">Ma</span>
                            </span>
                            <span class="text-xs uppercase font-medium mt-1 opacity-70">
                                Politeknik Negeri Lhokseumawe
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Kontak Kami --}}
                <div class="md:text-right space-y-3">
                    <h4 class="text-xl font-bold text-white mb-3 opacity-100">Kontak Kami</h4>
                    
                    <div class="space-y-2 text-sm opacity-80 md:text-right text-left">
                        <div class="flex items-center md:justify-end">
                            <iconify-icon icon="mdi:phone" width="16" class="mr-2"></iconify-icon>
                            <p class="opacity-70">+62 822-7296-7078</p>
                        </div>
                        <div class="flex items-start md:justify-end">
                            <iconify-icon icon="mdi:map-marker" width="16" class="mr-2 mt-1 flex-shrink-0"></iconify-icon>
                            <p class="opacity-70 md:max-w-xs">Jln Medan-Banda Aceh Km 260 (Km 280.3) Buketrata, Kecamatan Blang Mangat, Kota Lhokseumawe, Provinsi Aceh.</p>
                        </div>
                        <div class="flex items-center md:justify-end">
                            <iconify-icon icon="mdi:email" width="16" class="mr-2"></iconify-icon>
                            <p class="opacity-70 font-semibold">poltek@pnl.ac.id</p>
                        </div>
                    </div>
                </div>

            </div>
            
            {{-- Elemen Copyright Diletakkan Paling Bawah Footer --}}
            <div class="w-full h-0.5 bg-white/20 my-8"></div> 
            
            <p class="text-xs opacity-70 text-center transition duration-200 copyright-interactive">
                <a href="#" class="inline-block">
                     &copy; 2025 Our Website - Aspirasi Mahasiswa. All rights reserved.
                </a>
            </p>

        </div>
    </footer>

</body>
</html>