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
        @keyframes spinRing {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .ring-anim { animation: spinRing 2s linear infinite; }

        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(51, 215, 187, 0.5); }
            100% { box-shadow: 0 0 50px 20px rgba(51, 215, 187, 0); }
        }
        .pulse-glow { animation: pulseGlow 1.5s ease-out infinite; }

        @keyframes pulseText {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .searching-text { animation: pulseText 1s ease-in-out infinite; }

        .blurred-permanent {
            filter: blur(5px);
            opacity: 0.5;
            user-select: none;
            pointer-events: none;
        }

        .fade-in { animation: fadeIn 0.5s ease forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Animation pour l'apparition du bouton */
        .btn-reveal {
            animation: btnReveal 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        @keyframes btnReveal {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>

<body class="bg-[#f8fafc] h-screen flex flex-col justify-between overflow-hidden relative">

    @include('layouts.user.header-user')

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-brand/5 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-brand/5 rounded-full blur-[100px]"></div>
    </div>

    <main class="relative z-10 flex-grow flex items-center justify-center pt-16">
        <div class="relative">
            
            <div id="ring" class="absolute -inset-8 rounded-full border-[3px] border-transparent border-t-brand border-l-brand/20 ring-anim transition-opacity duration-500"></div>

            <div id="mainCircle" class="relative w-[480px] h-[480px] md:w-[520px] md:h-[520px] rounded-full bg-white shadow-[0_40px_100px_rgba(0,0,0,0.06)] border border-white flex items-center justify-center transition-all duration-700">
                
                <div class="text-center w-full px-12">
                    
                    <div class="mb-6 h-4">
                        <span id="status-text" class="searching-text text-[10px] font-black text-brand uppercase tracking-[0.4em]">
                            Initialisation...
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-10 tracking-tighter">
                       {{ $phone }}
                    </h1>

                    <div class="space-y-5 max-w-[280px] mx-auto text-left">
                        <div class="flex justify-between items-end border-b border-gray-100 pb-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Opérateur</span>
                            <span id="data-operator" class="text-sm font-black text-gray-800 opacity-0">EMTEL LTD</span>
                        </div>

                        <div class="flex justify-between items-end border-b border-gray-100 pb-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Pays</span>
                            <span id="data-country" class="text-sm font-black text-gray-800 opacity-0">MAURITIUS 🇲🇺</span>
                        </div>

                        <div class="flex justify-between items-end border-b border-gray-100 pb-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Ville</span>
                            <span class="text-sm font-black text-brand blurred-permanent">Port-Louis</span>
                        </div>

                        <div class="flex justify-between items-end border-b border-gray-100 pb-2">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Position GPS</span>
                            <span class="text-sm font-black text-brand blurred-permanent">En attente...</span>
                        </div>
                    </div>

                    <div class="mt-12 h-16 flex items-center justify-center">
                        <div id="loader-zone" class="flex flex-col items-center gap-3 w-full">
                            <div class="w-48 h-1 bg-gray-100 rounded-full overflow-hidden">
                                <div id="progress-bar" class="h-full bg-brand w-0 transition-all duration-[6000ms] ease-out"></div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span id="percent" class="text-[10px] font-black text-gray-400 uppercase tracking-widest">0%</span>
                                <span class="text-gray-200 text-[10px]">|</span>
                                <span id="tech-code" class="text-[9px] font-medium text-gray-300 font-mono tracking-tighter uppercase">X-702-SIGNAL</span>
                            </div>
                        </div>

                        <div id="tracking-link-zone" class="hidden flex flex-col items-center gap-3 w-full">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Lien à envoyer à la personne à localiser :</p>
                            <div class="flex items-center gap-2 w-full max-w-md">
                                <input type="text" id="tracking-link-input" value="{{ route('track.show', ['uuid' => $uuid]) }}" readonly
                                       class="flex-grow bg-gray-100 border border-gray-200 rounded-full py-2 px-4 text-xs text-gray-700 truncate">
                                <button id="copy-link-btn" class="bg-brand text-white text-[9px] font-black px-4 py-2 rounded-full uppercase shadow-sm hover:opacity-90 transition-opacity">Copier</button>
                            </div>
                            <p class="text-[9px] font-medium text-gray-300 font-mono tracking-tighter uppercase">Copiez et envoyez ce lien via SMS, WhatsApp, etc.</p>
                        </div>
                        
                        <a href="{{ route('addEmail', ['uuid' => $uuid]) }}" id="continue-to-email-btn" class="hidden btn-reveal w-64 bg-cta text-white py-4 rounded-full font-black uppercase tracking-[0.2em] text-sm shadow-xl shadow-cta/30 hover:scale-105 transition-transform">
                            Continuer
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </main>

    @include('layouts.user.footer-user')

    <script>
        const statusText = document.getElementById('status-text');
        const progressBar = document.getElementById('progress-bar');
        const percent = document.getElementById('percent');
        const techCode = document.getElementById('tech-code');
        const loaderZone = document.getElementById('loader-zone');
        const trackingLinkZone = document.getElementById('tracking-link-zone');
        const continueToEmailBtn = document.getElementById('continue-to-email-btn');
        const ring = document.getElementById('ring');
        const copyLinkBtn = document.getElementById('copy-link-btn');
        const trackingLinkInput = document.getElementById('tracking-link-input');
        
        const totalDuration = 6000; 
        const steps = ["Initialisation...", "Triangulation...", "Accès Satellites...", "Calcul Final..."];
        const codes = ["X-702-SIGNAL", "GS-88-DATA", "LOC-991-POS", "LAT-LONG-SCAN"];

        window.onload = () => {
            progressBar.style.width = "100%";
        };

        let startTime = Date.now();
        const updateUI = () => {
            let elapsed = Date.now() - startTime;
            let p = Math.min(Math.floor((elapsed / totalDuration) * 100), 100);
            
            percent.textContent = p + "%";

            if (p < 25) {
                statusText.textContent = steps[0];
                techCode.textContent = codes[0];
            } else if (p < 50) {
                statusText.textContent = steps[1];
                techCode.textContent = codes[1];
                document.getElementById('data-operator').classList.add('fade-in');
            } else if (p < 75) {
                statusText.textContent = steps[2];
                techCode.textContent = codes[2];
                document.getElementById('data-country').classList.add('fade-in');
            } else if (p < 100) {
                statusText.textContent = steps[3];
                techCode.textContent = codes[3];
            }

            if (elapsed < totalDuration) {
                requestAnimationFrame(updateUI);
            } else {
                // ACTIONS À LA FIN DU CHARGEMENT (100%)
                statusText.textContent = "Prêt à continuer";
                statusText.classList.remove('searching-text');
                
                ring.style.opacity = "0";
                document.getElementById('mainCircle').classList.add("pulse-glow");
                document.getElementById('mainCircle').style.borderColor = "#33d7bb";

                // Remplacer le loader par le lien de suivi et le bouton Continuer
                loaderZone.classList.add('hidden');
                trackingLinkZone.classList.remove('hidden'); // Show the tracking link
                continueToEmailBtn.classList.remove('hidden');
            }
        };
        requestAnimationFrame(updateUI);

        // Copy to clipboard functionality
        copyLinkBtn.addEventListener('click', () => {
            trackingLinkInput.select();
            trackingLinkInput.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(trackingLinkInput.value)
                .then(() => {
                    copyLinkBtn.textContent = "Copié !";
                    setTimeout(() => { copyLinkBtn.textContent = "Copier"; }, 2000);
                })
                .catch(err => {
                    console.error('Failed to copy text: ', err);
                    alert("Impossible de copier le lien. Veuillez le copier manuellement.");
                });
        });
    </script>

</body>
</html>