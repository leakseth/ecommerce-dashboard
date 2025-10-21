@extends('layouts.app')

@section('title', 'home')

@section('content')
  <!-- Hero Section -->
  <section class="bg-light border-bottom w-100 vh-75 d-flex align-items-center">
    <div class="container py-5">
      <div class="row align-items-center g-5">
        <div class="col-md-6 text-center text-md-start">
          <h1 class="display-4 fw-bold text-dark mb-4">Premium Products for Modern Living</h1>
          <p class="fs-5 text-secondary mb-4">
            Discover our curated collection of high-quality electronics and accessories designed to enhance your lifestyle.
          </p>
          <a href="{{ route('shop') }}" class="btn btn-black me-3 px-4 py-2">Shop now →</a>
          <a href="{{ route('about') }}" class="btn btn-outline-black px-4 py-2">Learn More</a>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <img src="{{ asset('images/main.png') }}" alt="Products" style="max-width: 500px;">
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="container py-5">
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2 fs-2 text-dark">Featured Products</h2>
      <p class="text-secondary">Handpicked items just for you</p>
    </div>

    <div class="row g-4">
      <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
          <img src="{{ asset('images/main.png') }}" class="card-img-top" alt="">
          <div class="card-body text-center">
            <h5 class="fw-semibold mb-1">Product Name</h5>
            <p class="text-muted small mb-3">Short description</p>
            <span class="fw-bold fs-5 d-block mb-3">$99</span>
            <a href="#" class="btn btn-dark btn-sm">View Details</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="container py-5">
    <div class="mx-auto text-center" style="max-width: 600px;">
      <h2 class="fw-bold mb-3 text-dark">Stay Updated</h2>
      <p class="text-secondary mb-4">Subscribe to our newsletter for exclusive deals and new product launches.</p>
      <form class="d-flex justify-content-center gap-3">
        <input type="email" class="form-control" placeholder="Enter your email">
        <button class="btn btn-dark px-4">Subscribe</button>
      </form>
    </div>
  </section>
@endsection
