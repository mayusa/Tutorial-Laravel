1. 安装 
composer create-project laravel/laravel learnlaravel 4.2.11
(learnlaravel/app/storage 目录设置 777 权限)
启动服务器
$ php artisan serve

2. 必要插件安装及配置

我们使用著名的Sentry插件来构建登录等权限验证系统。

打开 ./composer.json ，变更为：
```
"require": {
	"laravel/framework": "4.2.*",
	"cartalyst/sentry": "2.1.4"
},
```
安装 
$ composer update

运行 composer update，之后在 ./app/config/app.php 中 恰当的位置 增加配置：
(laravel generator)
'Way\Generators\GeneratorsServiceProvider'

安装完成过，在命令行中运行 php artisan，就可以看到这个插件带来的许多新的功能。 

3. 数据库建立及迁移

数据库配置文件位于 ./app/config/database.php

'mysql' => array(
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'database'  => 'laravel',
	'username'  => 'root',
	'password'  => 'password',
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => 'l4_',
),
建立数据库命令
php artisan migrate --package=cartalyst/sentry
执行完成后，你的数据库里就有了5张表，这是sentry自己建立的。sentry在Laravel4下的配置详情见 https://cartalyst.com/manual/sentry#laravel-4

在 ./app/config/app.php 中 相应的位置 分别增加以下两行：

'Cartalyst\Sentry\SentryServiceProvider',

'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',

权限系统的数据库配置到此为止。 


--------
	我们的简单blog系统将会有两种元素，Article和Page，下面我们将创建articles和pages数据表，命令行运行：

php artisan migrate:make create_articles_table --create=articles
php artisan migrate:make create_pages_table --create=pages


4. 模型 Models

	我们在命令行运行下列语句以创建两个model：

>$ php artisan generate:model article
>$ php artisan generate:model page

这时候，在 app/models/ 下就出现了两个文件 Article.php 和 Page.php，这是两个 Model 类，他们都继承了Laravel提供的核心类 \Eloquent。这里需要强调一下，用命令行的方式创建文件，和自己手动创建文件没有任何区别，你也可以尝试自己创建这两个 Model 类哦。


5. 数据库填充

安装 faker包： 
修改composer.json
require: "fzaninotto/faker": "1.5.*@dev"
安装命令
>$ composer update


	分别运行下列命令：

>$ php artisan generate:seed page
>$ php artisan generate:seed article

分别更改这两个文件：

Article::create([
  'title'   => $faker->sentence($nbWords = 6),
  'slug'    => 'first-post',
  'body'    => $faker->paragraph($nbSentences = 5),
  'user_id' => 1,
]);

Page::create([
  'title'   => $faker->sentence($nbWords = 6),
  'slug'    => 'first-page',
  'body'    => $faker->paragraph($nbSentences = 5),
  'user_id' => 1,
]);

在 DatabaseSeeder.php 中增加两行，让Laravel在seed的时候会带上我们新增的这两个seed文件。

$this->call('ArticleTableSeeder');
$this->call('PageTableSeeder');

最后填充数据“
>$ php artisan db:seed


6. 视图分离与嵌套

在项目文件夹根目录下下运行命令：

php artisan generate:view admin._layouts.default




清空页面文件缓存，在 app/storage/views，清空该文件夹即可。