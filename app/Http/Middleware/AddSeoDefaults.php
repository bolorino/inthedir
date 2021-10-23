<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use romanzipp\Seo\Structs\Link;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Script;

class AddSeoDefaults
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        seo()->charset();
        seo()->viewport();

        seo()->title('Home');
        seo()->description('Directorio de teatros y salas');

        // seo()->csrfToken();

        seo()->addMany([

            Meta::make()->name('copyright')->content('Jose Bolorino'),

            Meta::make()->name('mobile-web-app-capable')->content('yes'),
            Meta::make()->name('theme-color')->content('#f03a17'),

            Link::make()->rel('icon')->href('/assets/images/logos/icon-inthedir-header.png'),

            OpenGraph::make()->property('title')->content('Inthedir'),
            OpenGraph::make()->property('site_name')->content('Inthedir'),
            OpenGraph::make()->property('locale')->content('es_ES'),

            Twitter::make()->name('card')->content('summary_large_image'),
            Twitter::make()->name('site')->content('@inthedir'),
            Twitter::make()->name('creator')->content('@bolorino'),
            Twitter::make()->name('image')->content('/assets/images/logos/icon-inthedir-header.png', false)

        ]);

        seo('body')->add(
            Script::make()->attr('src', '/js/app.js')
        );

        return $next($request);
    }
}
