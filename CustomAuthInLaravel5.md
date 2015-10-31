##[How-create-a-custom-auth-in-laravel-5](http://laravel.io/forum/11-04-2014-laravel-5-how-do-i-create-a-custom-auth-in-laravel-5) 
####1 - Update the driver key inside config/auth.php like this:  
````
     'driver' => 'custom',   
````  
  
####2 - Create a folder: /app/Auth, create the User Provider Interface implementation. I will name the file as CustomUserProvider.php:  
  
````
<?php 

namespace App\Auth;

use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Auth\UserProviderInterface;

class CustomUserProvider implements UserProviderInterface {

    protected $model;

    public function __construct(UserContract $model)
    {
        $this->model = $model;
    }

    public function retrieveById($identifier)
    {

    }

    public function retrieveByToken($identifier, $token)
    {

    }

    public function updateRememberToken(UserContract $user, $token)
    {

    }

    public function retrieveByCredentials(array $credentials)
    {

    }

    public function validateCredentials(UserContract $user, array $credentials)
    {

    }

}
````  
  
Now implement the UserProviderInterface methods however you want.

####3 - Create a new Service Provider inside your app/Providers directory and name it according to the convention you are using. I will call it `CustomAuthProvider'.php. Now, in this file we will register the new auth drivers that we have specified inside the config file:  
````  
<?php 

namespace App\Providers;

use App\User;
use App\Auth\CustomUserProvider;
use Illuminate\Support\ServiceProvider;

class CustomAuthProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->extend('custom',function()
        {
            return new CustomUserProvider(new User);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
````  
  
Now in the last step add the name of the provider into the providers array of the config/app.php file.  
````
'providers' => [
    /*
     * Application Service Providers...
     */

    // custom Auth provider
    App\Providers\CustomAuthProvider::class,
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    ....



````


