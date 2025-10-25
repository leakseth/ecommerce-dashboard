@extends('layouts.user')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Checkout</h2>

    <div class="row">
        <!-- Left Side: Shipping Info -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Shipping Information</h5>
                    <form action="{{ route('checkout.confirm') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2" required>{{ auth()->user()->address ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="ABA Pay">ABA Pay</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 mt-3">Confirm Order</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side: Order Summary -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
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
                                <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
