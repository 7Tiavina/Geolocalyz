<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Geolocalyz – Localiser un téléphone</title>
  <style>
    .glow-effect {
      box-shadow: 0 0 50px 10px rgba(51, 215, 187, 0.3);
    }
    .tab-btn.active {
      background-color: rgba(51, 215, 187, 0.1);
      border-color: #33d7bb;
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

<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-20 items-center">
  <div class="space-y-6">
    <h1 class="text-5xl font-extrabold leading-tight">
      Localisez <br> un téléphone <br>
      <span class="text-orange-400">par son numéro</span>
    </h1>

    <!-- Badge dynamique -->
    <div id="country-badge"
         class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-400 to-amber-300 text-slate-900 px-4 py-2 rounded-full font-semibold shadow">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-5h2v2H9v-2zm0-4h2v3H9V7z"/></svg>
      <span>#1 Choice in <span class="country-name">Mauritius</span></span>
    </div>

    <p class="text-lg text-slate-900">Ready to find out the location of the phone number?</p>

    <!-- Sélecteur pays + input -->
    <div class="flex gap-3">
      <input id="phone" type="tel"
             class="border rounded-xl px-4 py-3 w-full outline-none focus:ring-2 focus:ring-orange-400">
      <button class="bg-orange-500 hover:bg-orange-600 text-white px-8 rounded-xl font-semibold shadow">
        DÉTECTER
      </button>
    </div>

     <!-- Image AOP -->
    <div class="flex gap-4">
        <img src="{{ asset('assets/images/logo-AOP.png') }}" alt="100 % légal" class="h-24">
    </div>

    <p class="text-xs text-slate-400">Confidential & Secure – it doesn’t matter where you are or what device you’re using.</p>
  </div>

  <!-- Colonne Lottie -->
  <div class="relative">
    <div id="lottie-animation" class="w-full h-[420px]"></div>
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

    <div class="relative flex justify-center order-1 lg:order-2">
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

    <div class="space-y-8 order-3">
      <h2 id="display-title" class="text-5xl font-black text-gray-900 leading-[1.1] tracking-tight">
        <span class="text-brand">Geolocalyz</span> permet d'obtenir des infos fiables.
      </h2>
      <p id="display-desc" class="text-gray-500 text-xl leading-relaxed">
        Géolocalisez un numéro, identifiez son propriétaire et obtenez des informations utiles instantanément.
      </p>
      <button class="bg-orange-500 hover:bg-orange-600 text-white font-black py-5 px-14 rounded-full text-xl transition-all hover:scale-105 shadow-lg shadow-orange-200 uppercase tracking-widest">
        Essayer
      </button>
    </div>

  </div>
</section>



<!-- TESTIMONIALS -->
<section class="max-w-7xl mx-auto px-6 py-28 text-center">
  <h2 class="text-3xl font-bold mb-16">
    Écoutez directement <br>
    les vrais utilisateurs de <span class="text-brand">Geolocalyz</span>
  </h2>

  <div class="grid md:grid-cols-3 gap-10">
    <div class="bg-white p-8 rounded-2xl shadow-lg">
      ⭐⭐⭐⭐⭐
      <p class="mt-4 text-sm text-gray-600">
        Super expérience, super rapide et précis.
      </p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg">
      ⭐⭐⭐⭐⭐
      <p class="mt-4 text-sm text-gray-600">
        Facile à utiliser et très fiable.
      </p>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-lg">
      ⭐⭐⭐⭐⭐
      <p class="mt-4 text-sm text-gray-600">
        M'a aidé à localiser un téléphone en quelques minutes.
      </p>
    </div>
  </div>
</section>

<!-- WHY GEOLOCALYZ -->
<section class="max-w-7xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-24 items-center">
  <div>
    <h2 class="text-3xl font-bold mb-10">Pourquoi Geolocalyz ?</h2>

    <ul class="space-y-6 text-sm">
      <li>🛡️ Confidentialité totale</li>
      <li>📍 Localisation en temps réel</li>
      <li>🌍 Fonctionne dans le monde entier</li>
      <li>⚡ Rapide & précis</li>
      <li>📱 Aucune application requise</li>
    </ul>
  </div>

  <img src="{{ asset('assets/images/about-left-image.png') }}" class="w-[420px] mx-auto">
</section>

<!-- HOW IT WORKS -->
<section class="max-w-7xl mx-auto px-6 py-32">
  <h2 class="text-center text-3xl font-bold text-brand mb-32">
    Comment ça marche
  </h2>

  <div class="relative">
    <div class="hidden md:block absolute left-1/2 top-0 h-full border-l-2 border-dashed border-brand"></div>

    <div class="grid md:grid-cols-2 gap-y-40">

      <div class="md:pr-32 flex flex-col items-end text-right">
        <img src="{{ asset('assets/images/Step-1.png') }}" class="w-[450px] max-w-none">
        <h3 class="mt-8 text-xl font-semibold">Numéro de téléphone</h3>
        <p class="text-gray-500 max-w-md">
          Tapez le numéro de téléphone que vous souhaitez localiser.
        </p>
      </div>

      <div></div>
      <div></div>

      <div class="md:pl-32 flex flex-col items-start text-left">
        <img src="{{ asset('assets/images/Step-2.png') }}" class="w-[520px] max-w-none">
        <h3 class="mt-8 text-xl font-semibold">Envoyer le message</h3>
        <p class="text-gray-500 max-w-md">
          Envoyez un message sécurisé avec un lien de suivi.
        </p>
      </div>

      <div class="md:pr-32 flex flex-col items-end text-right">
        <img src="{{ asset('assets/images/Step-3.png') }}" class="w-[420px] max-w-none">
        <h3 class="mt-8 text-xl font-semibold">Voir l'emplacement</h3>
        <p class="text-gray-500 max-w-md">
          Affichez l'emplacement du téléphone sur une carte en direct.
        </p>
      </div>

      <div></div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="max-w-4xl mx-auto px-6 pb-32">
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
<section class="max-w-7xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-24 items-center">
  <img src="{{ asset('assets/images/image-women-2.png') }}" class="w-[420px] mx-auto">

  <div>
    <h2 class="text-4xl font-bold mb-6">
      Prêt à commencer ?
    </h2>
    <button class="bg-orange-500 text-white px-12 py-4 rounded-xl font-semibold">
      DÉTECTER MAINTENANT
    </button>
  </div>
</section>
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
<!-- FOOTER -->
@include('layouts.footer')
</body>
</html>
