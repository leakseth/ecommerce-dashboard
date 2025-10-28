@extends('layouts.user')

@section('title', 'Shop')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<section class="bg-light border-bottom py-5">
  <div class="container text-center text-md-start">
    <h1 class="fw-bold display-5 text-dark mb-3 text-center" >Shop All Products</h1>
    <p class="fs-5 text-secondary mb-0 text-center">Browse our complete collection of premium electronics and accessories.</p>
  </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<main class="container py-5">
 <!-- Filters -->
<div class="mb-5" >
  <form id="searchForm" method="GET" action="{{ route('shop') }}" class="d-flex flex-column flex-sm-row gap-3 mb-3">
    <div class="position-relative flex-grow-1" style="max-width: 400px;">
      <i data-lucide="search" class=" bi bi-search position-absolute top-50 translate-middle-y start-0 ms-3 text-muted" style="width: 20px; height: 23px;"></i>
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

  <div class="d-flex flex-wrap justify-content-between align-items-center" >
    <div class="d-flex flex-wrap gap-2">
      <a href="{{ route('shop') }}" class="btn btn-sm rounded-pill px-3 {{ !request('category') ? 'btn-dark' : 'btn-outline-dark' }}">All</a>
      @foreach ($categories as $category)
        <a href="{{ route('shop', ['category' => $category->id, 'search' => request('search'), 'sort' => request('sort')]) }}"
          class="btn btn-sm rounded-pill px-3 {{ request('category') == $category->id ? 'btn-dark' : 'btn-outline-dark' }}">
          {{ $category->name }}
        </a>
      @endforeach
    </div>

    <!-- Sort Dropdown -->
    <div class="d-flex justify-content-end mb-4">
      <form method="GET" action="{{ route('shop') }}" class="d-flex align-items-center gap-2">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <input type="hidden" name="category" value="{{ request('category') }}">
        
        <label for="sort" class="fw-semibold text-secondary me-2">Sort by:</label>
        <select name="sort" id="sort" class="form-select form-select-sm border-dark shadow-none  sort-no-bg" onchange="this.form.submit()">
          <option value="">Newest</option>
          <option value="low_high" {{ request('sort') == 'low_high' ? 'selected' : '' }}>Price: Low to High</option>
          <option value="high_low" {{ request('sort') == 'high_low' ? 'selected' : '' }}>Price: High to Low</option>
        </select>
      </form>
    </div>
  </div>
</div>


  <!-- ===== PRODUCTS GRID ===== -->
  <div id="productGrid" class="row g-4"  data-aos="fade-up" data-aos-delay="300">
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

  // Sorting change handler
  const sortSelect = document.getElementById('sort');
  if (sortSelect) {
    sortSelect.addEventListener('change', () => {
      const params = new URLSearchParams(window.location.search);
      params.set('sort', sortSelect.value);
      const url = `{{ route('shop') }}?${params.toString()}`;
      fetchFilteredData(url);
    });
  }

});
</script>


<style>
.product-card img { transition: transform 0.3s ease; }
.scale-105 { transform: scale(1.05); }
.btn:hover { color: #fff !important; }

.sort-no-bg {
    background-color: transparent !important; /* removes default gray background */
    color: #212529; /* make text readable */
    -webkit-appearance: none; /* remove default arrow style on Safari/Chrome */
    -moz-appearance: none; /* remove default arrow style on Firefox */
    appearance: none; /* remove default arrow */
}

.sort-no-bg:focus {
    box-shadow: none !important; /* remove focus shadow */
    border-color: #212529; /* optional: keep border consistent */
}


</style>
@endpush
