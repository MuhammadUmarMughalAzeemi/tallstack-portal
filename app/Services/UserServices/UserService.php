<?php

namespace App\Services\UserServices;

use App\Repositories\CnicPassports\Interfaces\CnicPassportRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    protected $cnicPassportRepositoryInterface;

    public function __construct(
        CnicPassportRepositoryInterface $cnicPassportRepositoryInterface,
    ) {
        $this->cnicPassportRepositoryInterface = $cnicPassportRepositoryInterface;
    }

    public function getAllCnicPassport(
        array $columns = ['*'],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): Collection {
        return $this->cnicPassportRepositoryInterface->all($columns, $with, $orderBy, $sortBy);
    }
}
