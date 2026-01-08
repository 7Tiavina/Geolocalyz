<!-- HEADER -->
<header class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
  <a href="{{ url('/') }}">
    <img src="{{ asset('assets/images/logo-principal.png') }}" alt="Geolocalyz" style="height: 50px;"/>
  </a>
  <nav class="hidden md:flex gap-8 text-sm">
    <a href="#" class="hover:text-brand">How it works</a>
    <a href="#" class="hover:text-brand">Features</a>
    <a href="#" class="hover:text-brand">FAQ</a>
    <a href="#" class="hover:text-brand">Login</a>
  </nav>
  <div class="md:hidden">
    <button id="mobile-menu-button" class="text-gray-800 hover:text-brand focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
      </svg>
    </button>
  </div>
</header>
<div id="mobile-menu" class="hidden md:hidden">
  <nav class="px-6 pt-2 pb-4 space-y-1 sm:px-3">
    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:text-brand hover:bg-gray-50">How it works</a>
    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:text-brand hover:bg-gray-50">Features</a>
    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:text-brand hover:bg-gray-50">FAQ</a>
    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:text-brand hover:bg-gray-50">Login</a>
  </nav>
</div>
