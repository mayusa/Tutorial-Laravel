01  apt-get update  
02  apt-get install -y software-properties-common  
03  sudo apt-get install python-software-properties  
04  sudo LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php  
05  sudo apt-get update  
06  sudo apt-get purge php5-common -y  
07  sudo apt-get install php7.1 -y  
08  apt-get -y install php7.1-mysql  
09  php -v  
10  apt-get -y install php7.1-fpm php7.1-curl php7.1-xml php7.1-mcrypt php7.1-json php7.1-gd php7.1-mbstring mysql-server
11  php -v  
12  apt-get -y install nginx  
13  curl localhost   
14  apt-get update  
15  apt-get install git  
16  curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
17  composer  
18  nano /etc/php/7.1/fpm/php.ini   #搜索 / ->  cgi.fix_pathinfo=0  
19  nano /etc/php/7.1/fpm/pool.d/www.conf    #搜索 / ->  listen = /var/run/php7.1-fpm.sock  
20  sudo git clone yourapp  
21  nano /etc/nginx/sites-available/default   
22  cd /var/www/yourapp  
23  sudo composer update  
  
### To get a list of packages installed locally do this in your terminal:  
dpkg --get-selections | grep -v deinstall  

### To get a list of a specific package installed:  
dpkg --get-selections | grep postgres  
