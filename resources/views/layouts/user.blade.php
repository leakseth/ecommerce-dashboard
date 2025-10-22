<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'STORE')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => lucide.createIcons());
  </script>

  <link href="{{ asset('css/store.css') }}" rel="stylesheet">

  <style>
    /* --- Desktop Nav Link Styles --- */
    .d-md-flex.gap-4 a {
      text-decoration: none !important;
      position: relative; 
      padding-bottom: 2px;
      color: #212529 !important; 
    }

    .d-md-flex.gap-4 a::after {
      content: '';
      position: absolute;
      width: 0; 
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: #212529; 
      transition: width 0.3s ease-in-out; 
    }

    .d-md-flex.gap-4 a:hover::after {
      width: 100%; 
    }

    /* --- Active Page Focus --- */
    .d-md-flex.gap-4 a.current-page, 
    .d-md-flex.gap-4 a.current-page:hover {
        font-weight: 600 !important;
        color: #212529 !important;
    }

    /* Ensure the current page link has a permanent underline */
    .d-md-flex.gap-4 a.current-page::after,
    .d-md-flex.gap-4 a.current-page:hover::after {
        width: 100%; 
    }

    /* --- Mobile Menu Link Focus --- */
    .collapse a.current-page {
        font-weight: 600 !important;
    }


    /* Custom CSS (កែប្រែសម្រាប់ព្រួញធំ និងវែងជាង) */

    .hero-shop-btn {
      position: relative;
      overflow: hidden; 
      /* បង្កើន padding-right ដើម្បីផ្តល់កន្លែងសម្រាប់ព្រួញវែងជាង */
      padding-right: 3rem !important; 
      transition: all 0.3s ease-in-out;
    }

    .hero-shop-btn::after {
      content: '→'; /* សញ្ញាព្រួញ */
      position: absolute;
      top: 50%;
      /* ធ្វើឲ្យព្រួញធំជាងមុន */
      font-size: 1.5rem; 
      right: 1.5rem; 
      /* ផ្លាស់ទីវានៅខាងក្រៅប៊ូតុងដើម្បីចាប់ផ្តើម (លាក់) */
      transform: translateY(-50%) translateX(200%); 
      opacity: 0;
      transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1); /* ប្រើ transition ផ្សេងដើម្បីឲ្យ animation កាន់តែរលូន */
    }

    .hero-shop-btn:hover {
      /* បង្កើន padding ឲ្យកាន់តែច្រើនដើម្បីប៊ូតុងវែងជាង */
      padding-right: 5rem !important; 
    }

    .hero-shop-btn:hover::after {
      /* ផ្លាស់ទីព្រួញទៅទីតាំងខាងក្នុងថ្មីរបស់វា */
      right: 1.5rem; 
      transform: translateY(-50%) translateX(0); 
      opacity: 1;
    }
    
  </style>
</head>

<body>
  <header class="sticky-top bg-white border-bottom py-2">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ route('store') }}" class="d-flex align-items-center text-decoration-none">
        <div class="bg-dark rounded d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
          <span class="text-white fw-bold">S</span>
        </div>
        <span class="fw-bold fs-4 text-dark">STORE</span>
      </a>

      <nav class="d-none d-md-flex align-items-center gap-4">
        {{-- Use Request::routeIs() to conditionally apply 'current-page' and 'fw-semibold' class --}}
        <a href="{{ route('store') }}" 
           class="text-dark text-decoration-none @if(Request::routeIs('store')) current-page fw-semibold @endif">Home</a>
        <a href="{{ route('shop') }}" 
           class="text-dark text-decoration-none @if(Request::routeIs('shop')) current-page @endif">Shop</a>
        <a href="{{ route('about') }}" 
           class="text-dark text-decoration-none @if(Request::routeIs('about')) current-page @endif">About</a>
        <a href="{{ route('contact') }}" 
           class="text-dark text-decoration-none @if(Request::routeIs('contact')) current-page @endif">Contact</a>
      </nav>

      <div class="d-flex align-items-center gap-3">
        <a href="{{ route('checkout') }}" class="btn btn-light rounded-circle p-2 d-none d-md-flex"><i data-lucide="shopping-cart"></i></a>

        <form action="{{ route('logout') }}" method="POST" id="desktopLogoutForm" class="d-none d-md-flex m-0">
          @csrf
          <button type="button" class="btn btn-outline-dark btn-sm px-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>

        <button class="btn btn-light d-md-none rounded-circle p-2" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
          <i data-lucide="menu"></i>
        </button>
      </div>
    </div>

    <div class="collapse d-md-none border-top" id="mobileMenu">
      <div class="container py-3">
        <nav class="d-flex flex-column gap-2 text-center"> 
          {{-- Apply class for mobile menu as well --}}
          <a href="{{ route('store') }}" 
             class="text-dark text-decoration-none @if(Request::routeIs('store')) current-page fw-semibold @endif">Home</a>
          <a href="{{ route('shop') }}" 
             class="text-dark text-decoration-none @if(Request::routeIs('shop')) current-page @endif">Shop</a>
          <a href="{{ route('about') }}" 
             class="text-dark text-decoration-none @if(Request::routeIs('about')) current-page @endif">About</a>
          <a href="{{ route('contact') }}" 
             class="text-dark text-decoration-none @if(Request::routeIs('contact')) current-page @endif">Contact</a>

          <form action="{{ route('logout') }}" method="POST" id="mobileLogoutForm" class="mt-2">
            @csrf
            <button type="button" class="btn btn-outline-dark btn-sm px-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
              <i class="bi bi-box-arrow-right"></i>
              <span>Logout</span>
          </button>
          </form>
        </nav>
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  <footer class="bg-light mt-5 py-5 border-top">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-3">
        <div class="d-flex align-items-center gap-2 mb-3">
          <div class="bg-dark rounded d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
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

<style>
  .footer-link {
    color: #6c757d; /* gray */
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .footer-link:hover {
    color: #000; /* text turns black on hover */
  }
</style>


  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
      // Store a reference to the form that opened the modal
      let activeLogoutForm = null; 

      // Function to set the currently active form when a button is clicked
      function setFormToSubmit(formId) {
          activeLogoutForm = document.getElementById(formId);
      }

      // Add listeners to the desktop and mobile buttons to set the active form
      const desktopButton = document.querySelector('#desktopLogoutForm button');
      if (desktopButton) {
          desktopButton.addEventListener('click', () => setFormToSubmit('desktopLogoutForm'));
      }
      
      const mobileButton = document.querySelector('#mobileLogoutForm button');
      if (mobileButton) {
          mobileButton.addEventListener('click', () => setFormToSubmit('mobileLogoutForm'));
      }
      
      // When the user clicks the "Logout" button inside the modal, submit the tracked form
      if (confirmLogoutBtn) {
          confirmLogoutBtn.addEventListener('click', () => {
              if (activeLogoutForm) {
                  activeLogoutForm.submit();
              }
          });
      }
    });
  </script>
</body>
</html>