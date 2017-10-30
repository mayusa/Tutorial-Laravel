## How to Install Laravel with an Nginx Web Server on Ubuntu 14.04   

### 1. Install the Backend Components  安装服务器后端组件
````  
sudo apt-get update    
sudo apt-get install nginx php5-fpm php5-cli php5-mcrypt php5-curl git  mysql-server php5-mysql
````  

### 2. Modify the PHP Configuration  
#### cgi.fix_pathinfo
    sudo nano /etc/php5/fpm/php.ini  
    
Search for the cgi.fix_pathinfo parameter，set it to "0":   
````   
cgi.fix_pathinfo=0  
````
This tells PHP not to try to execute a similar named script if the requested file name cannot be found. This is very important because allowing this type of behavior could allow an attacker to craft a specially designed request to try to trick PHP into executing code that it should not.  

#### Enable the MCrypt extension, which Laravel depends on  
    sudo php5enmod mcrypt  
  
#### Restart the php5-fpm service, implement the PHP config changes:  (可以安装PHP7,need update the MD file 2016.9.22)
    sudo service php5-fpm restart  


### 3. Configure Nginx and the Web Root  
#### Define www root folder:
    sudo mkdir -p /var/www/yourapp  
#### Open the default server block configuration file    
    sudo nano /etc/nginx/sites-available/default  
  
#### Modified the default server block file as blow  
````
server {
    listen 80 default_server;
    listen [::]:80 default_server ipv6only=on;

    root /var/www/yourapp/public;
    index index.php index.html index.htm;

    server_name server_domain_or_IP;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
````  
#### Restart Nginx for our configuration changes   
    sudo service nginx restart  

### 4. Install Composer  
````  
cd ~
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
````  

### 5. Config Laravel  
Change the permissions of the /var/www/yourapp/storage directory to allow the web group write permissions. This is necessary for the application to function correctly:  

    sudo chmod -R 775 /var/www/yourapp/storage   
    sudo find storage -type d -exec chmod 777 {} \;  
    sudo find storage -type f -exec chmod 777 {} \;  


