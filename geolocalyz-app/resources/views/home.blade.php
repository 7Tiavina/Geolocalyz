<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Geolocalyz – Localiser un téléphone</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
  <style>
    .glow-effect {
      box-shadow: 0 0 50px 10px rgba(51, 215, 187, 0.3);
    }
    .tab-btn.active {
      background-color: rgba(51, 215, 187, 0.1);
      border-color: #33d7bb;
    }
    .iti.iti--allow-dropdown {
      border-radius: 9999px !important;
    }
    .iti__selected-flag {
      border-radius: 9999px !important;
    }
    .iti__flag {
      border-radius: 9999px !important;
    }

  </style>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: '#33d7bb'
          }
        }
      }
    }
  </script>
</head>

<body class="bg-[#f6fffd] text-gray-800 overflow-x-hidden">

<!-- BACKGROUND SHAPES -->
<div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
  <div class="absolute top-0 left-0 w-[520px] h-[520px] bg-brand/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/3"></div>
  <div class="absolute top-1/3 right-0 w-[480px] h-[480px] bg-brand/20 rounded-full blur-3xl translate-x-1/2"></div>
  <div class="absolute bottom-0 left-1/4 w-[420px] h-[420px] bg-brand/20 rounded-full blur-3xl"></div>
</div>

<!-- HEADER -->
@include('layouts.header')

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('main-header'); // L'ID du header dans header.blade.php
    const heroSection = document.getElementById('hero-section');
    if (header && heroSection) {
      const adjustHeroPadding = () => {
        heroSection.style.paddingTop = `${header.offsetHeight}px`;
      };

      adjustHeroPadding();
      window.addEventListener('resize', adjustHeroPadding);
    }
  });
</script>

<!-- HERO -->
<section id="hero-section" class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-20 items-center">
  <div class="space-y-6 text-center mx-auto max-w-lg md:text-left md:mx-0 md:max-w-none">
    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">
      Localisez <br> un téléphone <br>
      <span class="text-orange-400">par son numéro</span>
    </h1>

    <div id="country-badge"
         class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-400 to-amber-300 text-slate-900 px-4 py-2 rounded-full font-semibold shadow">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-5h2v2H9v-2zm0-4h2v3H9V7z"/></svg>
      <span>#1 Choice in <span class="country-name">Mauritius</span></span>
    </div>

    <p class="text-lg text-slate-900">Ready to find out the location of the phone number?</p>

    <!-- FORM vers searchNumber -->
    <form action="{{ route('createLocationRequest') }}" method="POST"
          class="flex flex-col sm:flex-row gap-3 w-full max-w-sm mx-auto sm:max-w-none sm:mx-0">
      @csrf
      <input id="phone" name="phoneNumber" type="tel"
             class="border rounded-full px-14 py-5 text-xl w-full sm:w-auto outline-none focus:ring-2 focus:ring-orange-400">

      <button type="submit"
              class="bg-orange-500 hover:bg-orange-600 text-white py-5 px-14 rounded-full text-xl font-black shadow-lg shadow-orange-200 uppercase tracking-widest transition-all hover:scale-105 w-full sm:w-auto">
        DÉTECTER
      </button>
    </form>

    <div class="flex gap-4">
      <img src="{{ asset('assets/images/logo-AOP.png') }}" alt="100 % légal" class="h-24">
    </div>

    <p class="text-xs text-slate-400">
      Confidential & Secure – it doesn’t matter where you are or what device you’re using.
    </p>
  </div>

  <div class="relative hidden md:block">
    <div id="lottie-animation" class="w-full h-[300px] md:h-[420px]"></div>
  </div>
</section>


<!-- Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19/build/css/intlTelInput.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19/build/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.0/lottie.min.js"></script>

<script>
  /* intl-tel-input */
  const phoneInput = window.intlTelInput(document.querySelector("#phone"), {
    initialCountry: "mu",
    separateDialCode: true,
    showSelectedDialCode: true,
    countrySearch: false,
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19/build/js/utils.js"
  });
  phoneInput.promise.then(() => {
    document.querySelector("#phone").addEventListener("countrychange", () => {
      document.querySelector(".country-name").textContent = phoneInput.getSelectedCountryData().name;
    });
  });

  /* Lottie */
  lottie.loadAnimation({
    container: document.getElementById('lottie-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: "{{ asset('assets/images/Lottie.json') }}"
  });
</script>

<section class="max-w-7xl mx-auto px-6 py-16 font-sans">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
    
    <div class="space-y-6 order-2 lg:order-1">
      <div class="group">
        <button onclick="switchTab(1)" id="btn-1" class="tab-btn active w-full flex items-center gap-4 p-4 rounded-full border-2 transition-all text-left">
          <div class="icon-container bg-brand p-3 rounded-full shadow-inner">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          </div>
          <span class="font-bold text-gray-800 text-lg">Localiser par numéro</span>
        </button>
        <p id="desc-1" class="mt-4 px-8 text-gray-500 text-sm leading-relaxed">
          Envoyez un message contenant un lien de localisation à un numéro. Lorsque la personne cliquera, sa position s'affichera.
        </p>
      </div>

      <div class="group">
        <button onclick="switchTab(2)" id="btn-2" class="tab-btn w-full flex items-center gap-4 p-4 rounded-full border-2 border-transparent bg-white hover:bg-gray-50 transition-all text-left">
          <div class="icon-container bg-gray-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          </div>
          <span class="font-bold text-gray-800 text-lg">Identifier par nom</span>
        </button>
        <p id="desc-2" class="hidden mt-4 px-8 text-gray-500 text-sm leading-relaxed">
          Recherchez l'identité d'un correspondant inconnu à partir de son nom dans notre base mondiale.
        </p>
      </div>

      <div class="group">
        <button onclick="switchTab(3)" id="btn-3" class="tab-btn w-full flex items-center gap-4 p-4 rounded-full border-2 border-transparent bg-white hover:bg-gray-50 transition-all text-left">
          <div class="icon-container bg-gray-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <span class="font-bold text-gray-800 text-lg">Vérifier les fuites</span>
        </button>
        <p id="desc-3" class="hidden mt-4 px-8 text-gray-500 text-sm leading-relaxed">
          Surveillez si vos données personnelles circulent sur le dark web ou des bases piratées.
        </p>
      </div>
    </div>

    <div class="relative flex justify-center order-3 lg:order-2">
      <div class="absolute inset-0 bg-brand/20 blur-[60px] rounded-full scale-75 lg:scale-100"></div>

      <div class="relative w-72 h-[500px] bg-black rounded-[3.5rem] p-1.5 shadow-2xl ring-1 ring-gray-800 z-10 glow-effect">
        
        <div id="phone-screen" 
             class="relative h-full w-full rounded-[3rem] overflow-hidden pt-14 p-5 transition-all duration-700 bg-cover bg-center"
             style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.5)), url({{ asset('assets/images/fond.png') }});">
          
          <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-black rounded-b-2xl z-20"></div>
          
          <div class="w-full relative z-10 flex flex-col items-center">
            <div class="mb-2 mt-2 drop-shadow-md">
              <svg class="w-5 h-5 text-white/90" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2v-8a2 2 0 00-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7zm3 11a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
              </svg>
            </div>

            <div class="text-4xl font-bold text-white mb-1 text-center drop-shadow-lg">10:00</div>
            <p class="text-[10px] text-gray-200 mb-10 text-center uppercase tracking-widest font-bold">Mardi, 11 Septembre</p>
            
            <div class="bg-white/95 backdrop-blur-md p-4 rounded-[1.8rem] shadow-xl border border-white/50 w-full">
               <div class="flex justify-between items-center mb-2">
                 <div class="flex items-center gap-2">
                   <div class="w-5 h-5 bg-brand rounded-md flex items-center justify-center">
                     <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                   </div>
                   <span class="text-[10px] font-black text-gray-500 uppercase">Messages</span>
                 </div>
                 <span class="text-[9px] text-gray-400">maintenant</span>
               </div>
               <p id="phone-msg" class="text-[11px] text-gray-800 leading-snug font-medium">
                 Salut ! Peux-tu partager ta position avec Geolocalyz ? <span class="text-blue-500 font-bold underline">geoloc.ly/track=92...</span>
               </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="space-y-8 order-1 lg:order-3 text-center lg:text-left">
      <h2 id="display-title" class="text-4xl sm:text-5xl font-black text-gray-900 leading-[1.1] tracking-tight">
        <span class="text-brand">Geolocalyz</span> permet d'obtenir des infos fiables.
      </h2>
      <p id="display-desc" class="text-gray-500 text-xl leading-relaxed">
        Géolocalisez un numéro, identifiez son propriétaire et obtenez des informations utiles instantanément.
      </p>
      <div class="hidden lg:block pt-4">
        <a href="{{ route('addNumber') }}"
          class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-black py-5 px-14 rounded-full text-xl transition-all hover:scale-105 shadow-lg shadow-orange-200 uppercase tracking-widest">
          Essayer
        </a>
      </div>
    </div>

    <div class="order-4 lg:hidden text-center">
      <a href="{{ route('addNumber') }}"
        class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-black py-5 px-14 rounded-full text-xl transition-all hover:scale-105 shadow-lg shadow-orange-200 uppercase tracking-widest">
        Essayer
      </a>
    </div>


  </div>
</section>



<!-- TESTIMONIALS -->
<section class="max-w-7xl mx-auto px-6 py-28 relative">
  
  <div class="text-center max-w-2xl mx-auto mb-20 relative z-10">
    <h2 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight">
      Écoutez directement les vrais utilisateurs de 
      <span class="text-brand">Geolocalyz</span>
    </h2>
    <p class="text-gray-500 mt-6 font-medium text-lg">
      Rejoignez des milliers de personnes qui font confiance à notre technologie.
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 relative z-10">
    
    <div class="relative group">
      <div class="absolute -inset-2 bg-brand/20 blur-2xl rounded-[3rem] opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
      
      <div class="relative bg-white p-8 rounded-[2.5rem] shadow-[0_15px_40px_rgba(0,0,0,0.04)] border border-gray-100 
                  transition-all duration-500 ease-out 
                  group-hover:-translate-y-4 group-hover:bg-brand/5 group-hover:border-brand/20">
        
        <div class="flex gap-1 mb-5">
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
        </div>

        <p class="text-gray-700 leading-relaxed font-medium mb-8 transition-colors group-hover:text-gray-900">
          "Super expérience, le service est extrêmement rapide et d'une précision chirurgicale. J'ai pu localiser mon fils en un clin d'œil."
        </p>

        <div class="flex items-center gap-4 border-t border-gray-100 pt-6 transition-colors group-hover:border-brand/10">
          <div class="w-12 h-12 rounded-full bg-brand/10 flex items-center justify-center font-bold text-brand shadow-sm">JD</div>
          <div>
            <h4 class="font-bold text-gray-900 text-sm">Jean Dupont</h4>
            <p class="text-xs text-brand font-bold uppercase tracking-wider">Vérifié</p>
          </div>
        </div>
      </div>
    </div>

    <div class="relative group">
      <div class="absolute -inset-2 bg-brand/25 blur-3xl rounded-[3rem] opacity-40 group-hover:opacity-100 transition-all duration-500"></div>
      
      <div class="relative bg-white p-8 rounded-[2.5rem] shadow-[0_15px_40px_rgba(0,0,0,0.06)] border border-brand/20
                  transition-all duration-500 ease-out lg:-translate-y-4
                  group-hover:-translate-y-8 group-hover:bg-brand/5">
        
        <div class="flex gap-1 mb-5">
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
        </div>

        <p class="text-gray-700 leading-relaxed font-medium mb-8">
          "L'interface est très facile à utiliser, même pour quelqu'un qui n'est pas technophile. Service très fiable et sécurisé."
        </p>

        <div class="flex items-center gap-4 border-t border-gray-100 pt-6">
          <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-500 shadow-sm">ML</div>
          <div>
            <h4 class="font-bold text-gray-900 text-sm">Marie Lefebvre</h4>
            <p class="text-xs text-brand font-bold uppercase tracking-wider">Vérifié</p>
          </div>
        </div>
      </div>
    </div>

    <div class="relative group">
      <div class="absolute -inset-2 bg-brand/20 blur-2xl rounded-[3rem] opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
      
      <div class="relative bg-white p-8 rounded-[2.5rem] shadow-[0_15px_40px_rgba(0,0,0,0.04)] border border-gray-100 
                  transition-all duration-500 ease-out 
                  group-hover:-translate-y-4 group-hover:bg-brand/5 group-hover:border-brand/20">
        
        <div class="flex gap-1 mb-5">
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
          <span class="text-brand text-xl">★</span>
        </div>

        <p class="text-gray-700 leading-relaxed font-medium mb-8">
          "M'a sauvé la mise pour localiser un téléphone perdu en quelques minutes seulement. Je recommande Geolocalyz à 100% !"
        </p>

        <div class="flex items-center gap-4 border-t border-gray-100 pt-6 transition-colors group-hover:border-brand/10">
          <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-500 shadow-sm">TM</div>
          <div>
            <h4 class="font-bold text-gray-900 text-sm">Thomas Martin</h4>
            <p class="text-xs text-brand font-bold uppercase tracking-wider">Vérifié</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- WHY GEOLOCALYZ -->
<section id="why-geolocalyz-section" class="max-w-7xl mx-auto px-6 py-28 grid lg:grid-cols-2 gap-16 items-center">
  
  <div class="space-y-10">
    <div>
      <h2 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight mb-6">
        Pourquoi choisir <span class="text-brand">Geolocalyz</span> ?
      </h2>
      <p class="text-gray-500 text-lg font-medium">
        La solution la plus avancée pour localiser vos proches en toute sécurité, sans barrière technique.
      </p>
    </div>

    <div class="space-y-8">
      
      <div class="flex items-start gap-5 group">
        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-brand/10 flex items-center justify-center text-brand transition-transform group-hover:scale-110">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <div>
          <h3 class="font-bold text-gray-900 text-lg">Confidentialité totale</h3>
          <p class="text-gray-500 text-sm leading-relaxed mt-1">Vos recherches sont anonymes. Aucune donnée n'est partagée avec des tiers et vos traces sont effacées après usage.</p>
        </div>
      </div>

      <div class="flex items-start gap-5 group">
        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-brand/10 flex items-center justify-center text-brand transition-transform group-hover:scale-110">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <div>
          <h3 class="font-bold text-gray-900 text-lg">Localisation en temps réel</h3>
          <p class="text-gray-500 text-sm leading-relaxed mt-1">Obtenez une position précise sur une carte interactive dès que le destinataire valide le lien sécurisé.</p>
        </div>
      </div>

      <div class="flex items-start gap-5 group">
        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-brand/10 flex items-center justify-center text-brand transition-transform group-hover:scale-110">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <div>
          <h3 class="font-bold text-gray-900 text-lg">Couverture mondiale</h3>
          <p class="text-gray-500 text-sm leading-relaxed mt-1">Peu importe l'opérateur ou le pays, notre service fonctionne partout où il y a une connexion internet.</p>
        </div>
      </div>

      <div class="flex items-start gap-5 group">
        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-brand/10 flex items-center justify-center text-brand transition-transform group-hover:scale-110">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
          </svg>
        </div>
        <div>
          <h3 class="font-bold text-gray-900 text-lg">Aucune application requise</h3>
          <p class="text-gray-500 text-sm leading-relaxed mt-1">Pas besoin d'installer de logiciel sur votre téléphone ou sur celui de la personne à localiser.</p>
        </div>
      </div>

    </div>
  </div>

  <div class="relative">
    <img src="{{ asset('assets/images/about-left-image.png') }}" 
         alt="About Geolocalyz" 
         class="w-full max-w-[500px] mx-auto transition-transform duration-500 hover:scale-105">
  </div>

</section>

<!-- HOW IT WORKS -->
<section id="how-it-works-section" class="max-w-7xl mx-auto px-6 py-32 relative overflow-hidden">
  
  <div class="text-center mb-24">
    <span class="text-brand font-bold uppercase tracking-widest text-sm">Processus</span>
    <h2 class="text-4xl lg:text-5xl font-black text-gray-900 mt-2">
      Comment fonctionne <span class="text-brand">Geolocalyz</span> ?
    </h2>
  </div>

  <div class="relative">
    <div class="hidden lg:block absolute left-1/2 top-0 bottom-0 w-[2px] bg-gradient-to-b from-brand/0 via-brand/40 to-brand/0 -translate-x-1/2"></div>

    <div class="space-y-32">
      
      <div class="relative grid lg:grid-cols-2 gap-12 items-center text-center lg:text-right">
        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-white border-4 border-brand rounded-full items-center justify-center font-black text-brand z-10 shadow-lg shadow-brand/20">1</div>
        
        <div class="lg:pr-24 order-2 lg:order-1 flex flex-col items-center lg:items-end">
          <div class="inline-flex p-3 rounded-2xl bg-brand/10 text-brand mb-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
          </div>
          <h3 class="text-2xl font-black text-gray-900 mb-4">Indiquez le numéro</h3>
          <p class="text-gray-500 text-lg leading-relaxed max-w-md">
            Saisissez simplement le numéro de téléphone que vous souhaitez localiser. Notre système s'adapte automatiquement à l'indicatif international.
          </p>
        </div>
        
        <div class="order-1 lg:order-2">
          <img src="{{ asset('assets/images/Step-1.png') }}" alt="Étape 1" class="w-full max-w-[400px] mx-auto drop-shadow-2xl hover:scale-105 transition-transform duration-500">
        </div>
      </div>

      <div class="relative grid lg:grid-cols-2 gap-12 items-center text-center lg:text-left">
        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-white border-4 border-brand rounded-full items-center justify-center font-black text-brand z-10 shadow-lg shadow-brand/20">2</div>
        
        <div class="order-1">
          <img src="{{ asset('assets/images/Step-2.png') }}" alt="Étape 2" class="w-full max-w-[400px] mx-auto drop-shadow-2xl hover:scale-105 transition-transform duration-500">
        </div>

        <div class="lg:pl-24 order-2 flex flex-col items-center lg:items-start">
          <div class="inline-flex p-3 rounded-2xl bg-brand/10 text-brand mb-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <h3 class="text-2xl font-black text-gray-900 mb-4">Envoyez le message</h3>
          <p class="text-gray-500 text-lg leading-relaxed max-w-md">
            Personnalisez ou utilisez notre message type sécurisé contenant le lien de suivi. Une fois envoyé, le destinataire reçoit une notification SMS instantanée.
          </p>
        </div>
      </div>

      <div class="relative grid lg:grid-cols-2 gap-12 items-center text-center lg:text-right">
        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-white border-4 border-brand rounded-full items-center justify-center font-black text-brand z-10 shadow-lg shadow-brand/20">3</div>
        
        <div class="lg:pr-24 order-2 lg:order-1 flex flex-col items-center lg:items-end">
          <div class="inline-flex p-3 rounded-2xl bg-brand/10 text-brand mb-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          </div>
          <h3 class="text-2xl font-black text-gray-900 mb-4">Suivez sur la carte</h3>
          <p class="text-gray-500 text-lg leading-relaxed max-w-md">
            Dès que le lien est ouvert, la position s'affiche en temps réel sur votre tableau de bord. Précis, rapide et extrêmement fiable.
          </p>
        </div>

        <div class="order-1 lg:order-2">
          <img src="{{ asset('assets/images/Step-3.png') }}" alt="Étape 3" class="w-full max-w-[400px] mx-auto drop-shadow-2xl hover:scale-105 transition-transform duration-500">
        </div>
      </div>

    </div>
  </div>
</section>

<div class="text-center mt-16 mb-16">
  <a href="{{ route('addNumber') }}" class="group relative w-full max-w-sm mx-auto md:w-auto md:max-w-none bg-orange-500 text-white py-6 px-16 rounded-full text-xl font-black shadow-[0_20px_40px_rgba(249,115,22,0.3)] uppercase tracking-[0.15em] transition-all duration-300 hover:scale-105 active:scale-95 overflow-hidden inline-block">
    <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>
    <span class="relative z-10">Localiser maintenant</span>
  </a></div>

<!-- FAQ -->
<section id="faq-section" class="max-w-4xl mx-auto px-6 pb-32">
  <h2 class="text-center text-3xl font-bold mb-14">FAQ</h2>

  <div class="space-y-5">
    <details class="group bg-white rounded-2xl px-6 py-5 shadow-lg">
      <summary class="flex justify-between cursor-pointer font-medium">
        Comment localiser un numéro de téléphone ?
        <span class="group-open:rotate-180 transition">⌄</span>
      </summary>
      <p class="mt-3 text-sm text-gray-600">
        Entrez le numéro de téléphone et envoyez un lien de suivi.
      </p>
    </details>

    <details class="group bg-white rounded-2xl px-6 py-5 shadow-lg">
      <summary class="flex justify-between cursor-pointer font-medium">
        Est-ce légal ?
        <span class="group-open:rotate-180 transition">⌄</span>
      </summary>
      <p class="mt-3 text-sm text-gray-600">
        Oui, le consentement de l'utilisateur est requis.
      </p>
    </details>

    <details class="group bg-white rounded-2xl px-6 py-5 shadow-lg">
      <summary class="flex justify-between cursor-pointer font-medium">
        Dois-je installer une application ?
        <span class="group-open:rotate-180 transition">⌄</span>
      </summary>
      <p class="mt-3 text-sm text-gray-600">
        Aucune installation n'est nécessaire.
      </p>
    </details>
  </div>
</section>

<!-- CTA -->
<section id="main-cta-section" class="max-w-7xl mx-auto px-6 py-20 lg:py-28">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
    
    <div class="order-2 md:order-1 relative">
      <img src="{{ asset('assets/images/image-women-2.png') }}" 
           alt="Prêt à commencer" 
           class="w-full max-w-[350px] lg:max-w-[450px] mx-auto transition-transform duration-700 ease-in-out"
           style="animation: float 6s ease-in-out infinite;">
    </div>

    <div class="order-1 md:order-2 flex flex-col">
      
      <div class="text-center md:text-left space-y-6">
        <div class="inline-block px-4 py-2 rounded-xl bg-brand/10 text-brand font-bold text-sm uppercase tracking-widest mb-2">
          100% Anonyme & Sécurisé
        </div>
        
        <h2 class="text-4xl lg:text-6xl font-black text-gray-900 leading-[1.1]">
          Prêt à localiser <br>
          <span class="text-brand">votre premier</span> numéro ?
        </h2>
        
        <p class="text-gray-500 text-lg lg:text-xl font-medium max-w-lg mx-auto md:mx-0">
          Rejoignez Geolocalyz aujourd'hui et obtenez des résultats précis en moins de 2 minutes. Aucune installation technique requise.
        </p>
      </div>

      <div class="mt-12 md:mt-10 text-center md:text-left order-3 md:order-none">
        <a href="{{ route('addNumber') }}" class="group relative w-full max-w-sm mx-auto md:w-auto md:max-w-none bg-orange-500 text-white py-6 px-16 rounded-full text-xl font-black shadow-[0_20px_40px_rgba(249,115,22,0.3)] uppercase tracking-[0.15em] transition-all duration-300 hover:scale-105 active:scale-95 overflow-hidden inline-block">
          <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>
          <span class="relative z-10">Localiser maintenant</span>
        </a>
        
        <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-6">
          <div class="flex items-center gap-2 text-sm text-gray-500 font-bold">
            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            Sans engagement
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-500 font-bold">
            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            Instantané
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
  }
  @keyframes shimmer {
    100% { transform: translateX(100%); }
  }
</style>
<script>
  const contentData = {
    1: {
      title: '<span class="text-brand">Geolocalyz</span> permet de localiser par numéro.',
      desc: 'Géolocalisez un numéro, identifiez son propriétaire et obtenez des informations utiles instantanément.',
      msg: 'Salut ! Peux-tu partager ta position avec Geolocalyz ? <span class="text-blue-500 font-bold underline">geoloc.ly/track=92...</span>'
    },
    2: {
      title: '<span class="text-brand">Geolocalyz</span> identifie par le nom.',
      desc: 'Accédez à l\'identité complète d\'un correspondant et vérifiez sa fiabilité via notre base de données.',
      msg: 'Système : Utilisateur identifié comme "Marc L." via la base Geolocalyz. Souhaitez-vous le bloquer ?'
    },
    3: {
      title: '<span class="text-brand">Geolocalyz</span> vérifie les fuites.',
      desc: 'Protégez votre identité numérique en surveillant les fuites de données liées à votre numéro de téléphone.',
      msg: 'Alerte : Votre numéro est apparu dans une base compromise. Geolocalyz vous conseille de sécuriser vos accès.'
    }
  };

  function switchTab(id) {
    document.querySelectorAll('.tab-btn').forEach((btn, index) => {
      btn.classList.remove('active', 'bg-brand/10', 'border-brand');
      btn.classList.add('bg-white', 'border-transparent');
      const icon = btn.querySelector('.icon-container');
      icon.classList.replace('bg-brand', 'bg-gray-100');
      icon.querySelector('svg').classList.replace('text-white', 'text-brand');
      document.getElementById(`desc-${index + 1}`).classList.add('hidden');
    });

    const activeBtn = document.getElementById(`btn-${id}`);
    activeBtn.classList.add('active');
    activeBtn.classList.remove('border-transparent', 'bg-white');
    const activeIcon = activeBtn.querySelector('.icon-container');
    activeIcon.classList.replace('bg-gray-100', 'bg-brand');
    activeIcon.querySelector('svg').classList.replace('text-brand', 'text-white');
    document.getElementById(`desc-${id}`).classList.remove('hidden');

    document.getElementById('display-title').innerHTML = contentData[id].title;
    document.getElementById('display-desc').innerText = contentData[id].desc;
    document.getElementById('phone-msg').innerHTML = contentData[id].msg;
  }
</script>
<script>
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileMenuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
<!-- FOOTER -->
@include('layouts.footer')
</body>
</html>
