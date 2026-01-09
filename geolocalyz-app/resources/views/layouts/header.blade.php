<!-- HEADER -->
<header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center transition-all duration-300" id="header-container">
    
    <a href="{{ url('/') }}" class="transition-transform hover:scale-105 flex-shrink-0">
      <img src="{{ asset('assets/images/logo-principal.png') }}" alt="Geolocalyz" class="h-9 lg:h-10 w-auto"/>
    </a>

    <nav class="hidden md:flex items-center gap-8">
      <a href="#why-geolocalyz-section" class="text-[10px] font-bold text-gray-500 hover:text-brand transition-colors uppercase tracking-[0.1em]">Pourquoi Geolocalyz</a>
      <a href="#how-it-works-section" class="text-[10px] font-bold text-gray-500 hover:text-brand transition-colors uppercase tracking-[0.1em]">Comment ça marche</a>
      <a href="#faq-section" class="text-[10px] font-bold text-gray-500 hover:text-brand transition-colors uppercase tracking-[0.1em]">FAQ</a>
      <a href="#contact-section" class="text-[10px] font-bold text-gray-500 hover:text-brand transition-colors uppercase tracking-[0.1em]">Contact</a>
      <div class="h-3 w-[1px] bg-gray-200 mx-1"></div>
      <a href="#" class="text-[10px] font-bold text-gray-500 hover:text-brand transition-colors uppercase tracking-[0.1em]">Connexion</a>
      <a href="#" class="bg-brand text-white px-5 py-2.5 rounded-full text-[10px] font-black shadow-lg shadow-brand/20 hover:scale-105 hover:shadow-brand/30 active:scale-95 transition-all uppercase tracking-widest">
        Démarrer
      </a>
    </nav>

    <div class="md:hidden">
      <button id="mobile-menu-button" class="p-2 text-gray-800 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
    </div>
  </div>
</header>

<div id="mobile-menu" class="fixed inset-0 z-[60] hidden">
  <div id="menu-overlay" class="absolute inset-0 bg-black/20 backdrop-blur-sm"></div>
  
  <nav class="absolute top-0 right-0 w-[280px] h-full bg-white shadow-2xl p-8 flex flex-col transition-transform">
    <div class="flex justify-end mb-8">
      <button id="close-menu" class="p-2 text-gray-400 hover:text-brand">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <div class="flex flex-col gap-6">
      <a href="#why-geolocalyz-section" class="mobile-link text-xs font-bold text-gray-600 uppercase tracking-widest">Pourquoi Geolocalyz</a>
      <a href="#how-it-works-section" class="mobile-link text-xs font-bold text-gray-600 uppercase tracking-widest">Comment ça marche</a>
      <a href="#faq-section" class="mobile-link text-xs font-bold text-gray-600 uppercase tracking-widest">FAQ</a>
      <a href="#contact-section" class="mobile-link text-xs font-bold text-gray-600 uppercase tracking-widest">Contact</a>
      <hr class="border-gray-50">
      <a href="#" class="text-xs font-bold text-gray-600 uppercase tracking-widest">Connexion</a>
      <a href="#" class="bg-brand text-white py-4 rounded-full text-center text-xs font-black shadow-lg shadow-brand/20 uppercase tracking-widest">
        Démarrer
      </a>
    </div>
  </nav>
</div>

<script>
  const header = document.getElementById('main-header');
  const headerContainer = document.getElementById('header-container');
  const menuBtn = document.getElementById('mobile-menu-button');
  const closeBtn = document.getElementById('close-menu');
  const mobileMenu = document.getElementById('mobile-menu');
  const overlay = document.getElementById('menu-overlay');
  const mobileLinks = document.querySelectorAll('.mobile-link'); // Already exists
  const allAnchorLinks = document.querySelectorAll('a[href^="#"]'); // Select all anchor links in the document

  // Scroll effect
  window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
      headerContainer.classList.replace('py-4', 'py-2');
      header.classList.add('shadow-md');
    } else {
      headerContainer.classList.replace('py-2', 'py-4');
      header.classList.remove('shadow-md');
    }
  });

  // Toggle Menu functions
  const openMenu = () => {
    mobileMenu.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Bloque le scroll derrière
  };

  const closeMenu = () => {
    mobileMenu.classList.add('hidden');
    document.body.style.overflow = ''; // Réactive le scroll
  };

  menuBtn.addEventListener('click', openMenu);
  closeBtn.addEventListener('click', closeMenu);
  overlay.addEventListener('click', closeMenu);
  
  // Smooth scroll for all anchor links
  allAnchorLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault(); // Prevent default jump behavior
      const targetId = this.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth'
        });
      }

      // Close mobile menu if clicked from there
      if (mobileMenu.classList.contains('hidden') === false) { // If menu is open
        closeMenu();
      }
    });
  });

  // Fermer le menu quand on clique sur un lien (ancre) (This was already handled by the above forEach loop for all anchor links)
  // mobileLinks.forEach(link => {
  //   link.addEventListener('click', closeMenu);
  // });
</script>