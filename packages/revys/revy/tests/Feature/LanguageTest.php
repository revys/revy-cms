<?php

namespace Revys\Revy\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Revys\Revy\Tests\TestCase;
use Revys\Revy\App\Http\Middleware\LanguageMiddleware;
use Illuminate\Http\Request;
use Revys\Revy\App\Language;
use Revys\Revy\App\Revy;

class LanguageTest extends TestCase
{
    use DatabaseMigrations;

    public function testLanguageIdentifying()
    {
        $middleware = new LanguageMiddleware();

        $languages = Language::all();

        foreach ($languages as $language) {
            $request = Request::create('/' . $language->code, 'GET');

            $middleware->handle($request, function () {
            });

            $this->assertEquals($request->getDefaultLocale(), $language->code);
        }

        // Default
        $request = Request::create('/', 'GET');

        $middleware->handle($request, function () {
        });

        $this->assertEquals($request->getDefaultLocale(), config('app.locale'));
    }
}