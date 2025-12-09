<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('meta_description', 'Default description')">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>@yield('title', 'GeoLocalyz - SaaS de géolocalisation')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-space-dynamic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
<style>
/* Custom Header Styles for alignment */
/* Removed padding-top from body */

.header-area {
  background-color: #fff;
  height: 80px;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.15);
}

.header-area .main-nav {
  background: transparent;
  display: flex;
  align-items: center; /* Vertically centers children */
  justify-content: space-between; /* Distributes items horizontally: Logo left, Nav middle, Button right */
  width: 100%;
  height: 80px; /* Ensure main-nav takes full header height */
  padding: 0 15px; /* Add some padding to the sides */
}

.header-area .main-nav .logo img {
  height: 50px; /* Logo height */
  flex-shrink: 0; /* Prevent logo from shrinking */
}

.header-area .main-nav .nav {
  display: flex;
  align-items: center; /* Vertically centers li items */
  list-style: none; /* Remove bullet points */
  padding: 0;
  margin: 0 auto; /* This centers the ul.nav block between logo and button */
  flex-grow: 0; /* Ensure nav block doesn't take all available space */
}

.header-area .main-nav .nav li {
  padding: 0 15px; /* Spacing between nav items */
}

.header-area .main-nav .nav li a {
  display: block;
  font-weight: 500;
  font-size: 15px;
  color: #1e1e1e;
  text-transform: capitalize;
  height: 50px; /* Explicit height */
  line-height: 50px; /* Center text vertically */
  border: transparent;
  letter-spacing: 1px;
  text-decoration: none; /* Remove underline */
}

.header-area .main-nav .nav li a:hover,
.header-area .main-nav .nav li a.active {
  color: #33d7bb!important;
}

.main-red-button {
  flex-shrink: 0; /* Prevent button from shrinking */
}

.main-red-button a {
  display: inline-block;
  background-color: #33d7bb; /* Green color */
  font-size: 15px;
  font-weight: 400;
  color: #fff;
  text-transform: capitalize;
  padding: 12px 25px;
  border-radius: 25px; /* Softer rounded corners */
  letter-spacing: 0.25px;
  text-decoration: none; /* Remove underline */
  line-height: 26px; /* Adjust based on padding 12px top + 12px bottom = 24px, plus a couple pixels */
}

/* Hide mobile trigger on desktop */
.header-area .main-nav .menu-trigger {
  display: none;
}

/* Compensate for fixed header, pushing main content down */
.main-banner {
  padding-top: 80px;
}
</style>
</head>
<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-fixed">
  <div class="container">
      <div class="row">
          <div class="col-12">
              <nav class="main-nav">
                  <a href="{{ url('/') }}" class="logo">
                      <img src="{{ asset('assets/images/logo-principal.png') }}" alt="GeoLocalyz" style="height: 50px;"/>
                  </a>
                  <ul class="nav">
                      <li><a href="#accueil" class="active">Accueil</a></li>
                      <li><a href="#features">Fonctionnalités</a></li>
                      <li><a href="#contact">Contact</a></li>
                  </ul>
                  <div class="main-red-button">
                      <a href="#contact">Commencer</a>
                  </div>
              </nav>
          </div>
      </div>
  </div>
</header>
<!-- ***** Header Area End ***** -->

    @yield('content')

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.25s">
          <p>© 2025 Geolocalyz SaaS — Tous droits réservés. 
          
          <br>Développement & Optimisation : Votre solution de géolocalisation professionnelle</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/animation.js') }}"></script>
  <script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.0/lottie.min.js"></script>
  <script src="{{ asset('assets/js/templatemo-custom.js') }}"></script>

  <script>
    var animation = lottie.loadAnimation({
      container: document.getElementById('lottie-animation'),
      renderer: 'svg',
      loop: true,
      autoplay: true,
      path: '{{ asset('assets/images/Lottie.json') }}'
    });
  </script>

  <script>
    let lastScrollTop = 0;
    const header = document.querySelector('.header-area');
    // Ensure header exists before trying to get its offsetHeight
    const headerHeight = header ? header.offsetHeight : 0; 

    window.addEventListener('scroll', function() {
      let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      if (scrollTop > lastScrollTop && scrollTop > headerHeight) {
        // Scrolling down and past the header
        if (header) header.style.transform = 'translateY(-100%)';
      } else {
        // Scrolling up
        if (header) header.style.transform = 'translateY(0)';
      }
      lastScrollTop = scrollTop;
    });

    // Show header on mouse passage near the top
    let mouseMoveTimer;
    document.body.addEventListener('mousemove', function(e) {
      // If mouse is near top (e.clientY < 50px) and header is hidden
      if (e.clientY < 50 && header && header.style.transform === 'translateY(-100%)') {
        header.style.transform = 'translateY(0)';
        clearTimeout(mouseMoveTimer); // Clear any previous timer
        // Set a timer to potentially re-hide the header if the mouse leaves the top area
        mouseMoveTimer = setTimeout(() => {
          // Check if still scrolled down and mouse is not at the top (to avoid immediate re-hide if still at top)
          if (window.pageYOffset > headerHeight && e.clientY >= 50) { 
            header.style.transform = 'translateY(-100%)';
          }
        }, 1500); // Re-hide after 1.5 seconds if conditions met
      } else if (e.clientY >= 50 && header && header.style.transform === 'translateY(0)') {
         // If mouse moved away from top and header is visible, clear the timer
         clearTimeout(mouseMoveTimer);
      }
    });

    // Add transition for smooth hide/show
    if (header) header.style.transition = 'transform 0.3s ease-in-out';
  </script>
</body>
</html>
