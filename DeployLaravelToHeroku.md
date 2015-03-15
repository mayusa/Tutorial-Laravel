## Deploy Laravel 5 to Heroku    
3/15/2015 by ashu  


大部分参考: https://mattstauffer.co/blog/installing-a-laravel-app-on-heroku

####1. 创建 heroku账号,项目初始化  

a. Create a new Git repository   
>$ heroku login  
>$ cd my-project/  
>$ git init  
>$ heroku git:remote -a projectname   

b. 在项目根目录下创建一个 index.php文件(目的是为了让heroku识别脚本语言)
```
<?php
	echo "temp~~";
?>
```  

c. Deploy your application   
>$ git add .  
>$ git commit -am "make it better"  
>$ git push heroku master  

####2. 创建laravel5包(要在其他文件夹中创建和初始化laravel)  
a. 创建laravel   
>$ laravel new laraveldemo  
>$ cd laraveldemo  
>$ composer update   


b. 将laraveldemo中所有文件复制到heroku的项目中  

####3.配置heroku项目  

a. 在根目录下创建新文件: 'Procfile' ,内容为  
```
web: vendor/bin/heroku-php-apache2 public  
```  
b. 在teminal项目根目录下执行命令   

	heroku config:set BUILDPACK_URL=https://github.com/heroku/heroku-buildpack-php   

####4.发布 Deploy~~~  
#####首先记得要删除`index.php`, 再执行下面的命令发布项目  

>$ git add --all  
>$ git commit -m "Initial commit of stock Laravel install."  
>$ git push heroku master   
  
  
---
ashucn@gmail.com