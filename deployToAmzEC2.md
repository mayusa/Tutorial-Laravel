#Deploy laravel sites to Amazon EC2  

###(1) Cerate an unbuntu server instance on EC2   
aws- > EC2 -> Launch Instance - > Select Ubuntu -> Define your security group policy - > save the secret key  
###(2) Ssh to the server  
>ssh -i keyname.pem ubuntu@52.8.**.**

###(3-a) Configure the Ubuntu environment for hosting(apache2 + mode-php5)   
>sudo apt-get update --fix-missing  
>sudo apt-get install apache2   
>sudo add-apt-repository ppa:ondrej/php5   
>sudo apt-get update  
>sudo apt-get install php5 libapache2-mod-php5  
>php --version  
>sudo apt-get install php5-mcrypt  
>sudo apt-get install mysql-server     

###(3-b) Configure the Ubuntu environment for hosting(nginx + FastCGI)    
https://www.digitalocean.com/community/tutorials/how-to-install-laravel-with-an-nginx-web-server-on-ubuntu-14-04


###use root to make it same as asan, otherwise it will not work since there are many places hard-coded root root to be the db userID and password. Need to improve  

>sudo apt-get install git-core  
>curl -sS https://getcomposer.org/installer | php  
>sudo mv composer.phar /usr/local/bin/composer   
>sudo git clone https://sitename@bitbucket.org/sitename/sitename-test.git  
>cd sitename/  
>sudo mkdir vendor  
>sudo apt-get install php5-curl  
>sudo apt-get install php5-mysql  

>sudo composer update  
>sudo vi /etc/apache2/sites-available/000-default.conf     

###(4) change DocumentRoot /var/www/html to whatever your location and add AllowOverride as bellow    
```
	ServerAdmin webmaster@localhost  
	DocumentRoot /var/www/sitename/public
	<Directory "/var/www/sitename/public">
		AllowOverride All
	</Directory>
```   

>sudo a2enmod rewrite  
>sudo service apache2 restart  

>sudo find app/storage -type d -exec chmod 777 {} \;  
>sudo find app/storage -type f -exec chmod 777 {} \;  
>sudo chmod 777 -R /var/www/sitename/public/image/projects/  
>sudo chmod 777 -R /var/www/sitename/public/users/image/  


###(5) Also need to migrate and seed the database  
>php artisan migrate  
>php artisan db:seed  

