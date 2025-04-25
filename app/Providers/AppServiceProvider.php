<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;

use App\Models\Tarea;
use App\Policies\TareaPolicy;
use Illuminate\Support\Facades\Gate;

use App\Models\Archivo;
use App\Policies\ArchivoPolicy;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar la política para Tarea
        Gate::policy(Tarea::class, TareaPolicy::class);
        Gate::policy(Archivo::class, ArchivoPolicy::class);

    }
}
