<?php

namespace App\DTO;

use App\Models\Product;

class ProductDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly object $category,
        public readonly ?string $description,
        public readonly float $price,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null
    ) {}

    public static function fromModel(Product $product): self
    {
        return new self(
            $product->id,
            $product->name,
            (object)[
                'id' => $product->category->id,
                'name' => $product->category->name
            ],
            $product->description,
            $product->price,
            $product->created_at,
            $product->updated_at
        );
    }
}
