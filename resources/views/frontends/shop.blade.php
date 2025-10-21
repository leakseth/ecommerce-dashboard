<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop - STORE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    /* Keep Tailwind-style color names for consistency */
    .bg-background { background-color: #fff; }
    .bg-gray-100 { background-color: #f7f7f7; }
    .bg-muted { background-color: #f2f2f2; }
    .bg-card { background-color: #fff; }
    .bg-primary { background-color: #000 !important; }
    .bg-secondary { background-color: #e5e5e5; }
    .text-foreground { color: #000; }
    .text-muted-foreground { color: #6b7280; }
    .border-border { border-color: #e5e7eb !important; }
    .border-input { border-color: #d1d5db !important; }
    .hover-bg-accent:hover { background-color: #f3f4f6; }
    .hover-text-accent-foreground:hover { color: #000; }
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

<body class="min-h-screen bg-background">

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
      <a href="{{ route('shop') }}" class="fw-semibold text-dark text-decoration-none">Shop</a>
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


  <!-- Page Header -->
  <section class="bg-gray-100 border-bottom border-border py-5">
    <div class="container">
      <h1 class="fw-bold display-5 text-foreground mb-3">Shop All Products</h1>
      <p class="fs-5 text-muted-foreground">Browse our complete collection</p>
    </div>
  </section>

  <!-- Main Content -->
  <main class="container py-5">
    <!-- Search and Filters -->
    <div class="mb-5">
      <div class="d-flex flex-column flex-sm-row gap-3 mb-3">
        <div class="position-relative flex-grow-1" style="max-width: 400px;">
          <i data-lucide="search" class="position-absolute top-50 translate-middle-y start-0 ms-3 text-muted-foreground" style="width: 16px; height: 16px;"></i>
          <input
            type="text"
            placeholder="Search products..."
            class="form-control ps-5 border-input text-foreground"
          />
        </div>
        <button class="btn border border-input d-flex align-items-center">
          <i data-lucide="sliders-horizontal" class="me-2"></i>
          Filters
        </button>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <button class="btn btn-light border border-input px-3 py-1 text-sm rounded">All</button>
      </div>
    </div>

    <!-- Products Grid -->
        <div class="row g-4">
          <div class="col-12 col-sm-6 col-lg-3">
              <div class="bg-card border border-border rounded overflow-hidden shadow-sm h-100 transition-all">
                  <div class="position-relative bg-muted" style="aspect-ratio: 1 / 1; overflow: hidden;">
                      <img src="{{ asset('images/main.png') }}" alt="" class="img-fluid w-100 h-100 object-fit-cover transition-transform" />
                  </div>
                  <div class="p-4">
                      <h3 class="fw-semibold fs-5 mb-1">Product Name</h3>
                      <p class="text-muted-foreground small mb-3">Category</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <span class="fw-bold fs-5 text-foreground">$99</span>
                          <button class="btn btn-dark btn-sm add-to-cart"
                              data-id="1"
                              data-name="Product Name"
                              data-price="99"
                              data-image="{{ asset('images/main.png') }}">
                              Add to Cart
                          </button>
                      </div>
                      <p class="small text-muted-foreground mt-2">In stock</p>
                  </div>
              </div>
          </div>
      </div>
  </main>

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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    lucide.createIcons();
  </script>
</body>
</html>
<script>
document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', async () => {
        const product = {
            id: btn.dataset.id,
            name: btn.dataset.name,
            price: btn.dataset.price,
            image: btn.dataset.image,
            _token: '{{ csrf_token() }}'
        };

        const res = await fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': product._token },
            body: JSON.stringify(product)
        });

        const data = await res.json();
        // alert(data.message);
        // window.location.href = '{{ route("cart.index") }}'; go to cart page
    });
});
</script>