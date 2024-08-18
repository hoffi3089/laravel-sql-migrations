<?php

namespace SqlMigrations;

use Illuminate\Support\ServiceProvider;
use SqlMigrations\Console\MigrateMakeCommand;
use SqlMigrations\Console\ModelMakeCommand;

class SqlMigrationsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->extendMigrateMakeCommand();
    }

    /**
     * Extend MigrateMake command.
     *
     * @return void
     */
    protected function extendMigrateMakeCommand()
    {
        $this->app->extend('command.migrate.make', function ($command, $app) {
            return new MigrateMakeCommand(
                $app['migration.creator'],
                $app['composer']
            );
        });

        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand(
                $app['files']
            );
        });
    }
}
