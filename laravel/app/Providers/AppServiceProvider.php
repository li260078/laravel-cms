<?php

namespace App\Providers;
use App\Models\Comment;
use App\Notifications\CommentNotify;
use App\Observers\CommentObservers;
use App\Observers\UserObserver;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        //注册一个观察者（观察USer）
        User::observe(UserObserver::class);

        Comment::observe(CommentObservers::class);

        //Carbon 中文时间
        Carbon::setLocale('zh');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        //
    }
}
