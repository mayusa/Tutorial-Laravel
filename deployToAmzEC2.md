#Deploy laravel sites to Amazon EC2  

###() Cerate an unbuntu server instance on EC2   
aws- > EC2 -> Launch Instance - > Select Ubuntu -> Define your security group policy - > save the secret key  
###() Ssh to the server  
 

###() Configure the Ubuntu environment for hosting   
>sudo apt-get update --fix-missing  
>sudo apt-get install apache2   
>sudo add-apt-repository ppa:ondrej/php5   
>sudo apt-get update  
>sudo apt-get install php5 libapache2-mod-php5  
>php --version  
>sudo apt-get install php5-mcrypt  
>sudo apt-get install mysql-server     

###use root to make it same as asan, otherwise it will not work since there are many places hard-coded root root to be the db userID and password. Need to improve  

>sudo apt-get install git-core  
>curl -sS https://getcomposer.org/installer | php  
>mv composer.phar /usr/local/bin/composer  
>sudo mv composer.phar /usr/local/bin/composer   
>sudo git clone https://valsfer@bitbucket.org/valsfer/valsfer-test.git  
>cd valsfer-test/  
>sudo apt-get install php5-curl  
>sudo apt-get install php5-mysql  

>sudo composer update  
>vi /etc/apache2/sites-available/000-default.conf     

###() change DocumentRoot /var/www/html to whatever your location and add AllowOverride as bellow    
```
	ServerAdmin webmaster@localhost  
	DocumentRoot /var/www/valsfer-test/public
	<Directory "/var/www/valsfer-test/public">
		AllowOverride All
	</Directory>
```   

>sudo a2enmod rewrite  
>sudo service apache2 restart  

>sudo find app/storage -type d -exec chmod 777 {} \;  
>sudo find app/storage -type f -exec chmod 777 {} \;  
>sudo chmod 777 -R /var/www/valsfer-test/public/image/projects/  
>sudo chmod 777 -R /var/www/valsfer-test/public/users/image/  


###() Also need to migrate and seed the database  
>php artisan migrate  
>php artisan db:seed  

