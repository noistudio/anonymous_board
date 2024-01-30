<?php

namespace App\Providers;

use App\Api\Domain\Board\Services\BoardService;
use App\Api\Domain\EditorJS\Services\EditorJSService;
use App\Api\Domain\Thread\Services\ThreadService;
use App\Api\Infrastructure\Board\Services\BoardClientService;
use App\Api\Infrastructure\EditorJS\Services\EditorJSClientService;
use App\Api\Infrastructure\Thread\Services\ThreadClientService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(BoardService::class,function(){
            return new BoardClientService();
        });
        $this->app->bind(ThreadService::class,function(){
            return new ThreadClientService();
        });
        $this->app->singleton(EditorJSService::class,EditorJSClientService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer("web.layout.main",function(\Illuminate\View\View $view){

            $view->with("search_value",request()->input('search'));
        });
        //
    }
}
