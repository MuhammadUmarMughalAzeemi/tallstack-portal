<?php

namespace App\Repositories\Base;

use App\Repositories\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, int $id): object
    {
        $item = $this->model->find($id);
        if ($item) {
            $item->update($attributes);
        }

        return $item ?? $this->model;
    }

    public function find(int $id, array $with = []): Builder|Collection|Model|null
    {
        return $this->model->with($with)->find($id);
    }

    public function findBy(array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->where($data)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    public function findOneBy(array $data, array $with = [], array $withCount = []): ?Model
    {
        return $this->model->where($data)->with($with)->withCount($withCount)->first();
    }

    public function delete(int $id): bool
    {
        $item = $this->model->find($id);

        return $item ? (bool) $item->delete() : false;
    }

    public function insert(array $attributes): bool
    {
        return $this->model->query()->insert($attributes);
    }

    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->with($with)->orderBy($orderBy, $sortBy)->get($columns);
    }

    public function allWhere(
        array $columns = ['*'],
        array $where = [],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->model->query()->select($columns)->where($where)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    public function newModelInstance(): Model
    {
        return new $this->model();
    }

    public function updateOrCreate(array $search, array $attributes): Model
    {
        return $this->model->updateOrCreate($search, $attributes);
    }
}
