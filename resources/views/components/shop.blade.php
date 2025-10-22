@extends('layouts.user')

@section('title', 'Shop')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<section class="bg-light border-bottom py-5">
  <div class="container text-center text-md-start">
    <h1 class="fw-bold display-5 text-dark mb-3">Shop All Products</h1>
    <p class="fs-5 text-secondary mb-0">Browse our complete collection of premium electronics and accessories.</p>
  </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<main class="container py-5">
  <!-- Search & Filters -->
  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mb-5">
    <div class="position-relative flex-grow-1" style="max-width: 400px;">
      <i data-lucide="search" class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="width: 18px; height: 18px;"></i>
      <input type="text" id="search" placeholder="Search products..." class="form-control ps-5 rounded-pill border-secondary">
    </div>
    <button class="btn btn-outline-dark rounded-pill px-4 d-flex align-items-center">
      <i data-lucide="sliders-horizontal" class="me-2"></i> Filters
    </button>
  </div>

  <!-- Category Filter Buttons -->
  <div class="mb-4 d-flex flex-wrap gap-2">
      <a href="{{ route('shop') }}" 
        class="btn btn-sm rounded-pill px-3 {{ empty($categoryName) ? 'btn-dark active' : 'btn-outline-dark' }}">
          All
      </a>

      @foreach ($categories as $category)
          <a href="{{ route('shop', ['category' => $category->name]) }}" 
            class="btn btn-sm rounded-pill px-3 {{ ($categoryName === $category->name) ? 'btn-dark active' : 'btn-outline-dark' }}">
              {{ $category->name }}
          </a>
      @endforeach
  </div>


  <!-- ===== PRODUCTS GRID ===== -->
  <div class="row g-4">
     @if($products->count() > 0)
      @foreach ($products as $product)
        @php
          $stock = $product->stock;
          $badgeClass = $stock > 10 ? 'bg-success' : ($stock > 0 ? 'bg-warning text-dark' : 'bg-danger');
          $status = $stock > 10 ? 'In Stock' : ($stock > 0 ? 'Low Stock' : 'Out of Stock');
        @endphp

        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card border-0 shadow-sm h-100 product-card overflow-hidden transition-all position-relative">
            <!-- Image -->
            <div class="position-relative bg-light" style="aspect-ratio: 1 / 1; overflow: hidden;">
              <img src="{{ asset('storage/' . $product->image) }}"
                  alt="{{ $product->name }}"
                  class="img-fluid w-100 h-100 object-fit-cover transition-transform">
              <span class="position-absolute top-0 end-0 m-2 badge {{ $badgeClass }}">{{ $status }}</span>
            </div>

            <!-- Product Info -->
            <div class="p-4 text-center">
              <h3 class="fw-semibold fs-5 mb-1 text-dark">{{ $product->name }}</h3>
              <p class="text-muted small mb-2">{{ $product->category ?? 'Uncategorized' }}</p>
              <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                <span class="fw-bold fs-5 text-primary">${{ number_format($product->price, 2) }}</span>
              </div>

              <button class="btn btn-dark btn-sm w-100 rounded-pill add-to-cart"
                  data-id="{{ $product->id }}"
                  data-name="{{ $product->name }}"
                  data-price="{{ $product->price }}"
                  data-image="{{ asset('storage/' . $product->image) }}">
                <i data-lucide="shopping-cart" class="me-1"></i> Add to Cart
              </button>
            </div>
          </div>
        </div>
      @endforeach
    @else
    <div class="col-12 text-center py-5">
            <h4 class="text-muted">No products found in this category.</h4>
        </div>
    @endif
  </div>

  <!-- Pagination (Optional) -->
  <div class="mt-5 text-center">
    {{ $products->links('pagination::bootstrap-5') }}
  </div>
</main>

@endsection

@push('scripts')
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
    if (data.success) {
      const alertBox = document.createElement('div');
      alertBox.className = 'alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3 shadow';
      alertBox.textContent = '🛒 ' + data.message;
      document.body.appendChild(alertBox);
      setTimeout(() => alertBox.remove(), 2500);
    }
  });
});

// Hover effects for product cards
document.querySelectorAll('.product-card img').forEach(img => {
  img.addEventListener('mouseenter', () => img.classList.add('scale-105'));
  img.addEventListener('mouseleave', () => img.classList.remove('scale-105'));
});
</script>

<style>
.product-card img { transition: transform 0.3s ease; }
.scale-105 { transform: scale(1.05); }
.btn:hover { color: #0d6efd !important; } /* hover only changes text color */
</style>
@endpush
