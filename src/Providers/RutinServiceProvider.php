<?php
namespace Damenjo\Rutin\Providers;

use Illuminate\Support\ServiceProvider;

class RutinServiceProvider extends ServiceProvider {
    public function boot()
    {
        $this->loadRoutesFrom(dirname(__DIR__,1) . "/routes/web.php");
    }

    public function register()
    {
    
    }
}