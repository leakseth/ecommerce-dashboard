@extends('layouts.user')

@section('title', 'About STORE')

@section('content')

<!-- Hero Section -->
<section class="bg-light py-5 border-bottom">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">About STORE</h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">
            We're passionate about bringing you the best electronics and accessories to enhance your digital lifestyle.
        </p>
    </div>
</section>

<!-- Main Content -->
<main class="container py-5">

    <!-- Our Story -->
    <section class="mb-5">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Our Story</h2>
                <p class="text-muted mb-2">
                    Founded in 2020, STORE began with a simple mission: to make premium technology accessible to everyone.
                    What started as a small online shop has grown into a trusted destination for tech enthusiasts and professionals alike.
                </p>
                <p class="text-muted mb-2">
                    We carefully curate every product in our catalog, ensuring that each item meets our high standards for quality, functionality, and value.
                </p>
                <p class="text-muted mb-0">
                    Today, we serve thousands of customers worldwide, helping them find the perfect tech solutions for their needs.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                    <img src="{{ asset('images/modern-office.png') }}" alt="Our workspace" class="img-fluid object-fit-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="mb-5 text-center">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm py-4">
                    <div class="fs-3 fw-bold text-primary mb-1">50K+</div>
                    <p class="mb-0 text-muted small">Happy Customers</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm py-4">
                    <div class="fs-3 fw-bold text-primary mb-1">500+</div>
                    <p class="mb-0 text-muted small">Products</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm py-4">
                    <div class="fs-3 fw-bold text-primary mb-1">4.8/5</div>
                    <p class="mb-0 text-muted small">Average Rating</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm py-4">
                    <div class="fs-3 fw-bold text-primary mb-1">5 Years</div>
                    <p class="mb-0 text-muted small">In Business</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="mb-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2">Our Values</h2>
            <p class="text-muted mx-auto" style="max-width: 700px;">These core principles guide everything we do and shape our relationships with customers and partners.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <h4 class="fw-bold mb-2">Quality First</h4>
                    <p class="text-muted mb-0">We never compromise on quality. Every product is carefully selected and tested to ensure it meets our high standards.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <h4 class="fw-bold mb-2">Customer Focus</h4>
                    <p class="text-muted mb-0">Your satisfaction is our priority. We're here to help you find the perfect products and provide excellent support.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <h4 class="fw-bold mb-2">Innovation</h4>
                    <p class="text-muted mb-0">We stay ahead of tech trends to bring you the latest and most innovative products on the market.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="text-center bg-light rounded p-5">
        <h2 class="fw-bold mb-3">Ready to Shop?</h2>
        <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">
            Explore our curated collection of premium electronics and accessories.
        </p>
        <a href="{{ route('shop') }}" class="btn btn-dark btn-lg rounded-pill">Browse Products</a>
    </section>

</main>

@endsection
