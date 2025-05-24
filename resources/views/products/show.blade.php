@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
            <p class="card-text"><strong>Price:</strong> {{ number_format($product->price, 2) }} ₽</p>
            <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
