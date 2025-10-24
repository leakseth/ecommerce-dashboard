@extends('layouts.user')

@section('title', 'Your Cart')

@section('content')
<section class="container py-5">
  <h1 class="fw-bold mb-5 text-center">Your Shopping Cart</h1>

  @if(count($cart) > 0)
    <div class="row g-4">

      {{-- CART ITEMS --}}
      <div class="col-lg-8">
        <div class="bg-white rounded-4 shadow-sm p-4">
          @php $total = 0; @endphp
          @foreach ($cart as $id => $item)
            @php $total += $item['price'] * $item['quantity']; @endphp

            <div class="d-flex align-items-center justify-content-between border-bottom py-3 cart-item">
              <div class="d-flex align-items-center">
                <img src="{{ $item['image'] }}" class="rounded-3 me-3"
                     style="width: 80px; height: 80px; object-fit: cover;">
                <div>
                  <h6 class="fw-semibold mb-1">{{ $item['name'] }}</h6>
                  <p class="text-muted mb-1 small">${{ number_format($item['price'], 2) }}</p>
                  <button class="btn btn-link text-danger p-0 remove-item small" data-id="{{ $id }}">
                    <i data-lucide="trash-2" class="me-1"></i> Remove
                  </button>
                </div>
              </div>

              <div class="text-end">
                <div class="input-group input-group-sm justify-content-end" style="width: 110px;">
                  <button class="btn btn-outline-secondary btn-sm minus-btn" data-id="{{ $id }}">-</button>
                  <input type="number" class="form-control text-center update-qty"
                         value="{{ $item['quantity'] }}" min="1"
                         data-id="{{ $id }}">
                  <button class="btn btn-outline-secondary btn-sm plus-btn" data-id="{{ $id }}">+</button>
                </div>
                <p class="fw-semibold mt-2 mb-0">
                  ${{ number_format($item['price'] * $item['quantity'], 2) }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- CART SUMMARY --}}
      <div class="col-lg-4">
        <div class="bg-white rounded-4 shadow-sm p-4 position-sticky top-0">
          <h5 class="fw-bold mb-4">Order Summary</h5>
          <div class="d-flex justify-content-between mb-2">
            <span>Subtotal</span>
            <span>${{ number_format($total, 2) }}</span>
          </div>
          <div class="d-flex justify-content-between mb-2 text-muted">
            <span>Shipping</span>
            <span>Free</span>
          </div>
          <hr>
          <div class="d-flex justify-content-between mb-3">
            <h5 class="fw-bold">Total</h5>
            <h5 class="fw-bold text-primary">${{ number_format($total, 2) }}</h5>
          </div>
          <button class="btn btn-dark w-100 rounded-pill py-2 mb-3">Proceed to Checkout</button>
          <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 rounded-pill">
            Continue Shopping
          </a>
        </div>
      </div>

    </div>
  @else
    <div class="text-center py-5">
      <h4 class="text-muted mb-3">Your cart is empty 😢</h4>
      <a href="{{ route('shop') }}" class="btn btn-dark rounded-pill">Continue Shopping</a>
    </div>
  @endif
</section>
@endsection

@push('scripts')
<style>
/* ===== CART PAGE DESIGN ===== */
.cart-item:last-child {
  border-bottom: none !important;
}

.update-qty {
  width: 45px;
  box-shadow: none !important;
}

.btn-outline-secondary {
  border-color: #ddd;
  color: #555;
}
.btn-outline-secondary:hover {
  background-color: #f8f9fa;
}

/* Smooth shadow + rounded card look */
.bg-white.rounded-4 {
  border: 1px solid #eee;
}

/* Cart summary sticky effect */
@media (min-width: 992px) {
  .position-sticky {
    position: sticky !important;
    top: 100px;
  }
}
</style>

@push('scripts')
<script>

document.addEventListener("DOMContentLoaded", () => {

// document.querySelectorAll('.add-to-cart').forEach(btn => {
//     btn.addEventListener('click', async () => {
//         const product = {
//             id: btn.dataset.id,
//             name: btn.dataset.name,
//             price: btn.dataset.price,
//             image: btn.dataset.image,
//             _token: '{{ csrf_token() }}'
//         };

//         const res = await fetch('{{ route("cart.add") }}', {
//             method: 'POST',
//             headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': product._token },
//             body: JSON.stringify(product)
//         });

//         const data = await res.json();
//         if(data.success){
//             // Update cart count dynamically
//             const cartCount = document.getElementById('cart-count');
//             cartCount.textContent = parseInt(cartCount.textContent) + 1;

//             // Show success alert
//             const alertBox = document.createElement('div');
//             alertBox.className = 'alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3 shadow';
//             alertBox.textContent = '🛒 ' + data.message;
//             document.body.appendChild(alertBox);
//             setTimeout(() => alertBox.remove(), 2500);
//         }
//     });
// });


});

document.addEventListener('DOMContentLoaded', () => {
  // Function update quantity
  async function updateCart(id, quantity) {
    const res = await fetch('{{ route("cart.update") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ id, quantity })
    });
    location.reload();
  }

  // Handle + button
  document.querySelectorAll('.plus-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.parentElement.querySelector('.update-qty');
      input.value = parseInt(input.value) + 1;
      updateCart(input.dataset.id, input.value);
    });
  });

  // Handle - button
  document.querySelectorAll('.minus-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.parentElement.querySelector('.update-qty');
      if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        updateCart(input.dataset.id, input.value);
      }
    });
  });

  // Handle manual input
  document.querySelectorAll('.update-qty').forEach(input => {
    input.addEventListener('change', () => {
      updateCart(input.dataset.id, input.value);
    });
  });

  // Remove item
  document.querySelectorAll('.remove-item').forEach(btn => {
    btn.addEventListener('click', async () => {
      const res = await fetch('{{ route("cart.remove") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id: btn.dataset.id })
      });
      location.reload();
    });
  });

  lucide.createIcons();
});
</script>
@endpush
 
