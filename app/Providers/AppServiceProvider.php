<?php

namespace App\Providers;

use App\Models\Student;
use App\Observers\StudentObserver;
use App\Observers\SystemMenuObserver;
use Harimayco\Menu\Models\MenuItems;
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
        Schema::defaultStringLength(191);
        if(!\FileUploader::checkHealth()){
            die("Contact with provider");
        }
        // dd('here');
        // DB::connection('mysql2')->table()
        // dd(\URL::to('/'), str_contains(\URL::to('/'), 'localhost:9000'));
        /* if (str_contains(\URL::to('/'), '192.168.5.123:9000')) {
        // config()->set('database.default', 'mysql_test');
        // Artisan::call('config:cache');
        dd('boot 9000 here', \URL::to('/'), config()->get('database.default'), DB::connection('mysql_test')->table('wp_users')->first());
        // DB::connection('mysql_test')->getPdo();
        } else {
        dd('boot 8000 here', \URL::to('/'), User::first()->toArray());
        }*/

        MenuItems::observe(SystemMenuObserver::class);

        Student::observe(StudentObserver::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
