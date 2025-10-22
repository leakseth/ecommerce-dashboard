@extends('layouts.user')

@section('title', 'about')

@section('content')

  <!-- Hero Section -->
  <section class="bg-gray-200 border-bottom border-gray-200 py-5 text-center">
    <div class="container">
      <h1 class="fw-bold display-5 text-gray-900 mb-3">Get in Touch</h1>
      <p class="fs-5 text-gray-600">
        Have a question or need assistance? We're here to help
      </p>
    </div>
  </section>

  <!-- Main Content -->
  <main class="container py-5">
    <div class="row g-4">
      <!-- Contact Information -->
      <div class="col-lg-4">
        <h2 class="fw-bold text-gray-900 mb-4">Contact Information</h2>

        <div class="d-flex gap-3 mb-4">
          <div class="d-flex align-items-center justify-content-center bg-gray-300 rounded-lg" style="width:48px;height:48px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" width="24" height="24" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 
                0L21 8M5 19h14a2 2 0 002-2V7a2 
                2 0 00-2-2H5a2 2 0 00-2 
                2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <div>
            <h6 class="fw-semibold text-gray-900 mb-1">Email</h6>
            <p class="text-gray-600 mb-0">support@store.com</p>
          </div>
        </div>

        <div class="d-flex gap-3 mb-4">
          <div class="d-flex align-items-center justify-content-center bg-gray-300 rounded-lg" style="width:48px;height:48px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" width="24" height="24" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 
                1 0 01.948.684l1.498 
                4.493a1 1 0 01-.502 
                1.21l-2.257 
                1.13a11.042 11.042 0 
                005.516 5.516l1.13-2.257a1 
                1 0 011.21-.502l4.493 
                1.498a1 1 0 01.684.949V19a2 
                2 0 01-2 2h-1C9.716 21 3 
                14.284 3 6V5z" />
            </svg>
          </div>
          <div>
            <h6 class="fw-semibold text-gray-900 mb-1">Phone</h6>
            <p class="text-gray-600 mb-0">+1 (555) 123-4567</p>
          </div>
        </div>

        <div class="d-flex gap-3 mb-4">
          <div class="d-flex align-items-center justify-content-center bg-gray-300 rounded-lg" style="width:48px;height:48px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" width="24" height="24" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 
                20.9a1.998 1.998 0 01-2.827 
                0l-4.244-4.243a8 8 0 
                1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11a3 3 0 
                11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <div>
            <h6 class="fw-semibold text-gray-900 mb-1">Address</h6>
            <p class="text-gray-600 mb-0">123 Tech Street, San Francisco, CA 94102</p>
          </div>
        </div>

        <div class="bg-white border rounded-lg p-4">
          <h6 class="fw-semibold text-gray-900 mb-3">Business Hours</h6>
          <div class="d-flex justify-content-between small mb-2">
            <span class="text-gray-600">Monday - Friday</span>
            <span class="text-gray-900">9:00 AM - 6:00 PM</span>
          </div>
          <div class="d-flex justify-content-between small mb-2">
            <span class="text-gray-600">Saturday</span>
            <span class="text-gray-900">10:00 AM - 4:00 PM</span>
          </div>
          <div class="d-flex justify-content-between small">
            <span class="text-gray-600">Sunday</span>
            <span class="text-gray-900">Closed</span>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-8">
        <div class="bg-white border rounded-lg p-4 p-md-5">
          <h2 class="fw-bold text-gray-900 mb-4">Send us a Message</h2>
          <form method="POST">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label text-gray-900">Name *</label>
                <input type="text" name="name" class="form-control" placeholder="Your name" required />
              </div>
              <div class="col-md-6">
                <label class="form-label text-gray-900">Email *</label>
                <input type="email" name="email" class="form-control" placeholder="your@email.com" required />
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label text-gray-900">Subject</label>
              <input type="text" name="subject" class="form-control" placeholder="How can we help?" />
            </div>

            <div class="mb-4">
              <label class="form-label text-gray-900">Message *</label>
              <textarea name="message" class="form-control" rows="5" placeholder="Tell us more about your inquiry..." required></textarea>
            </div>

            <button type="submit" class="btn btn-gray w-100 d-flex align-items-center justify-content-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" width="20" height="20" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 
                  0L21 8M5 19h14a2 2 0 
                  002-2V7a2 2 0 00-2-2H5a2 
                  2 0 00-2 2v10a2 2 0 002 
                  2z" />
              </svg>
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </main>

@endsection