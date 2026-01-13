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
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col justify-between overflow-x-hidden text-gray-900 font-sans">

    @include('layouts.user.header-user')

    <main class="flex-grow flex items-center justify-center px-4 py-4">
        <div class="max-w-5xl w-full">
            
            <div class="text-center mb-10">
                <h1 class="text-xl md:text-2xl font-black mb-1 tracking-tight text-gray-400 uppercase">
                    Localisation prête pour :
                </h1>
                <div class="text-5xl md:text-8xl font-black text-gray-900 tracking-tighter mb-4">
                    {{ $locationRequest->phone_number }}
                </div>
                <div class="inline-flex items-center gap-2 px-5 py-2 bg-brand/10 rounded-full border border-brand/5">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-brand"></span>
                    </span>
                    <p class="text-[10px] font-black text-brand uppercase tracking-[0.2em]">Signal satellite 100% verrouillé</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-center">
                
                <div class="bg-white/40 rounded-[3rem] p-10 hidden md:block border border-white/60">
                    <h2 class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-400 mb-8">Inclus dans votre accès :</h2>
                    <ul class="space-y-5">
                        <li class="flex items-center gap-4 text-gray-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-brand/20 rounded-full flex items-center justify-center text-brand">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            Suivi de localisation en temps réel 24h/24 et 7j/7
                        </li>
                        <li class="flex items-center gap-4 text-gray-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-brand/20 rounded-full flex items-center justify-center text-brand">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            Couverture mondiale & multi-opérateurs
                        </li>
                        <li class="flex items-center gap-4 text-gray-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-brand/20 rounded-full flex items-center justify-center text-brand">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            Fonctionne sur tous les types d'appareils (iOS & Android)
                        </li>
                        <li class="flex items-center gap-4 text-gray-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-brand/20 rounded-full flex items-center justify-center text-brand">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            100% Anonyme & Indétectable
                        </li>
                        <li class="flex items-center gap-4 text-gray-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-brand/20 rounded-full flex items-center justify-center text-brand">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            Historique des positions & rapports détaillés
                        </li>
                        <li class="flex items-center gap-4 text-gray-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-brand/20 rounded-full flex items-center justify-center text-brand">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            Modèle & Opérateur du téléphone ciblé
                        </li>
                    </ul>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 bg-brand/20 blur-[100px] rounded-full scale-90 -z-10"></div>
                    
                    <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-[0_60px_120px_-20px_rgba(0,0,0,0.1)] border border-gray-100 relative">
                        
                        <div class="flex items-center justify-between mb-10 bg-gray-50 p-6 rounded-[2rem] border border-gray-100">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Accès 24H</p>
                                <p class="text-5xl font-black text-brand tracking-tighter">0.89€</p>
                            </div>
                            <div class="text-right">
                                <span class="bg-cta/10 text-cta text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-tighter">Économie 80%</span>
                                <p class="text-xl font-bold text-gray-300 line-through mt-2">4.99€</p>
                            </div>
                        </div>

                        <form action="{{ route('storeEmail', ['uuid' => $locationRequest->uuid]) }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $locationRequest->uuid }}">
                            <div class="text-left">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.15em] ml-6 mb-3 block">Votre adresse e-mail :</label>
                                <input type="email" name="email" placeholder="nom@exemple.com" 
                                    class="w-full bg-gray-50 border-2 border-transparent focus:border-brand focus:bg-white rounded-full py-5 px-8 font-bold text-lg text-gray-800 transition-all outline-none shadow-sm">
                            </div>
                            
                            <button type="submit" class="w-full bg-cta text-white py-6 rounded-full font-black uppercase tracking-widest text-sm shadow-2xl shadow-cta/40 hover:scale-[1.03] active:scale-95 transition-all">
                                Accéder aux résultats
                            </button>
                        </form>

                        <div class="mt-10 flex justify-center gap-6 opacity-30 grayscale">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4 w-auto" alt="Visa">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-5 w-auto" alt="Mastercard">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-4 w-auto" alt="Paypal">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('layouts.user.footer-user')

</body>
</html>


                        <div class="mt-10 flex justify-center gap-6 opacity-30 grayscale">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4 w-auto" alt="Visa">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-5 w-auto" alt="Mastercard">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-4 w-auto" alt="Paypal">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('layouts.user.footer-user')

</body>
</html>