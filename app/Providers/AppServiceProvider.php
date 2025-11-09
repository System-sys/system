<?php

namespace App\Providers;

use App\Models\Customer;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Http\Middleware\NoCache;
use Illuminate\Support\Facades\Route;


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
      $totalUsers = User::count(); // Cuenta todos los usuarios
      view()->share('totalUsers', $totalUsers);

      $totalCustomer = Customer::count(); // Cuenta todos los usuarios
      view()->share('totalCustomer', $totalCustomer);

      $registeredCustomers = Customer::where('registered', 1)->count();
      view()->share('registeredCustomers',  $registeredCustomers);

      Route::aliasMiddleware('no-cache', NoCache::class);

    }
}
