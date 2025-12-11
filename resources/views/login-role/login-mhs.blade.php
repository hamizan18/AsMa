<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa | As Ma</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
            overflow: hidden; 
        }
        
        .font-handwriting {
            font-family: 'Brush Script MT', 'cursive'; 
        }

        .bg-full-gradient {
            background: linear-gradient(135deg, #1f142a 0%, #3a2a50 100%);
        }
        
        /* Menyesuaikan padding input karena ikon mata akan berada di kanan */
        .input-icon {
            padding-left: 3.5rem; 
        }
    </style>
</head>
<body>

<div class="bg-full-gradient min-h-screen flex justify-center items-center p-4">
    
    <div class="login-container 
                flex 
                flex-col md:flex-row 
                w-full 
                max-w-4xl 
                bg-white/10 
                backdrop-blur-md 
                rounded-3xl 
                shadow-2xl 
                overflow-hidden 
                border border-white/20">

        <div class="welcome-section 
                    flex 
                    flex-col 
                    items-center 
                    justify-center 
                    p-8 md:p-12 
                    text-white 
                    md:w-1/2 
                    text-center"
             style="background: linear-gradient(180deg, rgba(124, 77, 255, 0.8) 0%, #7c4dff 100%);">
            
            <h2 class="text-6xl md:text-7xl font-handwriting tracking-wide mb-4">
                Welcome
            </h2>
            <p class="text-xl font-light opacity-80 mb-8">
                Let's sign it!
            </p>

            <img src="{{ asset('images/koala.png') }}" alt="Cacing Wisuda AsMa"  class="w-48 h-48 md:w-80 md:h-80 object-contain mb-8">
        </div>

        <div class="signin-section 
                    flex 
                    flex-col 
                    justify-center 
                    p-8 md:p-12 
                    md:w-1/2">

            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-10 text-center">
                Sign In
            </h2>

            <form method="POST" action="{{ route('login-mhs') }}" class="space-y-6">
                @csrf
                <div class="relative">
                    <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <input type="text" 
                           placeholder="2024573010015" 
                           class="w-full input-icon 
                                  py-3 pr-6 
                                  rounded-full 
                                  text-gray-900 
                                  bg-yellow-100 
                                  focus:outline-none focus:ring-4 focus:ring-purple-400/50 
                                  transition duration-300">
                </div>

                <div class="relative">
                    <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                    </span>
                    
                    <input type="password" 
                        id="passwordInput"
                        name="password"
                        placeholder="••••••••" 
                        class="w-full input-icon 
                                py-3 pr-12 
                                rounded-full 
                                text-gray-900 
                                bg-yellow-100 
                                focus:outline-none focus:ring-4 focus:ring-purple-400/50 
                                transition duration-300">

                                  
                    <button type="button" 
                            id="togglePassword" 
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 p-1 text-gray-500 hover:text-purple-600 transition duration-150">
                        <svg id="eyeOpen" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        
                        <svg id="eyeClosed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.057 10.057 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7h.001c.78 0 1.543.14 2.26.417M19.431 15.656A9.943 9.943 0 0022 12c-1.274-4.057-5.064-7-9.542-7-.78 0-1.543.14-2.26.417M20 7L4 23"></path></svg>
                    </button>
                </div>
                
                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center text-white/80 text-sm cursor-pointer">
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-purple-600 rounded border-gray-300 bg-white/30 focus:ring-purple-500 mr-2">
                        Remember me
                    </label>
                    
                    </div>

                <button type="submit" 
                        class="w-full 
                               py-3 
                               mt-10 
                               rounded-full 
                               text-lg font-bold 
                               text-white 
                               bg-gray-700 hover:bg-gray-800 
                               focus:outline-none focus:ring-4 focus:ring-gray-600/50 
                               transition duration-300">
                    LOG IN
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleButton = document.getElementById('togglePassword');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        if (toggleButton) {
            toggleButton.addEventListener('click', function() {
                // Periksa tipe input saat ini
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                
                // Ubah tipe input
                passwordInput.setAttribute('type', type);
                
                // Ganti ikon mata
                if (type === 'text') {
                    eyeOpen.classList.remove('hidden');
                    eyeClosed.classList.add('hidden');
                } else {
                    eyeOpen.classList.add('hidden');
                    eyeClosed.classList.remove('hidden');
                }
            });
        }
    });
</script>

</body>
</html>