<?php
namespace KapitalBankAPI\Providers;

use Illuminate\Support\ServiceProvider;
use KapitalBankAPI\Http\Client;
use KapitalBankAPI\Services\PaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Client::class);
        $this->app->singleton(PaymentService::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/kapitalbank.php' => config_path('kapitalbank.php'),
        ]);
    }
}
