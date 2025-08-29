<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            //Admin Routes
            Route::prefix('api')
                //  ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
            //Visitor Routes
            Route::prefix('/api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/visitor.php'));
            //Supervisor Routes 
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/supervisor.php'));
            //librarian Routes 
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/librarian.php'));
            //parent Routes 
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/parent.php'));
            //Teacher Routes 
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/teacher.php'));
            // An Active Routes 
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
