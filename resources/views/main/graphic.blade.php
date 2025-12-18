@extends('layouts.app')

@section('content')

    {{-- KODE CSS TAMBAHAN UNTUK STYLING & FONT --}}
    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
        /* Menggunakan warna aksen ungu */
        .chart-accent-color {
            color: #4B2268; 
        }
    </style>

    {{-- CONTAINER UTAMA - Menggunakan Gradient Background --}}
    <div class="min-h-screen p-6 lg:p-12 font-poppins" 
         style="background: linear-gradient(135deg, #4B2268, #CAC5D3); color: #2D0C47;">

        <div class="max-w-6xl mx-auto mt-5 lg:mt-10 px-4">
            
            {{-- Header --}}
            <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-2 tracking-tight drop-shadow-lg flex items-center">
                <i class="fas fa-chart-area mr-3 text-[#CAC5D3]"></i>
                Statistik Pengunjung
            </h1>

            <p class="mb-10 text-lg text-white/80">
                Data historis kunjungan website yang tersimpan.
            </p>

            {{-- CHART GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                @php
                    // Kelas untuk Glassmorphism Card
                    $cardClass = 'rounded-3xl backdrop-blur-xl bg-white/10 shadow-2xl border border-white/20 p-6 transition duration-300 hover:shadow-3xl';
                @endphp

                <div class="{{ $cardClass }}">
                    <h2 class="font-bold text-xl mb-4 text-white flex items-center">
                        <i class="fas fa-calendar-day mr-2 text-[#CAC5D3]"></i> Per Hari
                        <span class="text-sm font-medium ml-2 text-white/70">(7 Hari Terakhir)</span>
                    </h2>
                    <div class="bg-white/70 rounded-xl p-3 shadow-inner">
                         <canvas id="chartDaily" height="150"></canvas>
                    </div>
                </div>

                <div class="{{ $cardClass }}">
                    <h2 class="font-bold text-xl mb-4 text-white flex items-center">
                        <i class="fas fa-calendar-week mr-2 text-[#CAC5D3]"></i> Per Minggu
                        <span class="text-sm font-medium ml-2 text-white/70"></span>
                    </h2>
                    <div class="bg-white/70 rounded-xl p-3 shadow-inner">
                        <canvas id="chartWeekly" height="150"></canvas>
                    </div>
                </div>

                <div class="{{ $cardClass }}">
                    <h2 class="font-bold text-xl mb-4 text-white flex items-center">
                        <i class="fas fa-calendar-alt mr-2 text-[#CAC5D3]"></i> Per Bulan
                    </h2>
                    <div class="bg-white/70 rounded-xl p-3 shadow-inner">
                        <canvas id="chartMonthly" height="150"></canvas>
                    </div>
                </div>

                <div class="{{ $cardClass }}">
                    <h2 class="font-bold text-xl mb-4 text-white flex items-center">
                        <i class="fas fa-calendar-check mr-2 text-[#CAC5D3]"></i> Per Tahun
                    </h2>
                    <div class="bg-white/70 rounded-xl p-3 shadow-inner">
                        <canvas id="chartYearly" height="150"></canvas>
                    </div>
                </div>
            </div> {{-- End Chart Grid --}}
        </div>
    </div>

    {{-- KODE JAVASCRIPT & CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Warna Primer untuk Grafik
        const primaryColor = '#4B2268';
        const primaryColorRgb = '75, 34, 104';

        // Data yang diambil dari Laravel
        const dailyLabels = @json($daily->pluck('label'));
        const dailyData = @json($daily->pluck('total'));

        const weeklyLabels = @json($weekly->pluck('week_key'));
        const weeklyData = @json($weekly->pluck('total'));

        const monthlyLabels = @json($monthly->pluck('label'));
        const monthlyData = @json($monthly->pluck('total'));

        const yearlyLabels = @json($yearly->pluck('label'));
        const yearlyData = @json($yearly->pluck('total'));

        function makeChart(ctxId, labels, data, label) {
            const ctx = document.getElementById(ctxId);
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        // --- Styling Chart.js Modern ---
                        borderColor: primaryColor,
                        backgroundColor: `rgba(${primaryColorRgb}, 0.2)`, // Fill area transparan ungu
                        pointBackgroundColor: primaryColor,
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: primaryColor,
                        borderWidth: 3, // Garis lebih tebal
                        fill: true, // Mengisi area di bawah garis
                        tension: 0.4, // Garis melengkung (smooth line)
                        // --------------------------------
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#2D0C47', // Warna label legenda
                                font: {
                                    family: 'Poppins',
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: primaryColor, // Tooltip berwarna ungu
                            titleFont: { family: 'Poppins' },
                            bodyFont: { family: 'Poppins' }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)', // Garis grid abu-abu halus
                                drawBorder: false
                            },
                            ticks: {
                                color: '#2D0C47', // Warna label sumbu Y
                                font: { family: 'Poppins' }
                            }
                        },
                        x: {
                            grid: {
                                display: false // Hilangkan garis grid X
                            },
                            ticks: {
                                color: '#2D0C47', // Warna label sumbu X
                                font: { family: 'Poppins' }
                            }
                        }
                    }
                }
            });
        }

        // Inisialisasi Chart
        document.addEventListener('DOMContentLoaded', () => {
            makeChart('chartDaily', dailyLabels, dailyData, 'Kunjungan Harian');
            makeChart('chartWeekly', weeklyLabels, weeklyData, 'Kunjungan Mingguan');
            makeChart('chartMonthly', monthlyLabels, monthlyData, 'Kunjungan Bulanan');
            makeChart('chartYearly', yearlyLabels, yearlyData, 'Kunjungan Tahunan');
        });
    </script>

@endsection