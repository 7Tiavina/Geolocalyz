<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport d'Intelligence - Geolocalyz</title>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brand: '#33d7bb', cta: '#ff6b3d' }
                }
            }
        }
    </script>
    <style>
        #map { height: 700px; width: 100%; z-index: 10; }
        .leaflet-container { background: #f8fafc; border-radius: 2.8rem; }
        
        /* CURSEUR VERT PERSONNALISÉ & CLIGNOTANT */
        .custom-target-icon {
            display: flex; align-items: center; justify-content: center;
        }
        .pulse-core {
            width: 14px; height: 14px;
            background-color: #33d7bb;
            border: 3px solid white;
            border-radius: 50%;
            z-index: 2;
            box-shadow: 0 0 10px rgba(51, 215, 187, 0.5);
        }
        .pulse-ring {
            position: absolute;
            width: 35px; height: 35px;
            background-color: #33d7bb;
            border-radius: 50%;
            animation: ripple 1.8s infinite ease-out;
            opacity: 0;
            z-index: 1;
        }
        @keyframes ripple {
            0% { transform: scale(0.4); opacity: 0.8; }
            100% { transform: scale(2.8); opacity: 0; }
        }

        .data-card {
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }
        .data-card:hover { transform: translateY(-4px); border-color: #33d7bb; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col text-gray-900 font-sans">

    @include('layouts.user.header-user')

    <main class="flex-grow px-4 py-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
                <div class="flex items-center gap-6">
                    <a href="javascript:history.back()" class="group flex items-center gap-3 bg-white hover:border-brand p-2 pr-6 rounded-full shadow-sm border border-gray-100 transition-all">
                        <div class="bg-gray-50 group-hover:bg-brand w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-600 group-hover:text-brand">Retour</span>
                    </a>
                    <div>
                        <h1 class="text-3xl font-black tracking-tighter text-gray-900">Analyse <span class="text-brand">+230 5519 3628</span></h1>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Rapport technique complet</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <button class="bg-white border border-gray-100 flex items-center gap-2 px-6 py-4 rounded-full shadow-sm hover:border-brand transition-all group">
                         <svg class="w-4 h-4 text-gray-400 group-hover:text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                         <span class="text-[10px] font-black uppercase text-gray-600 group-hover:text-brand">Partager</span>
                    </button>
                    <button class="bg-cta text-white px-8 py-4 rounded-full font-black uppercase tracking-widest text-[10px] shadow-lg shadow-cta/20 hover:scale-105 transition-all">
                        Télécharger PDF
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-4 space-y-6">
                    
                    <div class="data-card bg-white rounded-[2.5rem] p-8 shadow-sm">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Localisation Physique</h2>
                        <div class="space-y-1">
                            <p class="text-2xl font-black text-gray-900 italic">Royal Road</p>
                            <p class="text-lg font-bold text-gray-500">Beau Bassin, 71604</p>
                            <div class="flex items-center gap-2 mt-4 text-brand font-black text-[10px] uppercase">
                                <img src="https://flagcdn.com/w20/mu.png" class="h-3 rounded-sm shadow-sm">
                                Mauritius / Maurice
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-50 flex justify-between items-center">
                            <div>
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Dernier relevé</p>
                                <p class="text-xs font-bold text-gray-700">09 Janvier 2026</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Heure locale</p>
                                <p class="text-xs font-bold text-gray-700">17:49:59</p>
                            </div>
                        </div>
                    </div>

                    <div class="data-card bg-white rounded-[2.5rem] p-8 shadow-sm">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Données Réseau</h2>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-2xl flex justify-between items-center">
                                <span class="text-[9px] font-black text-gray-400 uppercase">Adresse IP</span>
                                <span class="text-sm font-black text-gray-800">102.160.22.145</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-2xl flex justify-between items-center border-l-4 border-brand">
                                <span class="text-[9px] font-black text-gray-400 uppercase">Opérateur</span>
                                <span class="text-sm font-black text-brand">EMTEL-AS-AP</span>
                            </div>
                        </div>
                    </div>

                    <div class="data-card bg-white rounded-[2.5rem] p-8 shadow-sm">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Itinéraire</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="https://www.google.com/maps?q=-20.2966,57.4749" target="_blank" class="bg-gray-50 hover:bg-brand/10 p-4 rounded-2xl flex flex-col items-center gap-2 transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/aa/Google_Maps_icon_%282020%29.svg" class="w-6 h-6">
                                <span class="text-[9px] font-black uppercase text-gray-400 group-hover:text-brand">Google</span>
                            </a>
                            <a href="maps://maps.apple.com/?q=-20.2966,57.4749" class="bg-gray-50 hover:bg-brand/10 p-4 rounded-2xl flex flex-col items-center gap-2 transition-all group">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-brand" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
                                <span class="text-[9px] font-black uppercase text-gray-400 group-hover:text-brand">Apple</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="bg-white rounded-[3.5rem] p-4 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div id="map" class="rounded-[2.8rem]"></div>
                        
                        <div class="absolute top-8 left-8 z-[1000] hidden md:block">
                            <div class="bg-white/70 backdrop-blur-md p-4 rounded-3xl border border-white/50 shadow-xl flex items-center gap-4">
                                <div class="w-10 h-10 bg-brand/10 rounded-2xl flex items-center justify-center text-brand">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[8px] font-black text-gray-400 uppercase">Coordonnées Live</p>
                                    <p class="text-[11px] font-black text-gray-900">-20.2966, 57.4749</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @include('layouts.user.footer-user')

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const coords = [-20.2966, 57.4749];
            var map = L.map('map', { zoomControl: false }).setView(coords, 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            var customIcon = L.divIcon({
                className: 'custom-target-icon',
                html: '<div class="pulse-ring"></div><div class="pulse-core"></div>',
                iconSize: [40, 40],
                iconAnchor: [20, 20]
            });

            L.marker(coords, { icon: customIcon }).addTo(map);

            L.circle(coords, { 
                color: '#33d7bb', 
                fillColor: '#33d7bb', 
                fillOpacity: 0.1, 
                radius: 60,
                weight: 1 
            }).addTo(map);

            setTimeout(() => { map.invalidateSize(); }, 500);
        });
    </script>
</body>
</html>