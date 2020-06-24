<?php

namespace App\Providers;

use App\Http\Resources\BookableIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Psy\Util\Json;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //BookableIndexResource::withoutWrapping();
        JsonResource::withoutWrapping();
    }
}
