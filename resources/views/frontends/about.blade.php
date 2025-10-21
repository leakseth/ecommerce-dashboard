<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About - STORE</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    /* --- Tailwind-style utilities recreated --- */
    :root {
      --foreground: #111827;
      --muted-foreground: #6b7280;
      --border: #e5e7eb;
      --background: #ffffff;
      --card: #ffffff;
    }

    body {
      background-color: var(--background);
      color: var(--foreground);
      font-family: 'Inter', system-ui, sans-serif;
    }

    .text-foreground { color: var(--foreground); }
    .text-muted-foreground { color: var(--muted-foreground); }
    .bg-background { background-color: var(--background); }
    .bg-card { background-color: var(--card); }
    .border-border { border-color: var(--border) !important; }
    .rounded-lg { border-radius: 1rem !important; }
    .rounded-md { border-radius: 0.5rem !important; }
    .rounded-full { border-radius: 9999px !important; }

    .shadow-soft { box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.05); }
    .text-pretty { text-wrap: balance; }

    .nav-link.active { color: #2563eb !important; }

    .btn-black {
      background-color: #000;
      color: #fff;
      border: none;
      border-radius: 0.375rem;
      padding: 0.75rem 1.5rem;
      transition: 0.3s;
    }

    .btn-black:hover {
      background-color: #ffffff;
      color: #000000;
      border: 1px solid #000000;
    }

    /* --- Reduced spacing between sections --- */
    section { 
      padding: 2.5rem 0; /* reduced from 5rem to 2.5rem */
    }

    .mb-5 { 
      margin-bottom: 2rem !important; 
    }

    .py-5 {
      padding-top: 2.5rem !important;
      padding-bottom: 2.5rem !important;
    }

    footer .py-5 {
      padding-top: 2rem !important;
      padding-bottom: 2rem !important;
    }
  </style>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      lucide.createIcons();
    });
  </script>
</head>
<body class="bg-background">

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
      <a href="{{ route('store') }}" class="text-dark text-decoration-none">Home</a>
      <a href="{{ route('shop') }}" class="text-dark text-decoration-none">Shop</a>
      <a href="{{ route('about') }}" class="fw-semibold text-dark text-decoration-none">About</a>
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

      <!-- Logout Button for Desktop -->
      {{-- <form action="{{ route('logout') }}" method="POST" class="d-none d-md-flex m-0">
        @csrf --}}
        <button type="submit" class="btn btn-outline-danger fw-semibold">Logout</button>
      {{-- </form> --}}

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
        <a href="{{ route('store') }}" class=" text-dark text-decoration-none">Home</a>
        <a href="{{ route('shop') }}" class="text-dark text-decoration-none">Shop</a>
        <a href="{{ route('about') }}" class="fw-semibold text-dark text-decoration-none">About</a>
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

  <!-- Hero -->
  <section class="bg-light border-bottom border-border text-center">
    <div class="container py-4">
      <h1 class="fw-bold display-5 mb-3 text-foreground">About STORE</h1>
      <p class="fs-5 text-muted-foreground text-pretty mx-auto" style="max-width: 700px;">
        We're passionate about bringing you the best electronics and accessories to enhance your digital lifestyle.
      </p>
    </div>
  </section>

  <!-- Main -->
  <main class="container py-4">

    <!-- Our Story -->
    <section class="mb-4">
      <div class="row align-items-center gy-4">
        <div class="col-lg-6">
          <h2 class="fw-bold fs-2 mb-3">Our Story</h2>
          <p class="text-muted-foreground">
            Founded in 2020, STORE began with a simple mission: to make premium technology accessible to everyone.
            What started as a small online shop has grown into a trusted destination for tech enthusiasts and professionals alike.
          </p>
          <p class="text-muted-foreground">
            We carefully curate every product in our catalog, ensuring that each item meets our high standards for quality, functionality, and value.
          </p>
          <p class="text-muted-foreground mb-0">
            Today, we serve thousands of customers worldwide, helping them find the perfect tech solutions for their needs.
          </p>
        </div>
        <div class="col-lg-6">
          <div class="ratio ratio-16x9 rounded-lg overflow-hidden">
            <img src="{{ asset('images/modern-office.png') }}" class="img-fluid object-fit-cover" alt="Our workspace">
          </div>
        </div>
      </div>
    </section>

    <!-- Stats -->
    <section class="mb-4">
      <div class="row text-center gy-3">
        <div class="col-6 col-md-3">
          <div class="text-center">
            <div class="rounded-full bg-light d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
              </svg>
            </div>
            <div class="fs-3 fw-bold mb-1 text-foreground">50K+</div>
            <p class="text-muted-foreground mb-0 small">Happy Customers</p>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="text-center">
            <div class="rounded-full bg-light d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
              </svg>
            </div>
            <div class="fs-3 fw-bold mb-1 text-foreground">500+</div>
            <p class="text-muted-foreground mb-0 small">Products</p>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="text-center">
            <div class="rounded-full bg-light d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
              <i class="bi bi-award" style="font-size: 30px"></i>
            </div>
            <div class="fs-3 fw-bold mb-1 text-foreground">4.8/5</div>
            <p class="text-muted-foreground mb-0 small">Average Rating</p>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="text-center">
            <div class="rounded-full bg-light d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
              <i class="bi bi-graph-up" style="font-size: 30px"></i>
            </div>
            <div class="fs-3 fw-bold mb-1 text-foreground">5 Years</div>
            <p class="text-muted-foreground mb-0 small">In Business</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Values -->
    <section class="mb-4">
      <div class="text-center mb-4">
        <h2 class="fw-bold fs-2 mb-2 text-foreground">Our Values</h2>
        <p class="text-muted-foreground mx-auto" style="max-width: 700px;">
          These core principles guide everything we do and shape our relationships with customers and partners.
        </p>
      </div>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="border border-border bg-card rounded-lg p-4 h-100">
            <h4 class="fw-bold mb-2">Quality First</h4>
            <p class="text-muted-foreground mb-0">
              We never compromise on quality. Every product is carefully selected and tested to ensure it meets our high standards.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="border border-border bg-card rounded-lg p-4 h-100">
            <h4 class="fw-bold mb-2">Customer Focus</h4>
            <p class="text-muted-foreground mb-0">
              Your satisfaction is our priority. We're here to help you find the perfect products and provide excellent support.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="border border-border bg-card rounded-lg p-4 h-100">
            <h4 class="fw-bold mb-2">Innovation</h4>
            <p class="text-muted-foreground mb-0">
              We stay ahead of tech trends to bring you the latest and most innovative products on the market.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="bg-light border border-border rounded-lg text-center p-4">
      <h2 class="fw-bold mb-2 text-foreground">Ready to Shop?</h2>
      <p class="text-muted-foreground mb-5 mx-auto" style="max-width: 600px;">
        Explore our curated collection of premium electronics and accessories.
      </p>
      <a href="{{ route('shop') }}" class="btn-black text-decoration-none">Browse Products</a>
    </section>

  </main>

  <!-- Footer -->
  <footer class="bg-light border-top border-border mt-4">
    <div class="container py-4">
      <div class="row g-3">
        <div class="col-md-3">
          <div class="d-flex align-items-center mb-2">
            <div class="bg-dark rounded d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <span class="text-white fw-bold">S</span>
            </div>
            <span class="ms-2 fw-bold fs-5 text-foreground">STORE</span>
          </div>
          <p class="text-muted-foreground small mb-0">
            Your destination for premium electronics and accessories.
          </p>
        </div>
        <div class="col-md-3">
          <h6 class="fw-semibold mb-2 text-foreground">Shop</h6>
          <ul class="list-unstyled small mb-0">
            <li><a href="#" class="text-muted-foreground text-decoration-none">All Products</a></li>
            <li><a href="#" class="text-muted-foreground text-decoration-none">Electronics</a></li>
            <li><a href="#" class="text-muted-foreground text-decoration-none">Accessories</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="fw-semibold mb-2 text-foreground">Support</h6>
          <ul class="list-unstyled small mb-0">
            <li><a href="#" class="text-muted-foreground text-decoration-none">Contact Us</a></li>
            <li><a href="#" class="text-muted-foreground text-decoration-none">Shipping Info</a></li>
            <li><a href="#" class="text-muted-foreground text-decoration-none">Returns</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="fw-semibold mb-2 text-foreground">Company</h6>
          <ul class="list-unstyled small mb-0">
            <li><a href="#" class="text-muted-foreground text-decoration-none">About Us</a></li>
            <li><a href="#" class="text-muted-foreground text-decoration-none">Privacy Policy</a></li>
            <li><a href="#" class="text-muted-foreground text-decoration-none">Terms of Service</a></li>
          </ul>
        </div>
      </div>
      <div class="border-top border-border pt-3 mt-3 text-center text-muted-foreground small">
        &copy; 2025 STORE. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>