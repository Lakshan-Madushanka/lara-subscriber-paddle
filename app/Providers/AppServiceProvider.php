<?php

namespace App\Providers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerLocally();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::shouldBeStrict(! $this->app->isProduction());
    }

    private function registerLocally(): void
    {
        if ($this->app->environment(['local'])) {
            $this->handleExceedingCumulativeQueryDuration();
        }
    }

    private function handleExceedingCumulativeQueryDuration(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        DB::listen(static function (QueryExecuted $event) {
            if ($event->time > 500) {
                throw new QueryException(
                    $event->sql,
                    $event->bindings,
                    new Exception('Individual database query exceeded 500ms.')
                );
            }
        });
    }
}
