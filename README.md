![Laravel](http://www.easysitenetwork.com/wp-content/uploads/2013/02/learninglaravel.png) 

[The PHP Framework For Web Artisans](http://laravel.com/)  

-------------------
Laravel Framework 参考了Ruby on Rials， ASP.NET MVC及Sinatra语法和架构，大量使用Symfony元件。
-------------------

###1.开发环境需求
---
**1.1 PHP**(PHP>=5.4  and extensions: Mcrypt, OpenSSL,Mbstring,Tokenizer)  

- 在 PHP 5.5 之后， 有些操作系统需要手动安装 PHP JSON 扩展包。如果你是使用 Ubuntu，可以通过 apt-get install php5-json 来进行安装  

- 为了方便开发，最省事的安装扩展的方法就是，下载[xampp](https://www.apachefriends.org/download.html), 将xampp的php路径加到用户环境变量`~/.bash_profile`。这样所有所需的php扩展基本都全了。省去折腾安装扩展的烦恼~！  

**1.2 [Composer](https://getcomposer.org/)**
```
mac 安装 composer方法：  
> curl -sS https://getcomposer.org/installer | php
> mv composer.phar /usr/local/bin/composer  
Then, just run "composer" in order to run Composer instead of "php composer.phar".
```
**1.3 Web server**
**1.4 资料库 (与Client App)**
**1.5 IDE, source control**
**1.6 Web browser**

###2.建立开发环境
---
**2.1 All in one 套件( beginner )**  
**2.2 Homestead(熟悉laravel)**  
**2.3 自建开发环境 (advanced)**  
 

###[install Laravel](http://laravel.com/docs/5.0/installation)
>\> composer global require "laravel/installer=~1.1"

add ` ~/.composer/vendor/bin` directory to PATH (Linux)
(win - `C:\Users\username\AppData\Roaming\Composer\vendor\bin`)

检查laravel安装是否成功：
>\> laravel -v

###3.创建项目  
---
__3.1 Installation__  

根据你所在的目录，执行**laravel**
>\> laravel new blog  

将会在该目录下创建一个名为"blog"的 Laravel应用，包含全新安装的Laravel相关代码。
**这种创建方法优点是：不需要再通过 composer install 安装相关依赖，速度会快许多。**
##
或者 可以使用**composer**创建： 
(第一次创建项目会下载很多依赖包可能有点慢，以后建项目会从缓存中读取依赖包会比较块)  
  
>\> composer create-project laravel/laravel your-project-name dev-develop --prefer-dist  

##  
__3.2 Artisan(本义：工匠）__
> $php artisan {command}   

Laravel 专属指令工具，协助完成日常繁琐工作事务，比如：  
- 产生auto-load, 清快取，最佳化
- 产生migration, 控制queue
- 维护模式

####启动web server
> php artisan **serve**  


###Resource
---
[Laravel英文官网](http://laravel.com/)  
[Composer](https://getcomposer.org/)  
[Laravel China](http://laravel-china.org/)  
[Laravel中国社区](http://www.golaravel.com/)  
[The PHP Framework For Web Artisans](http://laravel.com/)  
[Laravel5 API](http://laravel.com/api/5.0/)  
[Composer中国镜像](http://pkg.phpcomposer.com/)  

***
ashucn@gmail.com
