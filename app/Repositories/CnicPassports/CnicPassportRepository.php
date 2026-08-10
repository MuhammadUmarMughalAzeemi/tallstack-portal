<?php

namespace App\Repositories\CnicPassports;

use App\Models\CnicPassport;
use App\Repositories\Base\BaseRepository;
use App\Repositories\CnicPassports\Interfaces\CnicPassportRepositoryInterface;

class CnicPassportRepository extends BaseRepository implements CnicPassportRepositoryInterface
{
    /**
     * CnicPassportRepository constructor.
     *
     * @param CnicPassport $model
     */
    public function __construct(CnicPassport $model)
    {
        parent::__construct($model);
    }
}
