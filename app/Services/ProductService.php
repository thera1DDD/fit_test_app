<?php

namespace App\Services;

use App\DTO\ProductDTO;
use App\Interfaces\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $repository
    ) {}

    public function getAllProducts()
    {
        return $this->repository->getAll();
    }

    public function getProduct(int $id): ?ProductDTO
    {
        return $this->repository->find($id);
    }

    public function createProduct(ProductDTO $dto): ProductDTO
    {
        return $this->repository->create($dto);
    }

    public function updateProduct(int $id, ProductDTO $dto): ProductDTO
    {
        return $this->repository->update($id, $dto);
    }

    public function deleteProduct(int $id): void
    {
        $this->repository->delete($id);
    }
}
