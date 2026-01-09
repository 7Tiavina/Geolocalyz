<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace Client - Geolocalyz</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        brand: '#33d7bb', // Vert Pétrole
                        cta: '#ff6b3d' // Orange CTA
                    }
                }
            }
        }
    </script>
    <style>
        /* Styles personnalisés si besoin, par exemple pour le SVG du profil */
        .svg-icon {
            fill: currentColor;
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col justify-between text-gray-900 font-sans">

    <header class="w-full px-6 py-4 border-b border-gray-100">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="transition-transform hover:scale-105">
          <img src="{{ asset('assets/images/logo-principal.png') }}" alt="Logo Geolocalyz" class="h-6 w-auto">
        </a>
        <nav class="flex items-center gap-6">
            <a href="#" class="text-[10px] font-black text-gray-500 hover:text-brand transition-colors uppercase tracking-widest">Aide</a>
            <a href="{{ route('loginUser') }}" class="text-[10px] font-black text-gray-500 hover:text-brand transition-colors uppercase tracking-widest">Déconnexion</a>
        </nav>
      </div>
    </header>

    <main class="flex-grow flex flex-col items-center py-12 px-4">
        <div class="max-w-4xl w-full">
            
            <div class="mb-12 text-center">
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight mb-2">
                    Bonjour, <span class="text-brand">Edzar !</span>
                </h1>
                <p class="text-gray-500 text-sm font-medium">Bienvenue sur votre tableau de bord Geolocalyz.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                
                <div class="md:col-span-1 bg-white rounded-[2rem] p-8 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] border border-gray-100 text-center flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-brand/10 flex items-center justify-center mb-4 border-2 border-brand/20">
                        <svg class="w-12 h-12 text-brand" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4a4 4 0 100 8 4 4 0 000-8zM6 14a6 6 0 006 6 6 6 0 006-6v-1a4 4 0 00-4-4H8a4 4 0 00-4 4v1z"/></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-1">Edzar Test</h2>
                    <p class="text-sm text-gray-500 mb-6">edzar@gmail.com</p>

                    <a href="#" class="inline-block bg-brand/10 text-brand text-xs font-bold px-5 py-2 rounded-full hover:bg-brand hover:text-white transition-all">
                        Modifier le profil
                    </a>
                </div>

                <div class="md:col-span-2 space-y-8">
                    
                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-gray-800">Votre abonnement actuel</h2>
                            <span class="bg-brand text-white text-[9px] font-black px-4 py-1 rounded-full uppercase tracking-widest">Actif</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">
                            Abonnement mensuel Geolocalyz - **49.80€ / mois**.
                            Prochain renouvellement le <span class="font-bold text-gray-800">15 Mars 2026</span>.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 mt-4">
                            <a href="#" class="bg-cta text-white text-xs font-bold px-6 py-3 rounded-full hover:brightness-110 transition-all text-center">
                                Gérer l'abonnement
                            </a>
                            <a href="#" class="bg-gray-100 text-gray-600 text-xs font-bold px-6 py-3 rounded-full hover:bg-gray-200 transition-all text-center">
                                Historique de facturation
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] border border-gray-100">
                        <h2 class="text-lg font-bold text-gray-800 mb-6">Vos dernières localisations</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-semibold text-gray-700">+230 5519 3628</p>
                                <a href="{{ route('accessLocalisation') }}" class="bg-brand/10 text-brand text-[10px] font-bold px-4 py-1 rounded-full hover:bg-brand hover:text-white transition-all uppercase">
                                    Voir la carte
                                </a>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm font-semibold text-gray-700">+33 6 12 34 56 78</p>
                                <a href="{{ route('accessLocalisation') }}" class="bg-brand/10 text-brand text-[10px] font-bold px-4 py-1 rounded-full hover:bg-brand hover:text-white transition-all uppercase">
                                    Voir la carte
                                </a>
                            </div>
                            <p class="text-right text-xs text-gray-400 mt-4">
                                <a href="#" class="hover:text-brand transition-colors">Voir toutes les localisations →</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <footer class="w-full py-8 px-6 border-t border-gray-100 mt-12">
      <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6 opacity-60">
        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">&copy; 2026 GEOLOCALYZ.COM ALL RIGHTS RESERVED.</p>
        <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2">
          <a href="#" class="text-[9px] font-black text-gray-400 hover:text-brand uppercase tracking-widest">Conditions Générales</a>
          <a href="#" class="text-[9px] font-black text-gray-400 hover:text-brand uppercase tracking-widest">Politique de Confidentialité</a>
          <a href="#" class="text-[9px] font-black text-gray-400 hover:text-brand uppercase tracking-widest">Contact</a>
        </nav>
      </div>
    </footer>

</body>
</html>