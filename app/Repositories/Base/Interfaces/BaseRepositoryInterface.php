<?php

namespace App\Repositories\Base\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function create(array $attributes): Model;
    public function update(array $attributes, int $id): object;
    public function find(int $id, array $with = []);
    public function findBy(array $data, array $with = [], string $orderBy = "id", string $sortBy = "asc");
    public function findOneBy(array $data, array $with = [], array $withCount = []);
    public function delete(int $id): bool;
    public function insert(array $attributes): bool;
    public function all(array $columns = ["*"], array $with = [], string $orderBy = "id", string $sortBy = "asc");
    public function allWhere(array $columns = ["*"], array $where = [], array $with = [], string $orderBy = "id", string $sortBy = "asc"): mixed;
    public function newModelInstance();
    public function updateOrCreate(array $search, array $attributes);
}
