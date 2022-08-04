<?php

namespace App\Providers;

use App\Models;
use App\ProjectData\Contracts;
use App\ProjectData\Repositories;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class ProjectDataServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * @return void
     */
    private function registerRepositories(): void
    {
        $this->app->bind(Contracts\Repositories\ProjectRepository::class, function () {
            return new Repositories\ProjectRepository(new Models\Project());
        });
    }

    /**
     * @return void
     */
    private function registerServices(): void
    {
        //
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            Contracts\Repositories\ProjectRepository::class,
        ];
    }
}
