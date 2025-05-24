@extends('layouts.app')

@section('content')
    <h1>Orders</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d.m.Y') }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>
                        <span class="badge bg-{{ $order->status === 'new' ? 'warning' : 'success' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                </td>
                <td>{{ number_format($order->total_price, 2) }} ₽</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links()}}
@endsection
