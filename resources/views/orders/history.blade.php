@extends('layouts.user')

@section('title', 'Order History')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Order History</h2>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        @foreach($orders as $order)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold">Order #{{ $order->order_number }}</h5>
                <p>Status: <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span></p>
                <ul class="list-group mb-2">
                    @foreach($order->orderItems as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->product->name }} (Qty: {{ $item->quantity }})
                        <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                    </li>
                    @endforeach
                </ul>
                <p class="fw-bold text-end">Total: ${{ number_format($order->total, 2) }}</p>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
