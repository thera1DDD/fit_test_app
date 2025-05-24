<?php

namespace App\Interfaces;

use App\DTO\OrderDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function find(int $id): ?OrderDTO;
    public function findWithProduct(int $id): ?OrderDTO;
    public function create(OrderDTO $dto): OrderDTO;
    public function update(int $id, OrderDTO $dto): OrderDTO;
    public function complete(int $id): OrderDTO;
    public function delete(int $id): bool;
}
