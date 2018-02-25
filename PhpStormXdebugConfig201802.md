# Xdebug2.6 with phpStorm 2017.3.4 (php: 7.1)    

## 1. prepare
[vs code tutorial](https://tighten.co/blog/configure-vscode-to-debug-phpunit-tests-with-xdebug)  

### 1.1 Install the Xdebug PHP Extension.  
````
brew install php71-xdebug 
````  

### 1.2 Find the path to your ext-xdebug.ini file by running:  
````
php --ini
````

### 1.3 Open ext-xdebug.ini to make sure the extension is loaded, and enabled.
It should look like this:
````
[xdebug]
zend_extension="/usr/local/opt/php71-xdebug/xdebug.so"
xdebug.remote_enable=1 //是否运行远程终端，必须开启
xdebug.remote_handler=dbgp
//xdebug.remote_mode=req
//xdebug.remote_host=localhost
//xdebug.remote_port=9000//这里表示服务器的监听端口 xdebug默认就是9000
xdebug.idekey="PHPSTORM";//这里是调试器的关键字 在Chrome以及FireFox中插件配置的时候要用到

````

For CLI Remote Debugging, these are all the configuration settings we need in the ext-xdebug.ini file.  

## 2. phpStorm + Xdebug Guide   

### 2.1 CLI Interpreter
![xdebug-1](https://github.com/mayusa/Tutorial-Laravel/blob/master/images/xdebug1.jpeg)  

### 2.2 Xdebug
![xdebug-2](https://github.com/mayusa/Tutorial-Laravel/blob/master/images/xdebug2.jpeg)  

### 2.3 DBGp Proxy
![xdebug-3](https://github.com/mayusa/Tutorial-Laravel/blob/master/images/xdebug3.jpeg)  

### 2.4 config ext-xdebug.ini
![xdebug-4](https://github.com/mayusa/Tutorial-Laravel/blob/master/images/xdebug4.jpeg)  

### 2.5 xdebug helper(chrome extension) configration
![xdebug-5](https://github.com/mayusa/Tutorial-Laravel/blob/master/images/xdebug5.jpeg)  
