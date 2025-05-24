<?php

namespace App\Repositories;

use App\DTO\ProductDTO;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Product::with('category')->paginate(10);
    }

    public function find(int $id): ?ProductDTO
    {
        $product = Product::with('category')->find($id);
        return $product ? ProductDTO::fromModel($product) : null;
    }

    public function create(ProductDTO $dto): ProductDTO
    {
        $product = Product::create([
            'name' => $dto->name,
            'category_id' => $dto->category->id,
            'description' => $dto->description,
            'price' => $dto->price,
        ]);

        return ProductDTO::fromModel($product->fresh());
    }

    public function update(int $id, ProductDTO $dto): ProductDTO
    {
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $dto->name,
            'category_id' => $dto->category->id,
            'description' => $dto->description,
            'price' => $dto->price,
        ]);

        return ProductDTO::fromModel($product->fresh());
    }

    public function delete(int $id): void
    {
        Product::destroy($id);
    }
}
