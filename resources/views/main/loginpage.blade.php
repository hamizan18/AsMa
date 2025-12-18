@extends('layouts.app')

@section('content')

<title>Pilih Status Anda</title>

<style>
    /* 1. Latar Belakang Gradien Utama */
    /* Kami menerapkan ini pada container wrapper untuk memastikan isolasi */
    .bg-custom-gradient {
        background: linear-gradient(135deg, #3a2a50 0%, #291d38 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px 0;
    }
    
    /* Hapus padding/margin dari body jika menggunakan layout app, atau pastikan body/html tidak memiliki margin default */
    body {
        margin: 0;
        padding: 0;
    }
    
    .selection-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        width: 100%;
        max-width: 900px;
    }

    /* Judul */
    .selection-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 50px;
        color: #e0e0e0; /* Warna teks lebih terang */
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }
    
    /* 2. Grid Seleksi Peran */
    .role-selection-grid {
        display: flex;
        gap: 30px; 
        justify-content: center;
        flex-wrap: wrap; /* Agar responsif di layar kecil */
    }
    
    /* 3. Kartu Interaktif (role-card) */
    .role-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        width: 250px; 
        height: 250px; 
        border-radius: 15px;
        text-decoration: none; 
        color: #ffffff; 
        
        /* Background kartu: warna abu-ungu transparan seperti gambar */
        background-color: rgba(130, 110, 150, 0.5); 
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); 
        border: 2px solid transparent; 
        
        /* Transisi untuk interaktivitas halus */
        transition: all 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);
        cursor: pointer;
    }
    
    /* Efek Hover */
    .role-card:hover {
        /* Bergerak ke atas dan skala sedikit */
        transform: translateY(-10px) scale(1.05); 
        
        /* Border ungu muda/putih sebagai highlight */
        border: 2px solid #a394c7; 
        
        /* Shadow yang lebih dramatis */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6), 0 0 20px rgba(163, 148, 199, 0.5); 
    }
    
    .role-image {
        width: 200px; /* Ukuran gambar ilustrasi */
        height: 200px;
        object-fit: contain;
    }
    
    .role-text {
        font-size: 1.4rem;
        font-weight: 600;
        letter-spacing: 0px;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
    }
    
    /* Tombol Kembali */
    .back-button {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px 18px;
        border-radius: 25px;
        background-color: rgba(255, 255, 255, 0.15); 
        color: #e0e0e0;
        text-decoration: none;
        font-size: 1rem;
        margin-top: 50px;
        transition: background-color 0.2s;
    }
    
    .back-button:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }
</style>

    <div class="selection-page-wrapper bg-custom-gradient">
        <div class="selection-container">
            
            <h1 class="selection-title">Pilih Status Kamu</h1>
    
            <div class="role-selection-grid">
    
                <a href="{{ route('login-adm') }}" class="role-card">
                    <img src="{{ asset('images/admin.png') }}" alt="Ilustrasi Admin" class="role-image">
                    <span class="role-text">Admin</span>
                </a>
    
                <a href="{{ route('login-mhs') }}" class="role-card">
                    <img src="{{ asset('images/mhs.png') }}" alt="Ilustrasi Mahasiswa" class="role-image">
                    <span class="role-text">Mahasiswa</span>
                </a>
    
                <a href="{{ route('login-dosen') }}" class="role-card">
                    <img src="{{ asset('images/dosen.png') }}" alt="Ilustrasi Dosen" class="role-image">
                    <span class="role-text">Dosen</span>
                </a>
    
            </div>
            
            <a href="javascript:history.back()" class="back-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px; margin-right: 5px;">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                back
            </a>
    
        </div>
    </div>
    
    @endsection