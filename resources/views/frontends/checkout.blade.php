<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Checkout - STORE</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    .bg-card { background-color: #fff; }
    .text-foreground { color: #111; }
    .text-muted-foreground { color: #6c757d; }
    .bg-primary { background-color: #0d6efd; }
    .text-primary-foreground { color: #fff; }
    .border-border { border-color: #dee2e6; }
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
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    lucide.createIcons();
  });
</script>
</head>
<body class="min-vh-100 bg-light">

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

  <!-- Main Content -->
  <div class="container my-5">
    <h2 class="fw-bold mb-4">Shopping Cart</h2>

    <div class="row g-4">
        <div class="col-lg-8" id="cart-items">
            @php $subtotal = 0; @endphp
            @foreach ($cart as $id => $item)
            @php $subtotal += $item['price'] * $item['quantity']; @endphp
            <div class="card mb-3 border-0 shadow-sm rounded-3 cart-item" data-id="{{ $id }}">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center">
                        <img src="{{ $item['image'] }}" alt="" class="rounded me-3" style="width:100px; height:100px; object-fit:cover;">
                        <div>
                            <h5 class="fw-semibold mb-1">{{ $item['name'] }}</h5>
                            <p class="fw-bold mb-0">${{ $item['price'] }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3 mt-md-0">
                        <button class="btn btn-outline-secondary btn-sm me-2 update-qty" data-action="decrease" data-id="{{ $id }}">−</button>
                        <span class="px-3 qty">{{ $item['quantity'] }}</span>
                        <button class="btn btn-outline-secondary btn-sm ms-2 update-qty" data-action="increase" data-id="{{ $id }}">+</button>

                        <button class="btn btn-link text-danger ms-3 remove-item text-decoration-none" data-id="{{ $id }}">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </div>

                    <div class="text-end fw-bold fs-5 mt-3 mt-md-0 total-price">
                        ${{ $item['price'] * $item['quantity'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h4 class="fw-bold mb-4">Order Summary</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span id="subtotal">${{ $subtotal }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span class="text-muted">FREE</span>
                    </div>
                    <p class="text-success small mb-3">You've qualified for free shipping!</p>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                        <span>Total</span>
                        <span id="total">${{ $subtotal }}</span>
                    </div>

                    <form action="{{ route('cart.save') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Save Cart / Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>

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


  <!-- JavaScript for Mobile Menu Toggle -->
  <script>
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    mobileToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('d-none');
      menuIcon.classList.toggle('d-none');
      closeIcon.classList.toggle('d-none');
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    lucide.replace();
  </script>
</body>
</html>
<script>
async function updateCart(id, action) {
    await fetch('{{ route("cart.update") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ id, action })
    });
    location.reload();
}

async function removeItem(id) {
    await fetch('{{ route("cart.remove") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ id })
    });
    location.reload();
}

document.querySelectorAll('.update-qty').forEach(btn => {
    btn.addEventListener('click', () => updateCart(btn.dataset.id, btn.dataset.action));
});

document.querySelectorAll('.remove-item').forEach(btn => {
    btn.addEventListener('click', () => removeItem(btn.dataset.id));
});
</script>