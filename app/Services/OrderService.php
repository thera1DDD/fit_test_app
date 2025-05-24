<?php

namespace App\Services;

use App\DTO\OrderDTO;
use App\Interfaces\OrderRepositoryInterface;

class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $repository
    ) {}

    public function getAllOrders(): array
    {
        return $this->repository->getAll()->items();
    }

    public function getOrder(int $id): ?OrderDTO
    {
        return $this->repository->findWithProduct($id);
    }

    public function createOrder(OrderDTO $dto): OrderDTO
    {
        return $this->repository->create($dto);
    }

    public function updateOrder(int $id, OrderDTO $dto): OrderDTO
    {
        return $this->repository->update($id, $dto);
    }

    public function completeOrder(int $id): OrderDTO
    {
        return $this->repository->complete($id);
    }

    public function deleteOrder(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
