<?php

namespace App\Http\Controllers;

use App\DTO\OrderDTO;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $service) {}

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function index()
    {
        $orders = Order::with('product')->paginate(15);
        return view('orders.index', compact('orders'));
    }

    public function store(StoreOrderRequest $request)
    {
        $dto = new OrderDTO(
            null,
            $request->customer_name,
            $request->product_id,
            Product::findOrFail($request->product_id),
            $request->quantity,
            'new',
            $request->comment
        );

        $this->service->createOrder($dto);
        return redirect()->route('orders.index');
    }

    public function update(StoreOrderRequest $request, int $id)
    {
        $dto = new OrderDTO(
            $id,
            $request->customer_name,
            $request->product_id,
            Product::findOrFail($request->product_id),
            $request->quantity,
            $request->status,
            $request->comment
        );

        $this->service->updateOrder($id, $dto);
        return redirect()->route('orders.show', $id);
    }

    public function complete(int $id)
    {
        $this->service->completeOrder($id);
        return redirect()->route('orders.show', $id);
    }
}
