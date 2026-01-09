<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelligence Report - Geolocalyz</title>
    
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pulse-core {
            width: 12px;
            height: 12px;
            background-color: #33d7bb;
            border: 2px solid white;
            border-radius: 50%;
            z-index: 2;
        }
        .pulse-ring {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: #33d7bb;
            border-radius: 50%;
            animation: ripple 1.5s infinite ease-out;
            opacity: 0;
            z-index: 1;
        }
        @keyframes ripple {
            0% { transform: scale(0.5); opacity: 0.5; }
            100% { transform: scale(2.5); opacity: 0; }
        }

        .data-card {
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }
        .data-card:hover {
            transform: translateY(-4px);
            border-color: #33d7bb;
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col text-gray-900 font-sans">

    @include('layouts.user.header-user')

    <main class="flex-grow px-4 py-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="bg-brand/10 text-brand text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Signal satellite verrouillé</span>
                    </div>
                    <h1 class="text-4xl font-black tracking-tighter text-gray-900">Rapport <span class="text-brand">+230 5519 3628</span></h1>
                </div>
                
                <div class="flex gap-3">
                    <button class="bg-white border border-gray-100 p-4 rounded-2xl shadow-sm hover:border-brand transition-all">
                         <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                    </button>
                    <button class="bg-cta text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-lg shadow-cta/30 hover:scale-105 transition-all">
                        Exporter PDF
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-4 space-y-6">
                    
                    <div class="data-card bg-white rounded-[2.5rem] p-8 shadow-sm">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Localisation Physique</h2>
                        <div class="space-y-1">
                            <p class="text-2xl font-black text-gray-900">Royal Road</p>
                            <p class="text-lg font-bold text-gray-600 italic">Beau Bassin, Maurice</p>
                            <div class="pt-4 mt-4 border-t border-gray-50 grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[8px] font-black text-gray-400 uppercase">Région</p>
                                    <p class="text-xs font-bold">Plaines Wilhems</p>
                                </div>
                                <div>
                                    <p class="text-[8px] font-black text-gray-400 uppercase">Code Postal</p>
                                    <p class="text-xs font-bold">71604</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="data-card bg-white rounded-[2.5rem] p-8 shadow-sm">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Données Forensics</h2>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-2xl flex justify-between items-center">
                                <span class="text-[9px] font-black text-gray-400 uppercase">IP</span>
                                <span class="text-sm font-black">102.160.22.145</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-2xl flex justify-between items-center border-l-4 border-brand">
                                <span class="text-[9px] font-black text-gray-400 uppercase">Opérateur</span>
                                <span class="text-sm font-black text-brand">EMTEL-AS-AP</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-2xl flex justify-between items-center">
                                <span class="text-[9px] font-black text-gray-400 uppercase">ASN</span>
                                <span class="text-sm font-black italic text-gray-500">AS30999</span>
                            </div>
                        </div>
                    </div>

                    <div class="data-card bg-white rounded-[2.5rem] p-8 shadow-sm">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Lancer l'itinéraire</h2>
                        <div class="flex gap-4">
                            <a href="https://www.google.com/maps?q=-20.2966,57.4749" target="_blank" class="flex-1 bg-gray-50 hover:bg-brand hover:text-white p-4 rounded-2xl flex flex-col items-center gap-2 transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/aa/Google_Maps_icon_%282020%29.svg" class="w-6 h-6">
                                <span class="text-[9px] font-black uppercase">Google Maps</span>
                            </a>
                            <a href="maps://maps.apple.com/?q=-20.2966,57.4749" class="flex-1 bg-gray-50 hover:bg-brand hover:text-white p-4 rounded-2xl flex flex-col items-center gap-2 transition-all group">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
                                <span class="text-[9px] font-black uppercase">Apple Maps</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="bg-white rounded-[3.5rem] p-4 shadow-sm border border-gray-100 relative">
                        <div class="relative rounded-[2.8rem] overflow-hidden">
                            <div id="map"></div>
                            
                            <div class="absolute top-6 left-6 z-[1000] hidden md:block">
                                <div class="bg-white/80 backdrop-blur-md p-5 rounded-3xl border border-white shadow-xl">
                                    <div class="flex items-center gap-4">
                                        <div class="bg-brand/20 p-2 rounded-xl text-brand">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[8px] font-black text-gray-400 uppercase">Live Data</p>
                                            <p class="text-[11px] font-black">-20.2966° S, 57.4749° E</p>
                                        </div>
                                    </div>
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
            const pos = [-20.2966, 57.4749];
            
            // Création de la carte
            var map = L.map('map', { zoomControl: false }).setView(pos, 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // CRÉATION DU CURSEUR VERT PERSONNALISÉ
            var customIcon = L.divIcon({
                className: 'custom-target-icon',
                html: '<div class="pulse-ring"></div><div class="pulse-core"></div>',
                iconSize: [30, 30],
                iconAnchor: [15, 15]
            });

            // Ajout du marqueur personnalisé
            L.marker(pos, { icon: customIcon }).addTo(map);

            // Zone de précision
            L.circle(pos, {
                color: '#33d7bb',
                fillColor: '#33d7bb',
                fillOpacity: 0.1,
                radius: 80,
                weight: 1
            }).addTo(map);

            setTimeout(() => { map.invalidateSize(); }, 500);
        });
    </script>
</body>
</html>