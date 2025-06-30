<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;

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
//     public function boot()
// {
//     if (Session::has('locale')) {
//         App::setLocale(Session::get('locale'));
//     }
// }
// public function boot()
// {
//     if (Session::has('locale')) {
//         App::setLocale(Session::get('locale'));
//     }
// }


public function boot()
{
    App::setLocale(Session::get('locale', config('app.locale')));

        Blade::directive('hasPermission', function ($expression) {
        return "<?php if(auth()->check() && \\App\\Helpers\\PermissionHelper::check({$expression})): ?>";
    });

    Blade::directive('endhasPermission', function () {
        return "<?php endif; ?>";
    });
}

}
