@extends('layouts.user')

@section('title', 'Contact STORE')

@section('content')

<!-- Hero Section -->
<section class="bg-light py-5 border-bottom text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3 text-dark">Get in Touch</h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">
            Have a question or need help? Send us a message below and we’ll get back to you soon.
        </p>
    </div>
</section>

<!-- Main Content -->
<main class="container py-5">
    <div class="row g-4">

        <!-- Contact Information -->
        <div class="col-lg-4">
            <h2 class="fw-bold mb-4 text-dark">Contact Information</h2>

            <div class="d-flex gap-3 mb-4 align-items-start">
                <div class="bg-light rounded p-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                    <i class="bi bi-envelope-fill fs-5 text-primary"></i>
                </div>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark">Email</h6>
                    <p class="mb-0 text-muted">support@store.com</p>
                </div>
            </div>

            <div class="d-flex gap-3 mb-4 align-items-start">
                <div class="bg-light rounded p-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                    <i class="bi bi-telephone-fill fs-5 text-primary"></i>
                </div>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark">Phone</h6>
                    <p class="mb-0 text-muted">+1 (555) 123-4567</p>
                </div>
            </div>

            <div class="d-flex gap-3 mb-4 align-items-start">
                <div class="bg-light rounded p-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                    <i class="bi bi-geo-alt-fill fs-5 text-primary"></i>
                </div>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark">Address</h6>
                    <p class="mb-0 text-muted">123 Tech Street, San Francisco, CA 94102</p>
                </div>
            </div>

            <div class="bg-white border rounded p-4 shadow-sm">
                <h6 class="fw-semibold mb-3 text-dark">Business Hours</h6>
                <div class="d-flex justify-content-between small mb-2">
                    <span class="text-muted">Monday - Friday</span>
                    <span class="text-dark">9:00 AM - 6:00 PM</span>
                </div>
                <div class="d-flex justify-content-between small mb-2">
                    <span class="text-muted">Saturday</span>
                    <span class="text-dark">10:00 AM - 4:00 PM</span>
                </div>
                <div class="d-flex justify-content-between small">
                    <span class="text-muted">Sunday</span>
                    <span class="text-dark">Closed</span>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="bg-white border rounded p-4 p-md-5 shadow-sm">
                <h2 class="fw-bold mb-4 text-dark">Send us a Message</h2>
               @if(session('success_admin'))
                    <div class="alert alert-success">{{ session('success_admin') }}</div>
                @endif

                @if(session('success_user'))
                    <div class="alert alert-info">{{ session('success_user') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif


                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-dark">Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-dark">Email *</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-dark">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="How can we help?">
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-dark">Message *</label>
                        <textarea name="message" rows="5" class="form-control" placeholder="Tell us more..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-send-fill"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </div>

    </div>
</main>

@endsection

<style>
  /* --- Minimal Input Fields & Textareas --- */
input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 12px 16px;
    font-size: 1rem;
    border: 1px solid #ced4da; /* simple gray border */
    border-radius: 0.5rem;      /* rounded corners */
    background-color: #fff;
    box-shadow: none;            /* no shadow at all */
    outline: none;               /* remove default outline */
    transition: none;            /* no transition effect */
}

/* Remove hover/focus effects completely */
input[type="text"]:hover,
input[type="email"]:hover,
textarea:hover,
input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
    border-color: #ced4da;  /* keep same border on hover/focus */
    box-shadow: none;        /* no shadow */
    outline: none;
}

textarea {
    resize: vertical; /* allow only vertical resize */
    min-height: 120px;
}

::placeholder {
    color: #6c757d; /* placeholder color */
    opacity: 1;
}

input:disabled,
textarea:disabled {
    background-color: #e9ecef;
    cursor: not-allowed;
}

</style>