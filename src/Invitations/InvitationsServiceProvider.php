<?php
namespace Jameron\Invitations;

use Illuminate\Support\ServiceProvider;

class InvitationsServiceProvider extends ServiceProvider {

    protected $package = 'invitations';
    protected $routes = '../routes/routes.php';
    protected $views = '../resources/views';
    protected $policies = [];


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/../config/invitations.php' => config_path('invitations.php'),
            __DIR__.'/../resources/views' => resource_path('views/vendor'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(resource_path('views/vendor'), 'invitations');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app->bind('Invitation', function()
        {
            return new Jameron\Invitations\Invitation;
        });

        $this->app->bind('App\User', function ($app) {
            return new \App\User();
        });

    }
}
