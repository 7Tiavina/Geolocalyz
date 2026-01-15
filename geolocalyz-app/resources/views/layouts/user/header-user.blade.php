<!-- HEADER -->
<header id="user-header" class="w-full px-6 py-6 relative z-20 bg-white/50 backdrop-blur-md border-b border-gray-100">
  <div class="max-w-7xl mx-auto flex justify-between items-center">
    <a href="{{ url('/') }}" class="transition-transform hover:scale-105 flex-shrink-0">
      <img src="{{ asset('assets/images/logo-principal.png') }}" alt="Logo" class="h-8 w-auto">
    </a>
    <nav class="flex items-center gap-6">
        @guest
            <a href="{{ route('loginUser') }}" class="text-[10px] font-black text-gray-400 hover:text-brand transition-colors uppercase tracking-[0.2em]">Connexion</a>
        @endguest
        @auth
            <a href="{{ route('accessDashboard') }}" class="text-[10px] font-black text-gray-400 hover:text-brand transition-colors uppercase tracking-[0.2em]">Tableau de bord</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-[10px] font-black text-gray-400 hover:text-brand transition-colors uppercase tracking-[0.2em]">Déconnexion</button>
            </form>
        @endauth
    </nav>
  </div>
</header>