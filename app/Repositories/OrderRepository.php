<?php

namespace App\Repositories;

use App\DTO\OrderDTO;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Order::with('product')->paginate(15);
    }

    public function find(int $id): ?OrderDTO
    {
        $order = Order::find($id);
        return $order ? OrderDTO::fromModel($order) : null;
    }

    public function findWithProduct(int $id): ?OrderDTO
    {
        $order = Order::with('product')->find($id);
        return $order ? OrderDTO::fromModel($order) : null;
    }

    public function create(OrderDTO $dto): OrderDTO
    {
        $product = Product::findOrFail($dto->productId);

        $order = Order::create([
            'customer_name' => $dto->customerName,
            'product_id' => $dto->productId,
            'quantity' => $dto->quantity,
            'status' => $dto->status,
            'comment' => $dto->comment,
            'total_price' => $product->price * $dto->quantity
        ]);

        return OrderDTO::fromModel($order->load('product'));
    }

    public function update(int $id, OrderDTO $dto): OrderDTO
    {
        $order = Order::findOrFail($id);
        $order->update($dto->toArray());
        return OrderDTO::fromModel($order->fresh()->load('product'));
    }

    public function complete(int $id): OrderDTO
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'completed']);
        return OrderDTO::fromModel($order->fresh());
    }

    public function delete(int $id): bool
    {
        return Order::destroy($id) > 0;
    }
}
