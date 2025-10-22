@extends('layouts.user')

@section('title', 'about')

@section('content')

  <!-- Hero -->
  <section class="bg-light border-bottom border-border text-center">
    <div class="container py-4">
      <h1 class="fw-bold display-5 mb-3 text-foreground">About STORE</h1>
      <p class="fs-5 text-muted-foreground text-pretty mx-auto" style="max-width: 700px;">
        We're passionate about bringing you the best electronics and accessories to enhance your digital lifestyle.
      </p>
    </div>
  </section>

  <!-- Main -->
  <main class="container py-4">

    <!-- Our Story -->
    <section class="mb-4">
      <div class="row align-items-center gy-4">
        <div class="col-lg-6">
          <h2 class="fw-bold fs-2 mb-3">Our Story</h2>
          <p class="text-muted-foreground">
            Founded in 2020, STORE began with a simple mission: to make premium technology accessible to everyone.
            What started as a small online shop has grown into a trusted destination for tech enthusiasts and professionals alike.
          </p>
          <p class="text-muted-foreground">
            We carefully curate every product in our catalog, ensuring that each item meets our high standards for quality, functionality, and value.
          </p>
          <p class="text-muted-foreground mb-0">
            Today, we serve thousands of customers worldwide, helping them find the perfect tech solutions for their needs.
          </p>
        </div>
        <div class="col-lg-6">
          <div class="ratio ratio-16x9 rounded-lg overflow-hidden">
            <img src="{{ asset('images/modern-office.png') }}" class="img-fluid object-fit-cover" alt="Our workspace">
          </div>
        </div>
      </div>
    </section>

    <!-- Stats -->
    <section class="mb-4">
      <div class="row text-center gy-3">
        <div class="col-6 col-md-3">
          <div class="text-center">
            <div class="rounded-full bg-light d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
              </svg>
            </div>
            <div class="fs-3 fw-bold mb-1 text-foreground">50K+</div>
            <p class="text-muted-foreground mb-0 small">Happy Customers</p>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="text-center">
            <div class="rounded-full bg-light d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
              </svg>
            </div>
            <div class="fs-3 fw-bold mb-1 text-foreground">500+</div>
            <p class="text-muted-foreground mb-0 small">Products</p>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="text-center">
            <div class="rounded-full bg-light d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
              <i class="bi bi-award" style="font-size: 30px"></i>
            </div>
            <div class="fs-3 fw-bold mb-1 text-foreground">4.8/5</div>
            <p class="text-muted-foreground mb-0 small">Average Rating</p>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="text-center">
            <div class="rounded-full bg-light d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
              <i class="bi bi-graph-up" style="font-size: 30px"></i>
            </div>
            <div class="fs-3 fw-bold mb-1 text-foreground">5 Years</div>
            <p class="text-muted-foreground mb-0 small">In Business</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Values -->
    <section class="mb-4">
      <div class="text-center mb-4">
        <h2 class="fw-bold fs-2 mb-2 text-foreground">Our Values</h2>
        <p class="text-muted-foreground mx-auto" style="max-width: 700px;">
          These core principles guide everything we do and shape our relationships with customers and partners.
        </p>
      </div>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="border border-border bg-card rounded-lg p-4 h-100">
            <h4 class="fw-bold mb-2">Quality First</h4>
            <p class="text-muted-foreground mb-0">
              We never compromise on quality. Every product is carefully selected and tested to ensure it meets our high standards.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="border border-border bg-card rounded-lg p-4 h-100">
            <h4 class="fw-bold mb-2">Customer Focus</h4>
            <p class="text-muted-foreground mb-0">
              Your satisfaction is our priority. We're here to help you find the perfect products and provide excellent support.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="border border-border bg-card rounded-lg p-4 h-100">
            <h4 class="fw-bold mb-2">Innovation</h4>
            <p class="text-muted-foreground mb-0">
              We stay ahead of tech trends to bring you the latest and most innovative products on the market.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="bg-light border border-border rounded-lg text-center p-4">
      <h2 class="fw-bold mb-2 text-foreground">Ready to Shop?</h2>
      <p class="text-muted-foreground mb-5 mx-auto" style="max-width: 600px;">
        Explore our curated collection of premium electronics and accessories.
      </p>
      <a href="{{ route('shop') }}" class="btn-black text-decoration-none">Browse Products</a>
    </section>

  </main>

@endsection