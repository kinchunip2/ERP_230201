<?php

namespace Modules\Project\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Project\Http\View\Composers\AppComposer;
use Illuminate\Support\Facades\View;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function boot(){
        View::composer('backEnd.master', AppComposer::class);
        View::composer('layouts.app_vue', AppComposer::class);
        View::composer('layouts.app_task', AppComposer::class);
    }
}
