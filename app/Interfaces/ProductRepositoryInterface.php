<?php

namespace App\Interfaces;

use App\DTO\ProductDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function find(int $id): ?ProductDTO;
    public function create(ProductDTO $dto): ProductDTO;
    public function update(int $id, ProductDTO $dto): ProductDTO;
    public function delete(int $id): void;
}
