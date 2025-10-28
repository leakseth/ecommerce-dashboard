@if($products->count() > 0)
  @foreach ($products as $product)
    @php
      $stock = $product->stock;
      $badgeClass = $stock > 10 ? 'bg-success' : ($stock > 0 ? 'bg-warning text-dark' : 'bg-danger');
      $status = $stock > 10 ? 'In Stock' : ($stock > 0 ? 'Low Stock' : 'Out of Stock');
    @endphp

    <div class="col-lg-3 col-md-6 col-sm-6" >
      <div class=" card product-card border-0 shadow-sm h-100 position-relative overflow-hidden" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
        <div class="bg-light position-relative" style=" height:250px;" >
          <img src="{{ asset('storage/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="card-img-top img-fluid object-fit-cover w-100 h-100 product-img">
          <span class="position-absolute top-0 end-0 m-2 badge {{ $badgeClass }}">
            {{ $status }}
          </span>
        </div>

        <div class="p-4 text-center">
          <h3 class="fw-semibold fs-5 mb-1 text-dark">{{ $product->name }}</h3>
          <p class="text-muted small mb-2">
            {{ $product->category->name ?? 'Uncategorized' }}
          </p>
          <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
            <span class="fw-bold fs-5 text-primary">${{ number_format($product->price, 2) }}</span>
          </div>

          <button class="btn btn-dark w-100 add-to-cart"
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

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const userLoggedIn = @json(auth()->check()); // true if logged in, false if guest
  // Handle Add to Cart buttons
document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", async () => {

      if(!userLoggedIn){
        // Show login modal
        const modalEl = document.getElementById("loginModal");
        if(modalEl){
          new bootstrap.Modal(modalEl).show();
        }
        return; // stop execution, do NOT add to cart
      }

      const productData = {
        id: button.dataset.id,
        name: button.dataset.name,
        price: button.dataset.price,
        image: button.dataset.image
      };

      // Send request to backend
      const res = await fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(productData)
      });

      const data = await res.json();
        showAlert(data.success ? '🛒 ' + data.message : '❌ Something went wrong.', data.success ? 'success' : 'danger');

      if (data.success) {
        const countEl = document.getElementById("cart-count");
        if (countEl) {
          // Instead of always adding +1, fetch updated count from backend
          const resCount = await fetch("{{ route('cart.count') }}");
          const countData = await resCount.json();
          countEl.textContent = countData.count; // ✅ exact total distinct products
        }

        button.innerHTML = '<i data-lucide="check"></i> Added';
        setTimeout(() => {
          button.innerHTML = '<i data-lucide="shopping-cart" class="me-1"></i> Add to Cart';
          lucide.createIcons();
        }, 1500);
      }

      // Alert helper
        function showAlert(message, type) {
            const alertBox = document.createElement('div');
            alertBox.className = `alert alert-${type} position-fixed top-0 start-50 translate-middle-x mt-3 shadow`;
            alertBox.style.zIndex = 9999;
            alertBox.textContent = message;
            document.body.appendChild(alertBox);
            setTimeout(() => alertBox.remove(), 2500);
        }
    });
  });

  lucide.createIcons();
});
</script>
@endpush




