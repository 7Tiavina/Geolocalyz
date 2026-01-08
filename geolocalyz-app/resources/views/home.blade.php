<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Geolocalyz – Localiser un téléphone</title>

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
  <div>
    <h1 class="text-5xl font-extrabold leading-tight mb-6">
      Localisez <br>
      un téléphone <br>
      <span class="text-brand">par son numéro</span>
    </h1>

    <div class="flex gap-4 mb-6">
      <span class="bg-brand text-white px-5 py-2 rounded-full text-sm font-medium">
        🌍 Fonctionne dans le monde entier
      </span>
    </div>

    <div class="flex gap-3 mb-6">
      <input type="text" placeholder="+230 5X XXX XXX"
        class="border rounded-xl px-4 py-3 w-64 outline-none focus:ring-2 focus:ring-brand">
      <button class="bg-orange-500 hover:bg-orange-600 text-white px-8 rounded-xl font-semibold">
        DÉTECTER
      </button>
    </div>

    <div class="flex gap-6 text-sm text-gray-500">
      <span>🔒 Sécurisé</span>
      <span>✔️ 100% Légal</span>
    </div>
  </div>

  <div class="relative">
    <div id="lottie-animation" class="w-full h-[420px]"></div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.0/lottie.min.js"></script>
<script>
  lottie.loadAnimation({
    container: document.getElementById('lottie-animation'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: '{{ asset('assets/images/Lottie.json') }}'
  });
</script>

<!-- FEATURES SHORT -->
<section class="max-w-7xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-24 items-center">
  <div>
    <h2 class="text-3xl font-bold mb-6">
      Geolocalyz trouve <br>
      des informations complètes <br>
      par numéro de téléphone
    </h2>
    <button class="bg-orange-500 text-white px-10 py-4 rounded-xl font-semibold">
      ESSAYER MAINTENANT
    </button>
  </div>

  <img src="{{ asset('assets/images/services-left-image.png') }}" class="w-[420px] mx-auto">
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
        <img src="{{ asset('assets/images/Step-1.png') }}" class="w-[520px] max-w-none">
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
        <img src="{{ asset('assets/images/Step-3.png') }}" class="w-[520px] max-w-none">
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

<!-- FOOTER -->
@include('layouts.footer')
</body>
</html>
