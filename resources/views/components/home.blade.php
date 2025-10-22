@extends('layouts.user')

@section('title', 'Home')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="bg-light border-bottom w-100 min-vh-75 d-flex align-items-center">
    <div class="container py-5" style="height: 100vh;">
        <div class="row align-items-center g-5">
            <div class="col-md-6 text-center text-md-start">
                <h1 class="display-4 fw-bold text-dark mb-4">
                    Experience <span class="text-primary-emphasis">Premium</span> for Modern Living
                </h1>
                <p class="fs-5 text-secondary mb-4">
                    Discover our curated collection of high-quality electronics and accessories designed to seamlessly enhance your lifestyle and productivity.
                </p>
                <a href="{{ route('shop') }}" class="btn btn-dark btn-lg me-3 px-4 py-2 shadow-sm">Shop Now</a>
                <a href="{{ route('about') }}" class="btn btn-outline-dark btn-lg px-4 py-2">Learn More</a>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <img src="https://p3-ofp.static.pub//fes/cms/2025/04/29/g1i46qj9s4jax5zsk33oyvmf1g6dc1728551.png?width=400&height=400"
                     alt="Modern Electronic Products"
                     class="img-fluid"
                     style="max-width: 500px;">
            </div>
        </div>
    </div>
</section>

{{-- ===== FEATURED PRODUCTS ===== --}}
<section class="container py-5 my-md-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2 fs-2 text-dark">Featured <span class="text-primary-emphasis">Products</span></h2>
        <p class="text-secondary fs-5">Handpicked items that our customers love</p>
    </div>

    <div class="row g-4 justify-content-center">
        @foreach ($products as $product)
            @php
                $stock = $product->stock;
                $badgeClass = $stock > 10 ? 'bg-success' : ($stock > 0 ? 'bg-warning text-dark' : 'bg-danger');
                $status = $stock > 10 ? 'In Stock' : ($stock > 0 ? 'Low Stock' : 'Out of Stock');
            @endphp
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card border-0 shadow-sm h-100 product-card position-relative overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="card-img-top img-fluid"
                         alt="{{ $product->name }}"
                         style="object-fit: cover; height: 250px;">
                    <span class="position-absolute top-0 end-0 m-2 badge {{ $badgeClass }}">
                        {{ $status }}
                    </span>
                    <div class="card-body text-center p-3">
                        <h5 class="fw-semibold mb-1 text-dark">{{ $product->name }}</h5>
                        <p class="text-muted small mb-2">{{ $product->category ?? 'Uncategorized' }}</p>
                        <span class="fw-bold fs-5 d-block mb-3 text-primary">${{ number_format($product->price, 2) }}</span>
                        <a class="btn btn-dark btn-sm w-100">Views Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('shop') }}" class="btn btn-outline-dark px-5 py-2">View All Products</a>
    </div>
</section>

{{-- ===== WHY CHOOSE US ===== --}}
<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Why Choose <span class="text-primary">STORE</span>?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <i class="bi bi-shield-check fs-1 text-primary"></i>
                <h5 class="mt-3 fw-semibold">Guaranteed Quality</h5>
                <p class="text-secondary small">Every product is meticulously tested to meet the highest performance and durability standards.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-truck fs-1 text-primary"></i>
                <h5 class="mt-3 fw-semibold">Fast & Free Shipping</h5>
                <p class="text-secondary small">Enjoy quick processing and free shipping on all orders over a minimum purchase amount.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-headphones fs-1 text-primary"></i>
                <h5 class="mt-3 fw-semibold">Dedicated Support</h5>
                <p class="text-secondary small">Our friendly support team is ready to assist you 24/7 with any inquiries or issues.</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== TESTIMONIALS ===== --}}
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">What Our Customers Say</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm">
                    <p class="text-secondary">"Great quality products and excellent support. Highly recommend!"</p>
                    <h6 class="fw-semibold mt-3 mb-0">Sokha R.</h6>
                    <small class="text-muted">Verified Buyer</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm">
                    <p class="text-secondary">"Fast shipping and amazing products. Very satisfied."</p>
                    <h6 class="fw-semibold mt-3 mb-0">Piseth S.</h6>
                    <small class="text-muted">Verified Buyer</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm">
                    <p class="text-secondary">"Customer support is excellent and product quality is top-notch."</p>
                    <h6 class="fw-semibold mt-3 mb-0">Srey N.</h6>
                    <small class="text-muted">Verified Buyer</small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== CTA SECTION ===== --}}
<section class="bg-dark text-white text-center py-5">
    <h2 class="fw-bold mb-3">Find Your Perfect Gadget Today</h2>
    <p class="text-light mb-4">Discover top-quality electronics at unbeatable prices.</p>
    <a href="{{ route('shop') }}" class="btn btn-light px-4 py-2">Shop Now</a>
</section>

@endsection
