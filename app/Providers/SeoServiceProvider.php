<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use romanzipp\Seo\Builders\StructBuilder;
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Services\SeoService;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Title;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        StructBuilder::$indent = str_repeat(' ', 4);

        // Add a getTitle method for obtaining the unmodified title

        Seo::macro('getTitle', function () {
            /** @var SeoService $this */

            if ( ! $title = $this->getStruct(Title::class)) {
                return null;
            }

            if ( ! $body = $title->getBody()) {
                return null;
            }

            return $body->getOriginalData();
        });

        // Create a custom macro

        Seo::macro('customTag', function (string $value) {
            /** @var SeoService $this */

            return $this->add(
                Meta::make()->name('custom')->content($value)
            );
        });

        // Add a hook to ensure the site name is always appended to the title

        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {
                    return ($body ? $body . ' | ' : '') . 'Site-Name';
                })
        );
    }
}
