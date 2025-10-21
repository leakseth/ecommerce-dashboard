@extends('layouts.app')

@section('title', 'shop')

@section('content')

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

@endsection

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