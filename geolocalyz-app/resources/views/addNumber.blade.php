<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Geolocalyz – Localiser un téléphone</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19/build/css/intlTelInput.css">
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { brand: '#33d7bb' }
        }
      }
    }
  </script>
  <style>
    /* EFFET GLOW VERT DERRIÈRE LE FORMULAIRE */
    .form-glow {
      box-shadow: 0 0 80px -10px rgba(51, 215, 187, 0.35);
    }

    /* FIX INTL-TEL-INPUT */
    .iti { width: 100%; display: block; }
    .iti__selected-flag {
      background-color: transparent !important;
      padding-left: 28px !important;
      border-radius: 3.5rem 0 0 3.5rem !important;
    }
    .iti__selected-flag:focus, .iti__selected-flag:active { outline: none !important; }
    .iti--separate-dial-code .iti__selected-dial-code {
      font-weight: 900 !important;
      color: #111827 !important;
      font-size: 1.1rem;
      margin-left: 10px;
    }
    .iti__country-list {
      border-radius: 2rem !important;
      border: none !important;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
      margin-top: 12px !important;
    }
    #phone {
      border: none !important;
      outline: none !important;
      box-shadow: none !important;
      background: transparent !important;
    }
  </style>
</head>
<body class="bg-[#f8fafc] h-screen flex flex-col overflow-x-hidden">

@include('layouts.user.header-user')

<main id="main-content" class="flex-grow flex items-center justify-center px-6 relative pt-12">
  
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand/5 rounded-full blur-[120px]"></div>
  </div>

  <div class="max-w-4xl w-full text-center relative z-10">
    
    <div class="inline-flex items-center gap-3 px-4 py-2 bg-white rounded-full shadow-sm border border-gray-100 mb-6">
       <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
        #1 Choice in <span id="country-name-badge" class="text-brand">Mauritius</span>
      </p>
    </div>

    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-gray-900 leading-tight mb-4 tracking-tight">
      Localisez <span class="text-brand">n’importe quel</span> <br class="hidden md:block text-6xl"> téléphone mobile.
    </h1>

    <div class="flex flex-wrap justify-center gap-3 mb-8">
        <div class="flex items-center gap-2 px-3 py-1.5 bg-white/80 rounded-full border border-gray-100 shadow-sm">
            <svg class="w-3.5 h-3.5 text-gray-800" fill="currentColor" viewBox="0 0 24 24"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.1 2.48-1.34.03-1.77-.79-3.3-.79-1.53 0-2.01.76-3.27.82-1.31.05-2.31-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.24-1.99 1.1-3.15-1.02.04-2.25.68-2.98 1.53-.66.75-1.23 1.93-1.09 3.05 1.13.09 2.24-.6 2.97-1.43Z"/></svg>
            <span class="text-[9px] font-black text-gray-700 uppercase tracking-widest">iOS</span>
        </div>
        <div class="flex items-center gap-2 px-3 py-1.5 bg-white/80 rounded-full border border-gray-100 shadow-sm">
            <svg class="w-3.5 h-3.5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a9.9 9.9 0 0114.142 0M2.05 8.05a15.554 15.554 0 0121.9 0"/></svg>
            <span class="text-[9px] font-black text-gray-700 uppercase tracking-widest">Tous réseaux</span>
        </div>
    </div>

    <div class="form-glow bg-white p-3 md:p-4 rounded-[3.5rem] border border-white max-w-2xl mx-auto transition-all duration-500 hover:scale-[1.01]">
      <form action="{{ route('createLocationRequest') }}" method="POST" class="flex flex-col md:flex-row gap-2">
        @csrf
        <div class="flex-grow flex items-center bg-gray-50 rounded-[3rem] focus-within:bg-white focus-within:ring-2 focus-within:ring-brand/20 transition-all">
          <input id="phone" type="tel" name="phoneNumber"class="w-full font-black text-xl text-gray-800 placeholder:text-gray-300 py-6 px-4">
        </div>
        <button type="submit" class="bg-brand text-white px-10 py-6 rounded-[3rem] font-black uppercase tracking-[0.15em] text-sm shadow-xl shadow-brand/20 hover:bg-emerald-400 transition-all active:scale-95">
          Localiser
        </button>
      </form>
    </div>

    <div class="flex justify-center gap-6 mt-8">
      <div class="flex items-center gap-2 px-5 py-2.5 bg-white/40 backdrop-blur-sm rounded-xl border border-white/50">
        <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Confidentiel</span>
      </div>
      <div class="flex items-center gap-2 px-5 py-2.5 bg-white/40 backdrop-blur-sm rounded-xl border border-white/50">
        <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">SSL Encrypt</span>
      </div>
    </div>
  </div>
</main>


@include('layouts.user.footer-user')

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19/build/js/intlTelInput.min.js"></script>
<script>
  const input = document.querySelector("#phone");
  const countryBadge = document.querySelector("#country-name-badge");
  const iti = window.intlTelInput(input, {
    initialCountry: "mu",
    separateDialCode: true,
    showSelectedDialCode: true,
    countrySearch: false,
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19/build/js/utils.js",
  });
  const updateBadge = () => {
    const countryData = iti.getSelectedCountryData();
    if (countryData.name) {
      countryBadge.textContent = countryData.name.split(' (')[0];
    }
  };
  input.addEventListener("countrychange", updateBadge);
  updateBadge();
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('user-header');
    const mainContent = document.getElementById('main-content');
    if (header && mainContent) {
      const adjustMainContentPadding = () => {
        mainContent.style.paddingTop = `${header.offsetHeight}px`;
      };

      adjustMainContentPadding();
      window.addEventListener('resize', adjustMainContentPadding);
    }
  });
</script>
</body>
</html>