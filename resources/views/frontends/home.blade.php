<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - STORE</title>

  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => lucide.createIcons());
  </script>

  <style>
    body {
      background-color: #f9fafb;
    }
    .navbar-brand-box {
      width: 2rem;
      height: 2rem;
      background: #000;
      border-radius: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .navbar-brand-box span {
      color: white;
      font-weight: 700;
      font-size: 1.1rem;
    }
    .btn-black {
      background-color: #000;
      color: white;
      border-radius: 9999px;
      font-weight: 600;
      transition: 0.3s;
    }
    .btn-black:hover {
      background-color: #ffffff;
      color: #000;
      border: 1px solid #000;
    }
    .btn-outline-black {
      border: 1px solid #000;
      color: #000;
      border-radius: 9999px;
      font-weight: 600;
      transition: 0.3s;
    }
    .btn-outline-black:hover {
      background-color: #000;
      color: white;
    }
    footer {
      background-color: #f8f9fa;
      border-top: 1px solid #dee2e6;
    }
    footer a {
      color: #6c757d;
      text-decoration: none;
    }
    footer a:hover {
      color: #000;
    }
    .bg-gray-200 {
      background-color: #e5e7eb;
    }
  </style>
</head>

<body>
  <!-- Header -->
<header class="sticky-top bg-white border-bottom border-border py-2">
  <div class="container d-flex align-items-center justify-content-between">
    <!-- Logo -->
    <a href="{{ route('store') }}" class="d-flex align-items-center text-decoration-none">
      <div class="bg-dark rounded d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
        <span class="text-white fw-bold">S</span>
      </div>
      <span class="fw-bold fs-4 text-dark">STORE</span>
    </a>

    <!-- Desktop Navigation -->
    <nav class="d-none d-md-flex align-items-center gap-4">
      <a href="{{ route('store') }}" class="fw-semibold text-dark text-decoration-none">Home</a>
      <a href="{{ route('shop') }}" class=" text-dark text-decoration-none">Shop</a>
      <a href="{{ route('about') }}" class="text-dark text-decoration-none">About</a>
      <a href="{{ route('contact') }}" class="text-dark text-decoration-none">Contact</a>
    </nav>

    <!-- Right Action Buttons -->
    <div class="d-flex align-items-center gap-3">
      <button class="btn btn-light d-none d-md-flex rounded-circle p-2">
        <i data-lucide="heart"></i>
      </button>
      <a href="{{ route('checkout') }}" class="btn btn-light d-none d-md-flex rounded-circle p-2">
        <i data-lucide="shopping-cart"></i>
      </a>

      <!-- ✅ Correct Logout Form -->
      <form action="{{ route('logout') }}" method="POST" class="d-none d-md-flex m-0">
        @csrf
        <button type="submit" class="btn btn-outline-danger fw-semibold">Logout</button>
      </form>

      
      <!-- Mobile Menu Toggle -->
      <button class="btn btn-light d-md-none rounded-circle p-2" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
        <i data-lucide="menu"></i>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="collapse d-md-none border-top border-border" id="mobileMenu">
    <div class="container py-3">
      <nav class="d-flex flex-column gap-2">
        <a href="{{ route('store') }}" class="fw-semibold text-dark text-decoration-none">Home</a>
        <a href="{{ route('shop') }}" class="text-dark text-decoration-none">Shop</a>
        <a href="{{ route('about') }}" class="text-dark text-decoration-none">About</a>
        <a href="{{ route('contact') }}" class="text-dark text-decoration-none">Contact</a>

        <!-- Logout Button for Mobile -->
        {{-- <form action="{{ route('logout') }}" method="POST" class="m-0">
          @csrf --}}
          <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
        {{-- </form> --}}
      </nav>
    </div>
  </div>
</header>

  <!-- Hero Section -->
  <section class="bg-light border-bottom w-100 vh-75 d-flex align-items-center">
    <div class="container py-5">
      <div class="row align-items-center g-5">
        <!-- Text Section -->
        <div class="col-md-6 text-center text-md-start">
          <h1 class="display-4 fw-bold text-dark mb-4">
            Premium Products for Modern Living
          </h1>
          <p class="fs-5 text-secondary mb-4">
            Discover our curated collection of high-quality electronics and accessories designed to enhance your lifestyle
          </p>
            <a href="{{ route('shop') }}" class=" btn btn-black me-3 px-4 py-2">Shop now →</a>
            <a href="{{ route('about') }}" class="btn btn-outline-black px-4 py-2">Learn More</a>
        </div>

        <!-- Image Section -->
        <div class="col-md-6 text-center text-md-end">
          <img
            src="{{ asset('images/main.png') }}"
            alt="Premium Products"
            class=""
            style="max-width: 500px;"
          >
        </div>
      </div>
    </div>
  </section>
  <section class="container py-5 py-md-6">
    <div class="d-flex justify-content-between align-items-center mb-5">
      <div>
        <h2 class="fw-bold mb-2 fs-2 fs-md-1 text-dark">Featured Products</h2>
        <p class="text-secondary">Handpicked items just for you</p>
      </div>
      <a href="{{ route('shop') }}" class="btn btn-outline-dark d-flex align-items-center">
        View All
        <svg xmlns="http://www.w3.org/2000/svg" class="ms-2" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
    </div>

    <div class="row g-4">
        <div class="col-12 col-sm-6 col-lg-3">
          <a href="" class="text-decoration-none text-dark">
            <div class="card border-0 shadow-sm h-100 position-relative">
              <div class="ratio ratio-1x1 bg-light position-relative overflow-hidden">
                <img
                  src="{{ asset('images/main.png') }}"
                  alt=""
                  class="card-img-top object-fit-cover transition"
                  style="transition: transform 0.3s ease;"
                  onmouseover="this.style.transform='scale(1.05)'"
                  onmouseout="this.style.transform='scale(1)'"
                />
                <button type="button" class="btn btn-light position-absolute top-0 end-0 m-2 opacity-0 hover-opacity transition">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
                  </svg>
                </button>
              </div>

              <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        class="" fill="currentColor"
                        viewBox="0 0 16 16">
                      <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792c-.197-.39-.73-.39-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.282.95l3.523 3.356-.83 4.73z"/>
                    </svg>
                  <span class="text-muted small ms-2"></span>
                </div>

                <h5 class="fw-semibold mb-1"></h5>
                <p class="text-muted small mb-3"></p>

                <div class="d-flex justify-content-between align-items-center">
                  <span class="fw-bold fs-5">$</span>
                  <a href="" class="btn btn-dark btn-sm">
                    View Details
                  </a>
                </div>
              </div>
            </div>
          </a>
        </div>
    </div>
  </section>

  <section class="bg-light border-top border-bottom">
    <div class="container py-5 py-md-6">
      <div class="text-center mb-5">
        <h2 class="fw-bold fs-2 fs-md-1 mb-2 text-dark">Shop by Category</h2>
        <p class="text-secondary">Find exactly what you're looking for</p>
      </div>

      <div class="row g-4">
        {{-- Electronics --}}
        <div class="col-12 col-md-4">
          <a href="" class="text-decoration-none">
            <div class="position-relative rounded overflow-hidden" style="height: 16rem; cursor: pointer;">
              <img 
                src="{{ asset('images/main.png') }}" 
                alt="Electronics" 
                class="w-100 h-100 object-fit-cover transition"
                style="transition: transform 0.3s ease;" 
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'"
              />
              <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-4" 
                  style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                <div>
                  <h3 class="text-white fw-bold fs-3 mb-2">Electronics</h3>
                  <p class="text-white-50 mb-0">Latest tech gadgets</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        {{-- Accessories --}}
        <div class="col-12 col-md-4">
          <a href="" class="text-decoration-none">
            <div class="position-relative rounded overflow-hidden" style="height: 16rem; cursor: pointer;">
              <img 
                src="{{ asset('images/main.png') }}" 
                alt="Accessories" 
                class="w-100 h-100 object-fit-cover transition"
                style="transition: transform 0.3s ease;" 
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'"
              />
              <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-4" 
                  style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                <div>
                  <h3 class="text-white fw-bold fs-3 mb-2">Accessories</h3>
                  <p class="text-white-50 mb-0">Essential add-ons</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        {{-- Audio --}}
        <div class="col-12 col-md-4">
          <a href="" class="text-decoration-none">
            <div class="position-relative rounded overflow-hidden" style="height: 16rem; cursor: pointer;">
              <img 
                src="{{ asset('images/main.png') }}" 
                alt="Audio" 
                class="w-100 h-100 object-fit-cover transition"
                style="transition: transform 0.3s ease;" 
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'"
              />
              <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-4" 
                  style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                <div>
                  <h3 class="text-white fw-bold fs-3 mb-2">Audio</h3>
                  <p class="text-white-50 mb-0">Premium sound</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="container py-5 py-md-6">
    <div class="mx-auto text-center" style="max-width: 700px;">
      <h2 class="fw-bold fs-2 fs-md-1 mb-3 text-dark">Stay Updated</h2>
      <p class="text-secondary mb-4">
        Subscribe to our newsletter for exclusive deals and new product launches
      </p>

      <form action="#" method="POST" class="d-flex flex-column flex-sm-row gap-3 justify-content-center mx-auto" style="max-width: 500px;">
        @csrf
        <input 
          type="email" 
          name="email" 
          class="form-control flex-grow-1" 
          placeholder="Enter your email" 
          required
        >
        <button type="submit" class="btn btn-dark px-4">
          Subscribe
        </button>
      </form>
    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-gray-200 mt-5 py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3">
          <div class="d-flex align-items-center gap-2 mb-3">
            <div class="bg-dark rounded d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
              <span class="text-white fw-bold">S</span>
            </div>
            <span class="fw-bold fs-5 text-dark">STORE</span>
          </div>
          <p class="small text-secondary mb-0">
            Your destination for premium electronics and accessories
          </p>
        </div>

        <div class="col-md-3">
          <h5 class="fw-semibold mb-3">Shop</h5>
          <ul class="list-unstyled small">
            <li><a href="#">All Products</a></li>
            <li><a href="#">Electronics</a></li>
            <li><a href="#">Accessories</a></li>
          </ul>
        </div>

        <div class="col-md-3">
          <h5 class="fw-semibold mb-3">Support</h5>
          <ul class="list-unstyled small">
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Shipping Info</a></li>
            <li><a href="#">Returns</a></li>
          </ul>
        </div>

        <div class="col-md-3">
          <h5 class="fw-semibold mb-3">Company</h5>
          <ul class="list-unstyled small">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
      </div>

      <div class="text-center border-top pt-4 mt-4 small text-secondary">
        &copy; 2025 STORE. All rights reserved.
      </div>
    </div>
  </footer>
</body>
</html>