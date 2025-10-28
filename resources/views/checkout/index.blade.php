@extends('layouts.user')

@section('title', 'Checkout')

@section('content')
<style>
    /* 🌙 Custom Modern Input Style */
    .form-control, .form-select, textarea {
        border: 1px solid #e0e0e0 !important;
        border-radius: 10px !important;
        padding: 12px 14px !important;
        background-color: #fafafa !important;
        transition: all 0.2s ease-in-out;
        box-shadow: none !important;
    }

    .form-control:focus, 
    .form-select:focus, 
    textarea:focus {
        border-color: #000 !important;
        background-color: #fff !important;
        box-shadow: 0 0 0 0.2rem rgba(0,0,0,0.1) !important;
    }

    /* ✨ Card style */
    .card {
        border-radius: 16px !important;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08) !important;
        border: none !important;
    }

    /* 🖤 Button style */
    .btn-dark {
        border-radius: 12px !important;
        padding: 12px 0 !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.2s ease-in-out;
    }

    .btn-dark:hover {
        background-color: #222 !important;
        transform: translateY(-1px);
    }

    /* 🧾 Order list item style */
    .list-group-item {
        border: none !important;
        padding: 14px 0 !important;
        border-bottom: 1px solid #eee !important;
    }

    /* 🧭 Page layout */
    .checkout-container {
        min-height: 100vh;
        padding-top: 60px;
        padding-bottom: 60px;
        background-color: #f9f9f9;
    }
</style>

<div class="checkout-container">
    <div class="container">
        <h2 class="fw-bold mb-4 text-center">Checkout</h2>

        <div class="row g-4">
            <!-- Left: Shipping Info -->
            <div class="col-lg-6">
                <div class="card p-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Shipping Information</h5>

                        <form action="{{ route('checkout.confirm') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control" name="name" 
                                       value="{{ auth()->user()->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea name="address" class="form-control" rows="2" required>
                                    {{ auth()->user()->address ?? '' }}
                                </textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Payment Method</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="ABA Pay">ABA Pay</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-dark w-100">
                                Confirm Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="col-lg-6">
                <div class="card p-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Order Summary</h5>

                        <ul class="list-group list-group-flush">
                            @php $total = 0; @endphp
                            @foreach($cart as $item)
                                @php $total += $item['price'] * $item['quantity']; @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $item['name'] }}</strong>
                                        <div class="text-muted small">Qty: {{ $item['quantity'] }}</div>
                                    </div>
                                    <span class="fw-semibold">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5">Total:</span>
                            <span class="fw-bold fs-5">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
