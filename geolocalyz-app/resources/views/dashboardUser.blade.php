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
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-[10px] font-black text-gray-500 hover:text-brand transition-colors uppercase tracking-widest">Déconnexion</button>
            </form>
        </nav>
      </div>
    </header>

    <main class="flex-grow flex flex-col items-center py-12 px-4">
        <div class="max-w-4xl w-full">
            
            <div class="mb-12 text-center">
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight mb-2">
                    Bonjour, <span class="text-brand">{{ Auth::user()->name }} !</span>
                </h1>
                <p class="text-gray-500 text-sm font-medium">Bienvenue sur votre tableau de bord Geolocalyz.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] border border-gray-100 text-center flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full bg-brand/10 flex items-center justify-center mb-4 border-2 border-brand/20">
                            <svg class="w-12 h-12 text-brand" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4a4 4 0 100 8 4 4 0 000-8zM6 14a6 6 0 006 6 6 6 0 006-6v-1a4 4 0 00-4-4H8a4 4 0 00-4 4v1z"/></svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ Auth::user()->name }}</h2>
                        <p class="text-sm text-gray-500 mb-6">{{ Auth::user()->email }}</p>

                        <a href="#" class="inline-block bg-brand/10 text-brand text-xs font-bold px-5 py-2 rounded-full hover:bg-brand hover:text-white transition-all">
                            Modifier le profil
                        </a>
                    </div>

                    <div class="bg-white rounded-[2rem] p-6 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] border border-gray-100">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 text-center">Crédits disponibles</p>
                        <div class="flex items-center justify-center gap-2 mb-4">
                            <span class="text-3xl font-black text-gray-900">12</span>
                            <div class="bg-brand/10 p-1 rounded-md">
                                <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                        <button class="w-full bg-gray-50 text-gray-600 text-[10px] font-black py-3 rounded-xl border border-gray-100 hover:bg-brand hover:text-white hover:border-brand transition-all uppercase tracking-widest">
                            Acheter des crédits
                        </button>
                    </div>
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
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                            <h2 class="text-lg font-bold text-gray-800">Vos localisations</h2>
                            <a href="" class="w-full sm:w-auto bg-brand text-white text-[10px] font-black px-6 py-3 rounded-full hover:shadow-lg hover:shadow-brand/30 transition-all uppercase tracking-widest text-center">
                                + Nouvelle localisation
                            </a>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse ($locationRequests as $request)
                                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <p class="text-sm font-semibold text-gray-700">{{ $request->phone_number }}</p>
                                    @if ($request->latitude !== null)
                                        <a href="{{ route('accessLocalisation.show', ['uuid' => $request->uuid]) }}" class="bg-brand/10 text-brand text-[10px] font-bold px-4 py-1 rounded-full hover:bg-brand hover:text-white transition-all uppercase">
                                            Voir la carte
                                        </a>
                                    @else
                                        <span class="bg-gray-100 text-gray-400 text-[10px] font-bold px-4 py-1 rounded-full uppercase cursor-not-allowed">
                                            En attente...
                                        </span>
                                    @endif
                                </div>
                            @empty
                                <p class="text-center text-sm text-gray-500 py-8">Vous n'avez aucune demande de localisation pour le moment.</p>
                            @endforelse
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