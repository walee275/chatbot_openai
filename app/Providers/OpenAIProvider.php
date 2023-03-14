<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class OpenAIProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
{
    $this->app->bind(GuzzleHttp\Client::class, function ($app) {
        return new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    });
}


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
