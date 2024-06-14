<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    const controllerNamespace = 'App\Http\Controllers';
    protected $namespace = 'App\Http\Controllers';
    protected $clientNamespace = self::controllerNamespace.'\Client';
    protected $productNamespace = self::controllerNamespace.'\Product';
    protected $paymentNamespace = self::controllerNamespace.'\Payment';
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            $this->mapClientRoutes();
            $this->mapProductRoutes();
            $this->mapPaymentRoutes();
            $this->mapStatisticsRoutes();

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    protected function mapClientRoutes() {
        Route::prefix('client')
            ->middleware('api')
            ->namespace($this->clientNamespace)
            ->group(base_path('routes/client.php'));
    }

    protected function mapProductRoutes() {
        Route::prefix('product')
            ->middleware('api')
            ->namespace($this->productNamespace)
            ->group(base_path('routes/product.php'));
    }

    protected function mapPaymentRoutes() {
        Route::prefix('payment')
            ->middleware('api')
            ->namespace($this->paymentNamespace)
            ->group(base_path('routes/payment.php'));
    }
    protected function mapStatisticsRoutes() {
        Route::prefix('statistics')
            ->middleware('api')
            ->namespace($this->paymentNamespace)
            ->group(base_path('routes/statistics.php'));
    }
}
