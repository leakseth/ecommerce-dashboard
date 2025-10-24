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
  <!-- Search and Filters -->
  <div class="mb-5">
    <form id="searchForm" method="GET" action="{{ route('shop') }}" class="d-flex flex-column flex-sm-row gap-3 mb-3">
      <div class="position-relative flex-grow-1" style="max-width: 400px;">
        <i data-lucide="search"
          class="position-absolute top-50 translate-middle-y start-0 ms-3 text-muted"
          style="width: 16px; height: 16px;"></i>
        <input
          type="text"
          name="search"
          id="searchInput"
          value="{{ request('search') }}"
          placeholder="Search products..."
          class="form-control ps-5 border border-dark rounded-lg text-dark shadow-sm"
        />
      </div>
    </form>

    <!-- Category Filter Buttons -->
    <div class="d-flex flex-wrap gap-2" id="categoryFilters">
      <a href="{{ route('shop') }}"
        class="btn btn-sm rounded-pill px-3 {{ !request('category') ? 'btn-dark' : 'btn-outline-dark' }}">
        All
      </a>
      @foreach ($categories as $category)
        <a href="{{ route('shop', ['category' => $category->name, 'search' => request('search')]) }}"
          class="btn btn-sm rounded-pill px-3 {{ request('category') == $category->name ? 'btn-dark' : 'btn-outline-dark' }}">
          {{ $category->name }}
        </a>
      @endforeach
    </div>
  </div>

  <!-- ===== PRODUCTS GRID ===== -->
  <div id="productGrid" class="row g-4">
    @include('partials.product-grid', ['products' => $products])
  </div>

  <!-- Pagination -->
  <div class="mt-5 text-center" id="paginationLinks">
    {{ $products->links('pagination::bootstrap-5') }}
  </div>
</main>
@endsection

@push('scripts')
<script>

  
document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  let typingTimer;

  // Live search (auto reload while typing)
  searchInput.addEventListener('input', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => {
      fetchFilteredData();
    }, 400); // wait 400ms after last keystroke
  });

  async function fetchFilteredData(url = null) {
    const query = searchInput.value.trim();
    const category = new URLSearchParams(window.location.search).get('category');
    const params = new URLSearchParams();

    if (query) params.append('search', query);
    if (category) params.append('category', category);

    const fetchUrl = url || `{{ route('shop') }}?${params.toString()}`;

    try {
      const res = await fetch(fetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
      const html = await res.text();

      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');

      // Replace product grid and pagination
      document.getElementById('productGrid').innerHTML = doc.querySelector('#productGrid').innerHTML;
      document.getElementById('paginationLinks').innerHTML = doc.querySelector('#paginationLinks').innerHTML;

      lucide.createIcons(); // re-init icons
    } catch (err) {
      console.error('Error fetching search results:', err);
    }
  }

  // Handle pagination links dynamically
  document.addEventListener('click', function(e) {
    const link = e.target.closest('.pagination a');
    if (link) {
      e.preventDefault();
      fetchFilteredData(link.href);
    }
  });
});
</script>


<style>
.product-card img { transition: transform 0.3s ease; }
.scale-105 { transform: scale(1.05); }
.btn:hover { color: #fff !important; }


</style>
@endpush
