<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'STORE')</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>document.addEventListener("DOMContentLoaded", () => lucide.createIcons());</script>

  <!-- Custom CSS -->
  <link href="{{ asset('css/store.css') }}" rel="stylesheet">

  <style>
    /* Navbar hover underline animation */
    .d-md-flex.gap-4 a { text-decoration: none !important; position: relative; padding-bottom: 2px; color: #212529 !important; }
    .d-md-flex.gap-4 a::after { content: ''; position: absolute; width: 0; height: 2px; bottom: 0; left: 0; background-color: #212529; transition: width 0.3s ease-in-out; }
    .d-md-flex.gap-4 a:hover::after { width: 100%; }
    .d-md-flex.gap-4 a.current-page, .d-md-flex.gap-4 a.current-page:hover { font-weight: 600 !important; color: #212529 !important; }
    .d-md-flex.gap-4 a.current-page::after, .d-md-flex.gap-4 a.current-page:hover::after { width: 100%; }
    .collapse a.current-page { font-weight: 600 !important; }

    /* Hero shop button arrow animation */
    .hero-shop-btn { position: relative; overflow: hidden; padding-right: 3rem !important; transition: all 0.3s ease-in-out; }
    .hero-shop-btn::after { content: '→'; position: absolute; top: 50%; font-size: 1.5rem; right: 1.5rem; transform: translateY(-50%) translateX(200%); opacity: 0; transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1); }
    .hero-shop-btn:hover { padding-right: 5rem !important; }
    .hero-shop-btn:hover::after { right: 1.5rem; transform: translateY(-50%) translateX(0); opacity: 1; }

    /* Footer links */
    .footer-link { color: #6c757d; text-decoration: none; transition: color 0.3s ease; }
    .footer-link:hover { color: #000; }

    .btn-outline-primary {
      transition: all 0.3s ease;
    }
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
        transform: translateY(-2px);
    }

  </style>
</head>
<body>
  <!-- Header / Navbar -->
  <header class="sticky-top bg-white border-bottom py-2">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ route('store') }}" class="d-flex align-items-center text-decoration-none">
        <div class=" rounded d-flex align-items-center justify-content-center" style="width:65px; height:65px;">
          <img class="w-100 h-100 object-fit-cover" src="/image/image copy 2.png" alt="">
          <!-- <span class="text-white fw-bold">S</span> -->
        </div>
        <!-- <span class="fw-bold fs-4 text-dark">STORE</span> -->
      </a>

      <!-- Desktop Nav -->
      <nav class="d-none d-md-flex align-items-center gap-4">
        <a href="{{ route('store') }}" class="text-dark @if(Request::routeIs('store')) current-page fw-semibold @endif">Home</a>
        <a href="{{ route('shop') }}" class="text-dark @if(Request::routeIs('shop')) current-page @endif">Shop</a>
        <a href="{{ route('about') }}" class="text-dark @if(Request::routeIs('about')) current-page @endif">About</a>
        <a href="{{ route('contact') }}" class="text-dark @if(Request::routeIs('contact')) current-page @endif">Contact</a>
      </nav>

      <!-- Icons & Login/Logout -->
      <div class="d-flex align-items-center gap-3">
        @auth
          <a href="{{ route('orders.history') }}" class="btn btn-outline-dark btn-sm d-flex align-items-center gap-1 px-3 py-1">
              <i class="bi bi-clock-history"></i> History
          </a>
        @endauth
        <a href="{{ route('cart.index') }}" class="nav-link position-relative">
          <i data-lucide="shopping-cart" class="bi bi-cart2 p-1" style="font-size: 20px;"></i>
          <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ count(session('cart', [])) }}
          </span>
        </a>
        


        <!-- Desktop Login/Logout -->
        @auth
        <form action="{{ route('logout') }}" method="POST" id="desktopLogoutForm" class="d-none d-md-flex m-0">
          @csrf
          <button type="button" class="btn btn-outline-dark btn-sm px-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm">Login</a>
        @endauth

        <!-- Mobile menu toggle -->
        <button class="btn btn-light d-md-none rounded-circle p-2" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
          <i data-lucide="menu"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div class="collapse d-md-none border-top" id="mobileMenu">
      <div class="container py-3">
        <nav class="d-flex flex-column gap-2 text-center"> 
          <a href="{{ route('store') }}" class="text-dark @if(Request::routeIs('store')) current-page fw-semibold @endif">Home</a>
          <a href="{{ route('shop') }}" class="text-dark @if(Request::routeIs('shop')) current-page @endif">Shop</a>
          <a href="{{ route('about') }}" class="text-dark @if(Request::routeIs('about')) current-page @endif">About</a>
          <a href="{{ route('contact') }}" class="text-dark @if(Request::routeIs('contact')) current-page @endif">Contact</a>

          <!-- Mobile Login/Logout -->
          @auth
          <form action="{{ route('logout') }}" method="POST" id="mobileLogoutForm" class="mt-2">
            @csrf
            <button type="button" class="btn btn-outline-dark btn-sm px-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
          @else
            <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm px-2">Login</a>
          @endauth
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-light mt-5 py-5 border-top">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3">
          <div class="d-flex align-items-center gap-2 mb-3">
            <div class="bg-dark rounded d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
              <span class="text-white fw-bold">S</span>
            </div>
            <span class="fw-bold fs-5 text-dark">STORE</span>
          </div>
          <p class="small text-secondary mb-0">Your destination for premium electronics and accessories</p>
        </div>
        <div class="col-md-3">
          <h5 class="fw-semibold mb-3">Shop</h5>
          <ul class="list-unstyled small">
            <li><a href="#" class="footer-link">All Products</a></li>
            <li><a href="#" class="footer-link">Electronics</a></li>
            <li><a href="#" class="footer-link">Accessories</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="fw-semibold mb-3">Support</h5>
          <ul class="list-unstyled small">
            <li><a href="#" class="footer-link">Contact Us</a></li>
            <li><a href="#" class="footer-link">Shipping Info</a></li>
            <li><a href="#" class="footer-link">Returns</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="fw-semibold mb-3">Company</h5>
          <ul class="list-unstyled small">
            <li><a href="#" class="footer-link">About Us</a></li>
            <li><a href="#" class="footer-link">Privacy Policy</a></li>
            <li><a href="#" class="footer-link">Terms of Service</a></li>
          </ul>
        </div>
      </div>
      <div class="text-center border-top pt-4 mt-4 small text-secondary">
        &copy; 2025 STORE. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to log out?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmLogoutBtn">Logout</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 shadow-sm">
        <div class="modal-header">
          <h5 class="modal-title">Please Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>You need to login to add products to cart.</p>
          <div class="d-grid gap-2">
            <a href="{{ route('login') }}" class="btn btn-dark rounded-pill">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-dark rounded-pill">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Logout Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
      let activeLogoutForm = null;

      function setFormToSubmit(formId) {
        activeLogoutForm = document.getElementById(formId);
      }

      const desktopButton = document.querySelector('#desktopLogoutForm button');
      if(desktopButton) desktopButton.addEventListener('click', () => setFormToSubmit('desktopLogoutForm'));

      const mobileButton = document.querySelector('#mobileLogoutForm button');
      if(mobileButton) mobileButton.addEventListener('click', () => setFormToSubmit('mobileLogoutForm'));

      if(confirmLogoutBtn) confirmLogoutBtn.addEventListener('click', () => {
        if(activeLogoutForm) activeLogoutForm.submit();
      });
    });
  </script>

  @stack('scripts')

</body>
</html>
