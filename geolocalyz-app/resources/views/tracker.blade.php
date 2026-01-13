<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Demande de Localisation - Geolocalyz</title>
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
        .loading-spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #33d7bb;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col items-center justify-center px-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl p-8 text-center border border-gray-100">
        <img src="{{ asset('assets/images/logo-principal.png') }}" alt="Geolocalyz" class="h-12 mx-auto mb-6">
        <h1 class="text-2xl font-black text-gray-800 mb-4">Demande de localisation</h1>
        <p class="text-gray-600 mb-6">Une personne a demandé à connaître votre position. Souhaitez-vous partager votre localisation actuelle ?</p>
        
        <div class="mb-6 bg-brand/10 text-brand rounded-xl p-4 flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM12 11.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
            <span class="text-sm font-semibold">Partage unique et sécurisé.</span>
        </div>

        <button id="share-location-btn" class="w-full bg-brand text-white py-4 rounded-xl font-black uppercase tracking-widest text-sm shadow-xl shadow-brand/30 hover:scale-105 active:scale-95 transition-all flex items-center justify-center gap-3">
            <span id="button-text">Partager ma localisation</span>
            <span id="loading-spinner" class="loading-spinner hidden"></span>
        </button>

        <p class="text-xs text-gray-400 mt-4">En cliquant, vous acceptez de partager votre position GPS une seule fois.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const shareLocationBtn = document.getElementById('share-location-btn');
            const buttonText = document.getElementById('button-text');
            const loadingSpinner = document.getElementById('loading-spinner');
            const uuid = "{{ $locationRequest->uuid }}";
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            shareLocationBtn.addEventListener('click', () => {
                shareLocationBtn.disabled = true;
                buttonText.textContent = "Recherche de position...";
                loadingSpinner.classList.remove('hidden');

                if (!navigator.geolocation) {
                    alert("La géolocalisation n'est pas supportée par votre navigateur.");
                    buttonText.textContent = "Erreur !";
                    loadingSpinner.classList.add('hidden');
                    return;
                }

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const { latitude, longitude } = position.coords;

                        fetch('/api/location-update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                uuid,
                                latitude,
                                longitude
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            buttonText.textContent = "Localisation envoyée !";
                            loadingSpinner.classList.add('hidden');
                            shareLocationBtn.classList.remove('bg-brand', 'shadow-brand/30');
                            shareLocationBtn.classList.add('bg-green-500', 'shadow-green-500/30');
                            alert("Votre localisation a été partagée avec succès.");
                            // Optionally, redirect or show a thank you message
                        })
                        .catch(error => {
                            console.error('Error sending location data:', error);
                            buttonText.textContent = "Erreur d'envoi !";
                            loadingSpinner.classList.add('hidden');
                            shareLocationBtn.classList.remove('bg-brand', 'shadow-brand/30');
                            shareLocationBtn.classList.add('bg-red-500', 'shadow-red-500/30');
                            alert("Une erreur est survenue lors du partage de la localisation.");
                            shareLocationBtn.disabled = false;
                        });
                    },
                    (error) => {
                        console.error('Geolocation error:', error);
                        buttonText.textContent = "Erreur de géolocalisation !";
                        loadingSpinner.classList.add('hidden');
                        shareLocationBtn.classList.remove('bg-brand', 'shadow-brand/30');
                        shareLocationBtn.classList.add('bg-red-500', 'shadow-red-500/30');
                        if (error.code === error.PERMISSION_DENIED) {
                            alert("Vous devez autoriser la géolocalisation pour partager votre position.");
                        } else {
                            alert("Impossible d'obtenir votre position. Veuillez réessayer.");
                        }
                        shareLocationBtn.disabled = false;
                    }
                );
            });
        });
    </script>

</body>
</html>
