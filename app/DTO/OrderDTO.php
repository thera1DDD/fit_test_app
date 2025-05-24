<?php

namespace App\DTO;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;

class OrderDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $customerName,
        public readonly int $productId,
        public readonly Product $product,
        public readonly int $quantity,
        public readonly string $status,
        public readonly ?string $comment,
        public readonly ?float $totalPrice = null,
        public readonly ?Carbon $createdAt = null,
        public readonly ?Carbon $updatedAt = null
    ) {}

    public static function fromModel(Order $order): self
    {
        return new self(
            $order->id,
            $order->customer_name,
            $order->product_id,
            $order->product,
            $order->quantity,
            $order->status,
            $order->comment,
            $order->total_price,
            $order->created_at,
            $order->updated_at
        );
    }

    public function toArray(): array
    {
        return [
            'customer_name' => $this->customerName,
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'comment' => $this->comment,
            'total_price' => $this->totalPrice
        ];
    }
}
