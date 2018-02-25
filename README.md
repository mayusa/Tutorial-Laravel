![Laravel](http://www.easysitenetwork.com/wp-content/uploads/2013/02/learninglaravel.png) 

[The PHP Framework For Web Artisans](http://laravel.com/)   
##### 建议使用Homestead方式安装laravel环境~~~ (3/16/2015)   

  

-------------------
Laravel Framework 参考了Ruby on Rails， ASP.NET MVC及Sinatra语法和架构，大量使用Symfony元件。
-------------------

目录：  
1.开发环境需求  
2.[建立开发环境](https://github.com/mayusa/laravel#2%E5%BB%BA%E7%AB%8B%E5%BC%80%E5%8F%91%E7%8E%AF%E5%A2%83)  
3.[创建和管理项目](https://github.com/mayusa/laravel#3%E5%88%9B%E5%BB%BA%E5%92%8C%E7%AE%A1%E7%90%86%E9%A1%B9%E7%9B%AE)  
[Resource](https://github.com/mayusa/laravel#resource) 




### 1.开发环境需求
---
**1.1 PHP**(PHP>=5.4  and extensions: Mcrypt, OpenSSL,Mbstring,Tokenizer)  

- 在 PHP 5.5 之后， 有些操作系统需要手动安装 PHP JSON 扩展包。如果你是使用 Ubuntu，可以通过 apt-get install php5-json 来进行安装  

- 为了方便开发，最省事的安装扩展的方法就是，下载[xampp](https://www.apachefriends.org/download.html), 将xampp的php路径加到用户环境变量`~/.bash_profile`。这样所有所需的php扩展基本都全了。省去折腾安装扩展的烦恼~！  

**1.2 [Composer](https://getcomposer.org/)**  

  - __mac 安装 composer方法：__  

        $ curl -sS https://getcomposer.org/installer | php
        $ mv composer.phar /usr/local/bin/composer    
 
    - Then, just run "composer" in order to run Composer instead of "php composer.phar".    

    将依赖包路径加入环境变量$PATH:    

    编辑~/.bash_profiel    

        
        subl ~/.basn_profile
        

    添加一行  

        
        export PATH=~/.composer/vendor/bin:$PATH
        


  - __composer 安装依赖步骤：__   


    - 在composer.json添加依赖名称
`require": { "monolog/monolog": "1.2.*" }`
    - 在项目根目录执行teminal命令： `$ composer update`
    - 注意： composer安装依赖过程中，可能会报错：`SSL3_GET_SERVER_CERTIFICATE:certificate verify failed`
[PHP 5.6 SSL certificate verification 问题解决](http://www.tuicool.com/articles/YnqMviE)  

**1.3 Web server**  
**1.4 资料库 (与Client App)**  
**1.5 IDE, source control**  
**1.6 Web browser**  

### 2.建立开发环境
---
  
推荐使用的IDE： [PhpStorm - 如何配置](https://confluence.jetbrains.com/display/PhpStorm/Laravel+Development+using+PhpStorm#LaravelDevelopmentusingPhpStorm-Prerequisites%28plugininstallationandconfiguration%29)

**2.1 All in one 套件( beginner )**  
**2.2 Homestead(熟悉laravel)**  
**2.3 自建开发环境 (advanced)**  
 

### [install Laravel](http://laravel.com/docs/5.0/installation)
> $composer global require "laravel/installer=~1.1"

add ` ~/.composer/vendor/bin` directory to PATH (Linux)
(win - `C:\Users\username\AppData\Roaming\Composer\vendor\bin`)

检查laravel安装是否成功：
> $ laravel -v

### 3.创建和管理项目  
---
#### 3.1 Installation  

根据你所在的目录，执行**laravel**
> $ laravel new blog  

将会在该目录下创建一个名为"blog"的 Laravel应用，包含全新安装的Laravel相关代码。
**这种创建方法优点是：不需要再通过 composer install 安装相关依赖，速度会快许多。**
##
或者 可以使用**composer**创建： 
(第一次创建项目会下载很多依赖包可能有点慢，以后建项目会从缓存中读取依赖包会比较块)  
  
>$ composer create-project laravel/laravel your-project-name dev-develop --prefer-dist  

##  
#### 3.2 Artisan(本义：工匠)
> $ php artisan {command}   

Laravel 专属指令工具，协助完成日常繁琐工作事务，比如：  
- 产生auto-load, 清快取，最佳化
- 产生migration, 控制queue
- 维护模式

##### 启动web server  

> $ php artisan **serve**    

##### 关闭web server  

> $ Ctrl + c   

##### 启动 application  

> $ php artisan up
> Application is now live.  

##### 暂停 application(首页显示: 'Be right back.')
> $ php artisan down
Application is now in maintenance mode.    

##### 生成key
> $ php artisan key:generate
Application key [5ed1UVo4*************RlNjBWFo] set successfully.    

##### 修改app名称

> php artisan app:name yourAppName
Application namespace set!  

  执行完这个命令之后, app/ 目录下的所有类都被归入 "yourAppName" 命名空间下. composer.json 文件里的 PSR-4 自动加载语句会自动更新, Laravel 也清楚应该在哪里去寻找该命名空间下的 filters, controlers 等
#### 3.3 Configuration 配置Laravel  

##### - `/app/comfig/{config}.php` :  

  - **app.php** (debug mode, service provider...)
  - **database.php** (mysql...)
  - **mail.php** (gmail, mailgun...)
  - **queue.php** (beanstalkd...)  

##### - 服务器的root指向`/public`  

##### - 开发流程： 代码统一由`github`来控制,不管是在本地还是取出远程代码，复制`/config`下所有文件即可完成对laravel配置   

##### - Laravel自动监测环境： `/bootstrap/start.php`  

##### - Laravel环境配置：   

Laravel 通过 [DotEnv](https://github.com/vlucas/phpdotenv) Vance Lucas 写的一个 PHP 类库。 在全新安装好的 Laravel 里，你的应用程序的根目录下会包含一个 `.env.example` 文件。如果你通过 Composer 安装 Laravel，这个文件将自动被命名为 `.env`，不然你应该手动更改文件名。  
**注意：** `.env` 文件不应该被提交到应用程序的版本控制系统，因为每个开发人员或服务器使用你的应用程序可能需要不同的环境配置。  
  
- 检查环境变量
> $ php artisan env
Current application environment: local  

- 检查主机名称
> $ hostanem
yourmacname.local  

- 数据库配置
Laravel 5 把数据库配置的地方改到了 `/.env`，打开这个文件，编辑下面四项，修改为正确的信息：
```
DB_HOST=localhost  
DB_DATABASE=laravel5  
DB_USERNAME=root  
DB_PASSWORD=password 
```

#### 3.4 Migration (适合多人开发的数据库管理) 
Represent database schema changes in code
目录： /database/migrations/***_table.php
`public function up()`
>$ php artisan migrate
Migrated: 2014_10_12_000000_create_users_table
Migrated: 2014_10_12_100000_create_password_resets_table  

`public function down()`
> $ php artisan migrate:rollback  
Rolled back: 2014_10_12_100000_create_password_resets_table
Rolled back: 2014_10_12_000000_create_users_table  

##### create table  
(Laravel4模式，Laravel5由model部分来自动创建：'php artisan make:model Modelname'来创建)
> $ php artisan make:migration create_users_table
Created Migration: 2015_03_11_185858_create_users_table    
 
#### 3.5 Model (Laravel最为强大的部分，Eloquent ORM)   
```
- Laravel 里操作DB的ORM 是Eloquent
- 一个Resource 对应DB里的一个table
- 一个Model对应table里的一个row
- Model是单数，Table是复数
- 从Eloquent取出来的是 _Collection_   
```
Laravel 4 时代，我们使用 Generator 插件来新建 Model。现在，Laravel 5 已经把 Generator 集成进了 Artisan。  
  
- __创建model__
> $ php artisan make:model Article  
Model created successfully.
Created Migration: 2015_03_11_201816_create_articles_table

    - 现在，Artisan 帮我们在 learnlaravel5/app/ 下创建了Article.php ，这是一个 Model 类，继承了 Laravel Eloquent 提供的 Model 类 Illuminate\Database\Eloquent\Model，且在 \App 命名空间下。  
    - 这里需要强调一下，用命令行的方式创建文件，和 __自己手动创建文件__ 没有任何区别，你也可以尝试自己创建这个 Model 类

   
- __数据库迁移__ 
接下来进行 `Article类`对应的 `articles表` 的数据库迁移，进入 `/databases/migrations` 文件夹。 在*_create_articles_table.php中修改：
```
public function up()
{
    Schema::create('articles', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('title');
        $table->string('slug')->nullable();
        $table->text('body')->nullable();
        $table->string('image')->nullable();
        $table->integer('user_id');
        $table->timestamps();
    });
}
```
然后，执行命令
> $ php artisan migrate  
Migrated: 2015_03_11_201816_create_articles_table  

    - 成功后，articles表已经出现在了数据库中。

#### 3.6 Seeder   
- 数据库填充文件seed路径： /database/seeds/{seeder}.php
    - __在开发时，需要使用mock数据进行测试__
    - __通过Laravel的table seeder,可以快速将mock资料加入DB， 方便开发测试CRUD功能__

- /databases/seeds/ 下新建 ArticleTableSeeder.php 文件，内容如下：  

        <?php
        use Illuminate\Database\Seeder;  
        use App\Article;

        class PageTableSeeder extends Seeder {

          public function run()
          {
            // 每次添加mock数据不要累加
            DB::table('articles')->truncate();
            // 不要使用delete(), id 会累加
            //DB::table('articles')->delete();

            foreach (range(1, 10) as $i => $value) {
              Article::create([
                'title'   => 'Title '.$i,
                'slug'    => 'first-page',
                'body'    => 'Body '.$i,
                'user_id' => 2,
              ]);
            }
          }
        }

- 然后修改同一级目录下的 DatabaseSeeder.php中：   

        $this->call('ArticleTableSeeder');   

- 数据填充方法1： 运行命令：   

     >$ composer dump-autoload  
     Generating autoload files
     >$ php artisan db:seed 
     >Seeded: ArticleTableSeeder  


    - 10条数据将保存在数据库中  

- 数据填充方法2：使用[Facker](https://packagist.org/packages/fzaninotto/faker )填充随机数据生成器(安装facker方法参考前面1.2)
修改ArticleTableSeeder.php  

        <?php

        use Illuminate\Database\Seeder;  
        use May\Article;
        use Faker\Factory as Faker; // 添加1

        class ArticleTableSeeder extends Seeder {

          public function run()
          {
            DB::table('articles')->truncate();

            $faker = Faker::create();// 添加2

            foreach (range(1, 10) as $i => $value) {
              Article::create([
                'title'   => **$faker->sentence($nbWords = 6),// 修改1
                'slug'    => 'first-post',
                'body'    => **$faker->paragraph($nbSentences = 5),// 修改2
                'user_id' => 1,
              ]);
            }
          }
        }  

    - 再运行命令进行数据填充：
     >$ composer dump-autoload  
     Generating autoload files
     >$ php artisan db:seed 
     >Seeded: ArticleTableSeeder

    - 10条随机mock数据将保存在数据库中  


#### 3.7 Route  
/app/Http/routes.php



#### 3.8 View  
/resources/views/{view}.blade.php  



#### 3.9 Controller  
 - 路径：/app/Http/Controllers/{controller}.php  
```
优点：  
  -  将复杂的操作逻辑，从Route分流到Controllers以Class的方式进行分类，方便维护   
  -  Controller本身即IoC Container(反转控制),可自动DI(依赖注入) 
```  

  - 生成Controller方法：  
> $php artisan make:controller Admin/AdminHomeController  

    得到 `/app/Http/Controllers/Admin/AdminHomeController.php` 文件。

##### [ 代码范例 ]  

 - 修改route (/app/Http/routes.php)  
```
// 创建一个路由组。
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function()
{
  Route::get('/', 'AdminHomeController@index');
});
```  

 - 编辑controller (/app/Http/Controllers/HomeController.php)  
```
..
```
  


#### 3.10 Package

	- 概念同Symfony的Bundle, Rails的Gem, Node的npm
	- Laravel的扩充，通过package可以直接使用现成的功能，加快开发速度
	- package搜索: Laravel Packages Registry; Packalyst  
  
##### 安装使用步骤：
 - Readme
 - 调整 composer.json/composer update
 - 设定ServiceProvider / Alias
 - Publish设定(视需求)
 - Migrate DB (视需求)  




(not finished..待续)  
  

    
### Resource
---
[Laravel英文官网](http://laravel.com/)  
[Composer](https://getcomposer.org/)  
[Laravel China](http://laravel-china.org/)  
[Laravel中国社区](http://www.golaravel.com/)  
[The PHP Framework For Web Artisans](http://laravel.com/)  
[Laravel5 API](http://laravel.com/api/5.0/)  
[Composer中国镜像](http://pkg.phpcomposer.com/)  
[Laravel5系列入门教程](http://www.golaravel.com/post/laravel-5-getting-started-part-1/)  
[Laravel 4.x & 5.x中文离线文档](http://www.golaravel.com/post/laravel-documents-offline-package/)   
[深入理解Laravel Eloquent](http://lvwenhan.com/laravel/421.html)   
[PHP 5.6 SSL certificate verification 问题解决](http://www.tuicool.com/articles/YnqMviE)  
[离线文档工具 devdocs.io](http://devdocs.io/offline)  
[离线文档工具 dash](http://kapeli.com/dash)  
[laracasts 教学视频](https://laracasts.com/)  
[tut+ 教学视频](http://tutsplus.com)   
[Laravel dojo-台湾](http://www.laravel-dojo.com/)  
[Laravel 5 视频教学 laravel from scratch](https://www.youtube.com/watch?v=y_Prz9s7mE0&index=11&list=PLEJNIa_URo5UJeUq6wUEPmPzbgRUd_ZcE)

***
ashucn@gmail.com
