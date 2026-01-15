<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geolocalyz – Localiser un téléphone</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        brand: '#33d7bb',
                        cta: '#ff6b3d' 
                    }
                }
            }
        }
    </script>
    <style>
        .form-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hidden-form {
            display: none;
            opacity: 0;
            transform: scale(0.95);
        }
        #tab-cursor {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col justify-between overflow-x-hidden text-gray-900 font-sans">

    @include('layouts.user.header-user')

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full relative">
            
            <div class="absolute inset-0 bg-brand/20 blur-[100px] rounded-full scale-110 -z-10"></div>

            <div class="bg-white rounded-[3rem] p-4 shadow-[0_50px_100px_-20px_rgba(0,0,0,0.08)] border border-gray-100 relative">
                
                <div class="relative bg-gray-50 rounded-full p-1.5 flex mb-8 overflow-hidden">
                    <div id="tab-cursor" class="absolute top-1.5 left-1.5 bottom-1.5 w-[calc(50%-6px)] bg-white rounded-full shadow-sm"></div>
                    
                    <button onclick="switchTo('login')" id="btn-login" class="relative z-10 w-1/2 py-3 text-[10px] font-black uppercase tracking-widest transition-colors text-gray-900">
                        Connexion
                    </button>
                    <button onclick="switchTo('register')" id="btn-register" class="relative z-10 w-1/2 py-3 text-[10px] font-black uppercase tracking-widest transition-colors text-gray-400">
                        Créer un compte
                    </button>
                </div>

                <div class="px-6 pb-8">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="login-form" class="form-transition">
                        <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="email" name="email" placeholder="E-MAIL" value="{{ old('email') }}"
                                class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none transition-all shadow-sm">
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            
                            <div class="relative">
                                <input type="password" name="password" id="login-pass" placeholder="MOT DE PASSE" 
                                    class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none transition-all shadow-sm">
                                <button type="button" onclick="togglePass('login-pass')" class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            
                            <button type="submit" class="w-full bg-brand text-white py-5 rounded-full font-black uppercase tracking-widest text-xs shadow-xl shadow-brand/30 hover:scale-[1.02] active:scale-95 transition-all mt-2">
                                Se connecter
                            </button>
                        </form>
                    </div>

                    <div id="register-form" class="form-transition hidden-form">
                        <form action="{{ route('accessDashboard') }}" method="GET" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-2 gap-3">
                                <input type="text" placeholder="PRÉNOM" class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-6 font-bold text-xs outline-none shadow-sm uppercase">
                                <input type="text" placeholder="NOM" class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-6 font-bold text-xs outline-none shadow-sm uppercase">
                            </div>
                            
                            <input type="email" placeholder="E-MAIL" class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none shadow-sm">
                            
                            <div class="relative">
                                <input type="password" id="reg-pass" placeholder="MOT DE PASSE" class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none shadow-sm">
                                <button type="button" onclick="togglePass('reg-pass')" class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </div>

                            <div class="relative">
                                <input type="password" id="reg-pass-confirm" placeholder="CONFIRMER MOT DE PASSE" class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none shadow-sm">
                                <button type="button" onclick="togglePass('reg-pass-confirm')" class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </div>
                            
                            <button type="submit" class="w-full bg-cta text-white py-5 rounded-full font-black uppercase tracking-widest text-xs shadow-xl shadow-cta/30 hover:scale-[1.02] active:scale-95 transition-all mt-2">
                                Créer mon compte
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('layouts.user.footer-user')

    <script>
        // Fonction pour voir/cacher le mot de passe
        function togglePass(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        // Fonction pour changer d'onglet
        function switchTo(type) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const cursor = document.getElementById('tab-cursor');
            const btnLogin = document.getElementById('btn-login');
            const btnRegister = document.getElementById('btn-register');

            if (type === 'register') {
                cursor.style.transform = 'translateX(100%)';
                btnRegister.classList.replace('text-gray-400', 'text-gray-900');
                btnLogin.classList.replace('text-gray-900', 'text-gray-400');
                loginForm.classList.add('hidden-form');
                registerForm.classList.remove('hidden-form');
            } else {
                cursor.style.transform = 'translateX(0)';
                btnLogin.classList.replace('text-gray-400', 'text-gray-900');
                btnRegister.classList.replace('text-gray-900', 'text-gray-400');
                registerForm.classList.add('hidden-form');
                loginForm.classList.remove('hidden-form');
            }
        }
    </script>

</body>
</html>