<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Prevent Error while running migrations
        Schema::defaultStringLength(191);

        /**
         * Age Validation Check
         */
        Validator::extend('olderThan', function ($attribute, $value, $parameters) {
            if (!$value) {
                return true;
            }
            $minAge = (!empty($parameters)) ? (int) $parameters[0] : 18;
            $now = Carbon::now();            
            $createDate = Carbon::createFromFormat('d/m/Y',$value);
            $diff = $createDate->diffInYears($now);
            
            return $diff >= $minAge;
        });
    }
}
