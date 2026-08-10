<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CnicPassports\Interfaces\CnicPassportRepositoryInterface;
use App\Repositories\CnicPassports\CnicPassportRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);


        $this->app->bind(CnicPassportRepositoryInterface::class, CnicPassportRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
