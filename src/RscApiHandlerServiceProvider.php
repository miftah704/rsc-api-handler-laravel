<?php

namespace Mivu;

use Illuminate\Support\ServiceProvider;
use Mivu\Console\Commands\MakeEnumCommand;
use Mivu\Console\Commands\MakeFileRepositoryCommand;
use Mivu\Console\Commands\MakeFileServiceCommand;
use Mivu\Console\Commands\MakeHandlerCommand;
use Mivu\Handlers\ApiHandlers;
use Mivu\Handlers\ResponseHandlers;

class RscApiHandlerServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->singleton(ApiHandlers::class, function () {
            return new ApiHandlers();
        });
        $this->app->singleton(ResponseHandlers::class, function () {
            return new ResponseHandlers();
        });
        $this->commands([
            MakeFileServiceCommand::class,
            MakeFileRepositoryCommand::class,
            MakeHandlerCommand::class,
            MakeEnumCommand::class
        ]);
    }
}
