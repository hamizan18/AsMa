@extends('layouts.app')

{{-- ASUMSI: Anda telah memasukkan Font Awesome/Iconify di layout untuk ikon yang sebenarnya --}}

@section('content')

    {{-- Container Penuh dengan Background Gradient yang Elegan --}}
    <div class="min-h-screen flex items-center justify-center p-6 lg:p-12 
         font-poppins" {{-- Asumsikan 'font-poppins' sudah terdefinisi --}}
         style="background: linear-gradient(135deg, #3f2155, #aa9fbe); color: #2D0C47;">
        
        {{-- Glass Card: Lebih Besar, Lebih Transparan, dan Bersinar --}}
        <div class="w-full max-w-xl p-8 lg:p-10 rounded-[32px] backdrop-blur-xl bg-white/10 
                    shadow-3xl border border-white/20 saturate-150 transition-all duration-500 
                    hover:shadow-4xl">
            
            {{-- Title: Lebih Berani dengan Ikon Asli --}}
            <h1 class="text-4xl font-extrabold text-white mb-8 flex items-center tracking-tight">
                {{-- Iconify: Pen icon (fa-pencil-alt atau sejenisnya) --}}
                <i class="fas fa-pencil-alt text-[#CAC5D3] mr-3" aria-hidden="true"></i> 
                Buat Pengaduan Baru
            </h1>

            {{-- Success Notification --}}
            @if(session('success'))
                <div class="p-4 mb-6 text-sm text-green-100 bg-green-500/50 backdrop-blur-sm rounded-xl border border-green-300" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form Wrapper --}}
            @if(auth()->guard('mahasiswa')->check())
                <form action=" {{ route('aspiration.store') }} " method="POST" class="space-y-6">
                    @csrf

                    {{-- Kategori Dropdown --}}
                    <div>
                        <label for="category" class="input-label text-sm font-semibold text-white/80 mb-2 block">Pilih Kategori</label>
                        <div class="relative">
                            <select name="category" id="category" required
                                    class="w-full py-3 pl-5 pr-12 rounded-xl bg-white/90 text-[#4B2268] font-medium border-none shadow-lg 
                                           focus:outline-none focus:ring-4 focus:ring-[#CAC5D3]/60 focus:bg-white transition duration-300 appearance-none">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="fasilitas" {{ old('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                <option value="curhatan" {{ old('category') == 'curhatan' ? 'selected' : '' }}>Curhatan</option>
                                <option value="kampus" {{ old('category') == 'kampus' ? 'selected' : '' }}>Kampus</option>
                                <option value="akademik" {{ old('category') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                            </select>
                            {{-- Iconify: Search/Chevron Down --}}
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-[#4B2268] text-lg pointer-events-none" aria-hidden="true"></i>
                        </div>
                    </div>

                    {{-- Judul Aspirasi --}}
                    <div>
                        <label for="title" class="input-label text-sm font-semibold text-white/80 mb-2 flex items-center">
                            {{-- Iconify: Clipboard-check icon --}}
                            <i class="fas fa-clipboard-check text-[#CAC5D3] mr-2" aria-hidden="true"></i>
                            Judul Aspirasi
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required maxlength="150"
                               class="w-full p-4 rounded-xl bg-white/90 shadow-lg border-none 
                                      text-[#2D0C47] font-normal placeholder:text-[#4B2268]/60 
                                      focus:outline-none focus:ring-4 focus:ring-[#CAC5D3]/60 focus:bg-white transition duration-300"
                               placeholder="Masukkan Judul Aspirasi yang jelas">
                    </div>

                    {{-- Isi Aspirasi (Textarea) --}}
                    <div>
                        <label for="content" class="input-label text-sm font-semibold text-white/80 mb-2 flex items-center">
                            {{-- Iconify: Clipboard-text icon --}}
                            <i class="fas fa-file-alt text-[#CAC5D3] mr-2" aria-hidden="true"></i>
                            Isi Aspirasi
                        </label>
                        <textarea name="content" id="content" rows="7" required maxlength="2000"
                                  class="w-full p-5 rounded-2xl bg-white/90 shadow-lg border-none resize-y 
                                         text-[#2D0C47] font-normal placeholder:text-[#4B2268]/60
                                         focus:outline-none focus:ring-4 focus:ring-[#CAC5D3]/60 focus:bg-white transition duration-300"
                                  placeholder="Jelaskan aspirasi, masalah, atau ide Anda secara terperinci.">{{ old('content') }}</textarea>
                    </div>

                    {{-- Kirim sebagai Anonim Checkbox (Modern) --}}
                    <div class="flex items-center pt-2 pb-4">
                        <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : ''}}
                               class="h-5 w-5 rounded-md border-2 border-white/70 text-[#4B2268] bg-transparent cursor-pointer 
                                      focus:ring-2 focus:ring-offset-0 focus:ring-[#CAC5D3] checked:bg-[#4B2268] checked:border-0 
                                      transition duration-200">
                        <label for="is_anonymous" class="ml-3 text-sm font-medium text-white/90 cursor-pointer">
                            Kirim sebagai Anonim
                        </label>
                    </div>

                    {{-- Tombol Aksi (Dual Tone, Glowing, Group Hover) --}}
                    <div class="flex space-x-5 pt-4">
                        
                        {{-- Primary Button: Kirim Pengaduan --}}
                        <button type="submit"
                                class="btn-primary group flex-1 py-3 px-4 rounded-2xl font-semibold text-white bg-[#2D0C47] 
                                       shadow-xl shadow-[#2D0C47]/50 border-2 border-transparent 
                                       hover:bg-[#4B2268] hover:shadow-2xl hover:shadow-[#4B2268]/70 
                                       transition duration-300 transform hover:-translate-y-1">
                            
                            <span class="flex items-center justify-center">
                                {{-- Iconify: Send icon --}}
                                <i class="fas fa-paper-plane mr-2 text-lg group-hover:animate-pulse" aria-hidden="true"></i>
                                Kirim Pengaduan
                            </span>
                        </button>
                        
                        {{-- Secondary Button: Batal --}}
                        <a href="{{ url()->previous() }}"
                            class="btn-secondary group flex-1 py-3 px-4 rounded-2xl text-[#4B2268] bg-white/80 border border-[#4B2268]/30 
                                   text-center font-semibold hover:bg-white hover:border-[#2D0C47] shadow-md 
                                   transition duration-300 flex items-center justify-center">
                            
                            Batal
                            {{-- Iconify: X icon --}}
                            <i class="fas fa-times ml-2 text-lg group-hover:scale-110 transition duration-300" aria-hidden="true"></i>
                        </a>
                    </div>

                </form>
            @endif
        </div>
    </div>
@endsection