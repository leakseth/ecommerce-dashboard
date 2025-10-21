<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'STORE')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => lucide.createIcons());
  </script>

  <!-- Custom CSS -->
  <link href="{{ asset('css/store.css') }}" rel="stylesheet">
</head>

<body>
  <!-- Header -->
  <header class="sticky-top bg-white border-bottom py-2">
    <div class="container d-flex align-items-center justify-content-between">
      <!-- Logo -->
      <a href="{{ route('store') }}" class="d-flex align-items-center text-decoration-none">
        <div class="bg-dark rounded d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
          <span class="text-white fw-bold">S</span>
        </div>
        <span class="fw-bold fs-4 text-dark">STORE</span>
      </a>

      <!-- Desktop Menu -->
      <nav class="d-none d-md-flex align-items-center gap-4">
        <a href="{{ route('store') }}" class="fw-semibold text-dark text-decoration-none">Home</a>
        <a href="{{ route('shop') }}" class="text-dark text-decoration-none">Shop</a>
        <a href="{{ route('about') }}" class="text-dark text-decoration-none">About</a>
        <a href="{{ route('contact') }}" class="text-dark text-decoration-none">Contact</a>
      </nav>

      <!-- Right Buttons -->
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light rounded-circle p-2 d-none d-md-flex"><i data-lucide="heart"></i></button>
        <a href="{{ route('checkout') }}" class="btn btn-light rounded-circle p-2 d-none d-md-flex"><i data-lucide="shopping-cart"></i></a>

        <form action="{{ route('logout') }}" method="POST" class="d-none d-md-flex m-0">
          @csrf
          <button type="submit" class="btn btn-outline-danger fw-semibold">Logout</button>
        </form>

        <button class="btn btn-light d-md-none rounded-circle p-2" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
          <i data-lucide="menu"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div class="collapse d-md-none border-top" id="mobileMenu">
      <div class="container py-3">
        <nav class="d-flex flex-column gap-2">
          <a href="{{ route('store') }}" class="fw-semibold text-dark text-decoration-none">Home</a>
          <a href="{{ route('shop') }}" class="text-dark text-decoration-none">Shop</a>
          <a href="{{ route('about') }}" class="text-dark text-decoration-none">About</a>
          <a href="{{ route('contact') }}" class="text-dark text-decoration-none">Contact</a>

          <form action="{{ route('logout') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
          </form>
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
