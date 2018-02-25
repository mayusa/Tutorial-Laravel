# Laravel 网站多语言配置
- [英文文档 localization](https://laravel.com/docs/5.4/localization)
- [中文文档 本地化](http://d.laravel-china.org/docs/5.4/localization)

## 1. 定义切换语言的路由 Route:
````
Route::get('lang/{lang}', [
    'as'=>'lang.switch',
    'uses'=>'LanguageController@switchLang'
    ]);
````

## 2. 创建语言Controller
> php artisan make:controller LanguageController


````
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config, App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }
}

````


## 3.middleware

````
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        if (Session::has('applocale') AND array_key_exists(Session::get('applocale'), Config::get('languages'))) {
            App::setLocale(Session::get('applocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.fallback_locale'));
        }
        return $next($request);
    }
}
````

## 4.kernel

````
protected $middlewareGroups = [
    'web' => [
    ……
        \App\Http\Middleware\Language::class,
    ],
````

## 5. AppServiceProvider.php

````
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Session, Config, Request;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // detect Browser Locale and init lang
        if (!Session::has('applocale')) {
            $lang = substr( Request::server('HTTP_ACCEPT_LANGUAGE') ,0 , 2);
            if ($lang == "zh") {
                $lang = "cn";
            } else {
                $lang = "en";
            }
            Session::put('applocale', $lang);
        }
    }

````

### 6.config/languages.php

````
<?php

return [
    'en' => 'English',
    'cn' => '中文',
];
````

### 7.blade.php


````
{{-- language switch --}}
 @foreach (config('languages') as $lang => $language)
    @if ($lang != App::getLocale())
    <a href="{{ route('lang.switch', $lang) }}" class="nav-item is-tab is-success">{{$language}}</a>
    @endif
@endforeach
````

### 8.定义翻译语句

/resources/lang/en  …   /resources/lang/cn
Write keyed strings file: auth.php, user.php….

### 9.using languages key 使用翻译语句

  @if(Session::get('applocale') == 'cn')  OR   @if(App::getLocale() == 'cn')

Blade: @lang('blog.home')
Method:  __('messages.welcome')
