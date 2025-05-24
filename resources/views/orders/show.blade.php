@extends('layouts.app')

@section('content')
    <h1>Order #{{ $order->id }}</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Customer:</strong> {{ $order->customer_name }}</p>
            <p class="card-text"><strong>Date:</strong>
                {{ $order->created_at?->format('d.m.Y H:i') }}
            </p>
            </p>            <p class="card-text">
                <strong>Status:</strong>
                <span class="badge bg-{{ $order->status === 'new' ? 'warning' : 'success' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p class="card-text"><strong>Product:</strong> {{ $order->product->name }}</p>
            <p class="card-text"><strong>Quantity:</strong> {{ $order->quantity }}</p>
            <p class="card-text"><strong>Unit Price:</strong> {{ number_format($order->product->price, 2) }} ₽</p>
            <p class="card-text"><strong>Total Price:</strong> {{ number_format($order->total_price, 2) }} ₽</p>
            <p class="card-text"><strong>Comment:</strong> {{ $order->comment }}</p>

            @if($order->status === 'new')
                <form action="{{ route('orders.complete', $order->id) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-success">Mark as Completed</button>
                </form>
            @endif

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
