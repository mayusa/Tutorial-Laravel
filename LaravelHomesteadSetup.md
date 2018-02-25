##How to setup Laravel Homestead & Using xdebug

http://laravel.com/docs/5.0/homestead   


###1. Homestead is currently built and tested using Vagrant 1.7.   
Homestead 目前是构建且测试于 Vagrant 1.7 版本。  

###2. Included Software       

- Ubuntu 14.04
- PHP 5.6
- HHVM
- Nginx
- MySQL
- Postgres
- Node (With Bower, Grunt, and Gulp)
- Redis
- Memcached
- Beanstalkd
- Laravel Envoy
- Fabric + HipChat Extension
- Blackfire Profiler  

###3. Installation & Setup  

####3.1 前提：  
需要安装[VirtualBox](https://www.virtualbox.org/wiki/Downloads)和[Vagrant](http://www.vagrantup.com/downloads.html)  


####3.2 Adding The Vagrant Box   
将 'laravel/homestead' 封装包安装进你的 Vagrant 安装程序中  
>$ vagrant box add laravel/homestead   

####3.3 安装 Homestead(两种方式)   
请务必确认 `~/.composer/vendor/bin` 已经加入环境变量PATH之中，如此一来你才能在终端机中顺利执行 `homestead` 命令。 
    
- __方法1(推荐！)：通过 Composer + PHP 工具__   
一旦封装包已经安装进你的 Vagrant 安装程序，你就可以准备通过 `Composer global` 命令来安装 `Homestead CLI` 工具：  
>$ composer global require "laravel/homestead=~2.0"  //(不要用其他高级版本，因为缺少命令 2016.8.28)      

- __方法2：手动通过 Git 安装（本地端没有 PHP）__   
如果你不希望在你的本机上安装 PHP ，你可以简单地通过手动复制资源库的方式来安装 Homestead。将资源库复制至你的 "home" 目录中的 Homestead 文件夹，如此一来 Homestead 封装包将能提供主机服务给你所有的 Laravel（及 PHP）应用:  
>$ git clone https://github.com/laravel/homestead.git Homestead   
一旦你安装完 Homestead CLI 工具，即可进入Homestead文件夹，执行 bash init.sh 命令来创建 Homestead.yaml 配置文件:   
>$ bash init.sh   

      
    一旦你安装完 `Homestead CLI` 工具，即可执行 `init` 命令来创建 `Homestead.yaml` 配置文件:  
    >$ homestead init  

    此 Homestead.yaml 将会被放置在你的 ~/.homestead 文件夹中。如果你是使用 Mac 或 Linux，你可以直接在终端机执行 `homestead edit` 命令来编辑 `Homestead.yaml` :  
    >$ homestead edit   

####3.4 Configure Your Provider 配置Provider  

可以选择 `VirtualBox` 或者 `vmware_fusion`  
```
provider: virtualbox
```   

####3.5 Set Your SSH Key 配置 SSH 密钥     
下一步需要编辑 Homestead.yaml.   
在此文件中可以配置你的 SSH 公开密钥，以及host与 Homestead 虚拟机之间的共享目录(website folder)。    

__创建一个 SSH 密钥组:(Mac/Linux)__    

>$ ssh-keygen -t rsa -C "you@homestead"   

####3.6 配置共享文件夹   
Homestead.yaml 文件中的 folders 属性列出了所有你想在 Homestead 环境共享的文件夹列表。这些文件夹中的文件若有变动，他们将会同步在你的本机与 Homestead 环境里。你可以将你需要的共享文件夹都配置进去。  

如果要开启 [NFS](http://docs.vagrantup.com/v2/synced-folders/nfs.html)，只需要在 folders 中加入一个标识：  
```
folders:
    - map: ~/Code
      to: /home/vagrant/Code
      type: "nfs"  
```  

####3.7 配置 Nginx 站点   
`sites` 属性允许你简单的对应一个 域名 到一个 `homestead`环境中的目录。一个例子的站点被配置在 `Homestead.yaml` 文件中。同样的，你可以加任何你需要的站点到你的 `Homestead` 环境中。`Homestead` 可以为你每个进行中的 `Laravel` 应用提供方便的虚拟化环境。

你可以通过配置 `hhvm` 属性为 `true` 来让虚拟站点支持 `HHVM`:（如果不明确HHVM请不要加，否则访问网站会报520错误）

```
sites:
    - map: homestead.app
      to: /home/vagrant/Code/Laravel/public
      hhvm: true
```  

####3.8 Bash Aliases  

如果要增加 Bash aliases 到你的 Homestead 封装包中，只要将内容添加到 ~/.homestead 目录最上层的 aliases 文件中即可。  
例如, 添加一条vm连接命令： 
```
alias vm="ssh vagrant@127.0.0.1 -p 2222"
```

####3.9 启动 Vagrant 封装包
编辑完 Homestead.yaml 配置后，在终端机里进入你的 Homestead 文件夹并执行 homestead up 命令  

>$ homestead up  

Vagrant 会将虚拟机开机，并且自动配置你的共享目录和 `Nginx `站点。如果要移除虚拟机，可以使用 `vagrant destroy --force` 命令。  
>$ vagrant destroy --force  

__注意：__ 要在本机的host中添加homestead中的「域名」，hosts 文件会将你的本地域名的站点请求指向你的 Homestead 环境中  

编辑hosts文件：  

>$ subl /etc/hosts   

添加一行：  
```
192.168.10.10  homestead.app
```   
__务必确认 IP 地址与你的 Homestead.yaml 文件中的相同。一旦你将域名加进你的 hosts 文件中，你就可以通过网页浏览器访问到你的站点。__

```
http://homestead.app
```


###4. Daily Usage 常用操作    

####4.1 通过 SSH 连接Homestead 环境  
__添加ssh连接命令别名到环境变量：__   

编辑~/.bash_profiel  
```
subl ~/.basn_profile
```
添加一行(ssh连接命令别名)
```
alias vm="ssh vagrant@127.0.0.1 -p 2222"
```
之后你就可以执行  `vm`  命令来通过 SSH 进入 Homestead 虚拟机。  

####4.2 连接数据库  
在 `Homestead` 封装包中， `Laravel` 的 `local` 数据库配置已经默认将其配置完成   

从本机上通过 `Navicat` 或者 `Sequel Pro`   

- 连接 `MySQL` : `127.0.0.1` 的端口 `33060`       
- 连接`Postgres` : `127.0.0.1` 的端口 `54320`    
- DB帐号密码:  `homestead / secret`      

**注意：** 在 Laravel 的数据库配置文件中依然是配置使用默认的 3306 及 5432 连接端口


####4.3 增加更多的站点    
可以在单一 Homestead 环境中运行多个 Laravel 安装程序    

 - 方法1: 在 `Homestead.yaml` 文件中增加站点然后执行 `homestead provision` 或者 `vagrant provision`   
 - 方法2: 使用存放在 Homestead 环境中的 `serve` 命令文件。要使用 `serve` 命令文件，请先 SSH 进入 Homestead 环境中，并执行下列命令：  
  >$ serve domain.app /home/vagrant/Code/path/to/public/directory


###5. 连接端口    

以下的端口将会被转发至 Homestead 环境：   

- SSH: 2222 → Forwards To 22
- HTTP: 8000 → Forwards To 80
- MySQL: 33060 → Forwards To 3306
- Postgres: 54320 → Forwards To 5432  

####增加额外端口

你也可以自定义转发额外的端口至 `Vagrant box`，只需要在 `homestead.yaml` 指定协议：    
```
ports:
    - send: 93000
      to: 9300
    - send: 7777
      to: 777
      protocol: udp
```


###6. Blackfire Profiler    

`Blackfire Profiler` 是由 `SensioLabs` 创建的一个分析工具，它会自动的收集代码执行期间的相关数据，比如 RAM, CPU time, 和 disk I/O. 如果你使用 Homestead ，那么使用这个分析工具会变得非常简单。

`blackfire` 所需的包已经安装在 `Homestead box` 中，你只需要在 `Homestead.yaml` 文件中设置 `Server ID` 和 `token` ：

```
blackfire:
    - id: your-id
      token: your-token
```  

###7. phpstorm + vagrant + xdebug
http://www.sitepoint.com/install-xdebug-phpstorm-vagrant/  
我的配置：  
xdebug端口设为 9000  
homestead app网页端口设为默认的 80，而不是8000  

###8. window10 + homestead    
[windows10-vagrant-virtualbox-homestead](https://laracasts.com/discuss/channels/general-discussion/windows-10-vagrant-virtualbox-homestead)    

---
ashucn@gmail.com 3/17/2015  
