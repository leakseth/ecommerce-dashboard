@extends('layouts.user')

@section('title', $product->name)

@section('content')
<div class="container py-5">

  <!-- 🖼 Product Layout -->
  <div class="row g-5">
    <!-- Left: Product Image -->
    <div class="col-lg-6">
      <div class="border rounded-4 overflow-hidden shadow-sm">
        <img src="{{ asset('storage/' . $product->image) }}"
             alt="{{ $product->name }}"
             class="img-fluid w-100"
             style="object-fit: cover;">
      </div>
    </div>

    <!-- Right: Product Details -->
    <div class="col-lg-6">
      <div class="d-flex flex-column justify-content-between h-100">

        <!-- Title and Category -->
        <div>
          <h1 class="fw-bold text-dark mb-2">{{ $product->name }}</h1>
          <p class="text-muted mb-3">
            Category: <span class="fw-semibold text-dark">{{ $product->category ?? 'Uncategorized' }}</span>
          </p>
        </div>

        <!-- Price and Stock -->
        @php
          $stock = $product->stock;
          $badgeClass = $stock > 10 ? 'bg-success' : ($stock > 0 ? 'bg-warning text-dark' : 'bg-danger');
          $status = $stock > 10 ? 'In Stock' : ($stock > 0 ? 'Low Stock' : 'Out of Stock');
        @endphp
        <div class="mb-3">
          <span class="badge {{ $badgeClass }} px-3 py-2 fs-6">{{ $status }}</span>
        </div>

        <h2 class="text-primary fw-bold mb-4">${{ number_format($product->price, 2) }}</h2>

        <!-- Description -->
        <p class="text-secondary mb-4" style="line-height: 1.7;">
          {{ $product->description ?? 'No description available for this product.' }}
        </p>

        <!-- Quantity & Add to Cart -->
        <div class="d-flex align-items-center gap-3 mb-4">
          <label class="fw-semibold">Quantity:</label>
          <input type="number" id="quantity" class="form-control w-auto text-center"
                 min="1" value="1" style="max-width: 100px;">
        </div>

        <div class="d-flex flex-wrap gap-3">
          <button class="btn btn-dark px-4 py-2 add-to-cart"
                  data-id="{{ $product->id }}"
                  data-name="{{ $product->name }}"
                  data-price="{{ $product->price }}"
                  data-image="{{ asset('storage/' . $product->image) }}">
            <i data-lucide="shopping-cart" class="me-2"></i> Add to Cart
          </button>

          <button action="{{ route('shop') }}" class="btn btn-outline-secondary px-4 py-2">
            <i class="bi bi-arrow-left"></i> Back to Shop
          </button>
        </div>
        
      </div>
    </div>
  </div>
    <!-- Related Products -->
@if($relatedProducts->count() > 0)
  <section class="mt-5 pt-4 border-top">
    <h3 class="fw-bold text-dark mb-4 text-center">🛍️ Related Products</h3>
    <div class="row g-4">
      @foreach ($relatedProducts as $related)
        @php
          $stock = $related->stock;
          $badgeClass = $stock > 10 ? 'bg-success' : ($stock > 0 ? 'bg-warning text-dark' : 'bg-danger');
          $status = $stock > 10 ? 'In Stock' : ($stock > 0 ? 'Low Stock' : 'Out of Stock');
        @endphp

        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden align-items-center">
            <img src="{{ asset('storage/' . $related->image) }}"
                 alt="{{ $related->name }}"
                 class="card-img-top img-fluid"
                 style="object-fit: cover; height: 230px;">
            <span class="position-absolute top-0 end-0 m-2 badge {{ $badgeClass }}">
              {{ $status }}
            </span>

            <div class="card-body text-center p-3">
              <h6 class="fw-semibold mb-1 text-dark text-truncate">{{ $related->name }}</h6>
              <span class="fw-bold text-primary">${{ number_format($related->price, 2) }}</span>
              <div class="mt-3 d-flex flex-column gap-2 w-full">
                <a href="{{ route('product.detail', $related->id) }}" 
                   class="btn btn-outline-dark btn-sm w-100">View Details</a>
                <button class="btn btn-dark btn-sm w-100 add-to-cart"
                        data-id="{{ $related->id }}"
                        data-name="{{ $related->name }}"
                        data-price="{{ $related->price }}"
                        data-image="{{ asset('storage/' . $related->image) }}">
                  <i data-lucide="shopping-cart" class="me-1"></i> Add to Cart
                </button>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endif
</div>




@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
  const addBtn = document.querySelector(".add-to-cart");

  addBtn.addEventListener("click", async () => {
    const userLoggedIn = @json(auth()->check());
    if (!userLoggedIn) {
      const modalEl = document.getElementById("loginModal");
      if (modalEl) new bootstrap.Modal(modalEl).show();
      return;
    }

    const qty = document.getElementById("quantity").value;
    const productData = {
      id: addBtn.dataset.id,
      name: addBtn.dataset.name,
      price: addBtn.dataset.price,
      image: addBtn.dataset.image,
      quantity: qty
    };

    const res = await fetch("{{ route('cart.add') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
      },
      body: JSON.stringify(productData)
    });

    const data = await res.json();
    if (data.success) {
      showAlert('✅ ' + data.message, 'success');
      const countEl = document.getElementById("cart-count");
      if (countEl) countEl.textContent = parseInt(countEl.textContent) + 1;
      addBtn.innerHTML = '<i data-lucide="check"></i> Added';
      setTimeout(() => {
        addBtn.innerHTML = '<i data-lucide="shopping-cart" class="me-2"></i> Add to Cart';
        lucide.createIcons();
      }, 1500);
    } else {
      showAlert('❌ Something went wrong.', 'danger');
    }

    lucide.createIcons();
  });

  function showAlert(message, type) {
    const alertBox = document.createElement('div');
    alertBox.className = `alert alert-${type} position-fixed top-0 start-50 translate-middle-x mt-3 shadow`;
    alertBox.style.zIndex = 9999;
    alertBox.textContent = message;
    document.body.appendChild(alertBox);
    setTimeout(() => alertBox.remove(), 2500);
  }

  lucide.createIcons();
});
</script>
@endpush
