<?php


namespace Metif12\LaravelFarsi;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class LaravelFarsiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConfig();
    }

    public function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/configs/laravel-farsi.php', 'laravel-farsi');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/configs/laravel-farsi.php' => config_path('laravel-farsi.php'),
            ], 'laravel-farsi-configs');
        }
    }

    public function boot()
    {
        $this->bootRequestMacros();

        $this->bootValidatorExtends();
    }

    protected function bootRequestMacros(): void
    {
        Request::macro('farsi', function ($name, $default = null) {
            return farsi((string)$this->input($name, $default));
        });

        Request::macro('oldFarsi', function ($name, $default = null) {
            return farsi((string)$this->old($name, $default));
        });

        Request::macro('queryFarsi', function ($name, $default = null) {
            return farsi((string)$this->query($name, $default));
        });

        Request::macro('postFarsi', function ($name, $default = null) {
            return farsi((string)$this->post($name, $default));
        });
    }

    protected function bootValidatorExtends(): void
    {
        Validator::extend('farsi_letters', function ($attribute, $value, $parameters, $validator) {
            return (bool)preg_match("/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u", $value);
        });

        Validator::extend('farsi_numbers', function ($attribute, $value, $parameters, $validator) {
            return (bool)preg_match('/^[\x{6F0}-\x{6F9}]+$/u', $value);
        });

        Validator::extend('farsi', function ($attribute, $value, $parameters, $validator) {
            return (bool)preg_match('/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u', $value);
        });

        Validator::extend('not_farsi', function ($attribute, $value, $parameters, $validator) {
            return (bool)preg_match("/[\x{600}-\x{6FF}]/u", $value);
        });
    }
}
