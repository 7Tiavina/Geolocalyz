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
<body class="bg-[#f8fafc] min-h-screen flex flex-col justify-between text-gray-900 font-sans">

    @include('layouts.user.header-user')

    <main class="flex-grow flex flex-col items-center justify-center px-4 py-8">
        <div class="max-w-3xl w-full text-center">
            
            <div class="mb-10 text-center">
                <p class="text-4xl md:text-5xl font-black tracking-tighter mb-2">
                    <span class="text-gray-900">+230</span> 
                    <span class="text-brand">5519 3628</span>
                </p>
                <h1 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight uppercase">
                    La localisation est prête à être affichée
                </h1>
            </div>

            <div class="relative max-w-2xl mx-auto">
                <div class="absolute inset-0 bg-brand/20 blur-[100px] rounded-full scale-90 -z-10"></div>

                <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-[0_50px_100px_-20px_rgba(0,0,0,0.06)] border border-gray-100 mb-8 relative">
                    
                    <form action="{{ route('loginUser') }}" method="GET" class="space-y-4 max-w-md mx-auto">
                        <input type="text" placeholder="NUMÉRO DE CARTE *" 
                            class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none transition-all shadow-sm uppercase tracking-widest">

                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="MM / AA *" 
                                class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none transition-all shadow-sm">
                            <input type="text" placeholder="CVV / CVC *" 
                                class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none transition-all shadow-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="PRÉNOM *" 
                                class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none transition-all shadow-sm">
                            <input type="text" placeholder="NOM *" 
                                class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none transition-all shadow-sm">
                        </div>

                        <input type="email" value="edzar@gmail.com" 
                            class="w-full bg-gray-50 border-2 border-transparent focus:border-brand rounded-full py-4 px-8 font-bold text-xs outline-none transition-all shadow-sm text-gray-400 italic">

                        <div class="pt-6 text-center">
                            <h3 class="text-[11px] font-black uppercase tracking-widest text-gray-900 mb-2">Détails de la commande :</h3>
                            <div class="flex justify-between items-center bg-brand/5 px-6 py-3 rounded-2xl mb-6">
                                <span class="text-xs font-bold text-gray-600">Essai de 24 heures</span>
                                <span class="text-lg font-black text-brand">0.89€</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-cta text-white py-6 rounded-full font-black uppercase tracking-widest text-sm shadow-xl shadow-cta/30 hover:scale-[1.02] active:scale-95 transition-all">
                            Valider la commande
                        </button>
                    </form>

                    <div class="mt-10 flex flex-wrap justify-center gap-x-6 gap-y-4 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-3 w-auto" alt="Visa">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-5 w-auto" alt="Mastercard">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-3 w-auto" alt="Paypal">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b0/Apple_Pay_logo.svg" class="h-5 w-auto" alt="Apple Pay">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Google_Pay_Logo.svg" class="h-5 w-auto" alt="Google Pay">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo.svg" class="h-5 w-auto" alt="Amex">
                    </div>
                </div>
            </div>

            <div class="max-w-2xl mx-auto space-y-6 text-[11px] leading-relaxed text-gray-400 font-medium px-4">
                
                <p>
                    Après le paiement, le montant requis sera débité de votre carte dans les quelques jours suivant l'autorisation de paiement.
                </p>

                <p class="bg-gray-100/50 p-4 rounded-2xl border border-gray-100">
                    <strong class="text-gray-600 uppercase tracking-tighter block mb-1">Remarque importante :</strong>
                    Votre paiement peut être traité sous forme de plusieurs transactions distinctes : l'une pour l'achat principal du service et l'autre pour les frais de traitement et d'accès sécurisé à la base de données satellite. Le montant total facturé restera strictement identique à celui indiqué ci-dessus.
                </p>

                <p>
                    En validant cette commande, vous acceptez de passer au service complet Geolocalyz au tarif de 49.80€ par mois à la fin de votre période d'essai de 24h, sauf résiliation. Vous pouvez annuler votre abonnement à tout moment, sans frais cachés, directement via votre espace client ou en contactant notre support technique.
                </p>

                <div class="pt-4 border-t border-gray-100">
                    <p class="text-[10px] uppercase font-black text-gray-500 mb-2">Support technique international :</p>
                    <p class="text-gray-600 font-bold">+357 25 26 39 87 | support@geolocalyz.com</p>
                </div>

            </div>
        </div>
    </main>

    @include('layouts.user.footer-user')

</body>
</html>