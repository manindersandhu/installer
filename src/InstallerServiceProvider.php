<?php
namespace Manindersandhu\Installer; 
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router; 
use Lara\Installer\Http\Middlewares\IsInstalled;

class InstallerServiceProvider extends ServiceProvider
{ 
    public function boot(Router $router)
    {   
        $this->loadViewsFrom(__DIR__.'/views','Installer');
        // $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $router->middlewareGroup('installer', [IsInstalled::class]);
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

    } 
    public function register()
    { 
     }
}
