 <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <div class="py-2 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 d-none d-lg-block">
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a> 
            <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a> 
            <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@mydomain.com</a> 
          </div>
          <div class="col-lg-3 text-right">
            <a href="#"><span class="icon-facebook d-none d-lg-inline-block"></span></a>
            <a href="#"><span class="icon-twitter d-none d-lg-inline-block"></span></a>
            <a href="#"><span class="icon-instagram d-none d-lg-inline-block"></span></a>

            <!-- Menu toggle hanya untuk mobile -->
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black ms-3">
              <span class="icon-menu h3"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner" style="z-index: 50;">

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="site-logo">
            <h1 class="text-white fw-bolder bg-primary px-3 py-2 rounded">Lib-Polman</h1>
          </div>
          <div>
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="{{ request()->routeIs('guest.dashboard') ? 'active' : '' }}">
                  <a href="{{ route('guest.dashboard') }}" class="nav-link text-left">Beranda</a>
                </li>
                <li class="{{ request()->routeIs('guest.berita*') ? 'active' : '' }}">
                  <a href="{{ route('guest.berita') }}" class="nav-link text-left">Berita</a>
                </li>
                <li class="{{ request()->routeIs('guest.galeri*') ? 'active' : '' }}">
                  <a href="{{ route('guest.galeri') }}" class="nav-link text-left">Galeri</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

    </header>