DYT
========================

Welcome to "DO YOU TEACH" project.
This document contains information on how to download and start using "dyt".

1) Installation
---------------

	git clone git@github.com:dyt/dyt.git dyt.local
	cd dyt.local
	chmod 777 app/cache
	chmod 777 app/logs
	chmod 777 app/config/parameters.ini
Run the vendors script:
	php bin/vendors install
And don't forget to clear your cache:
	php ./app/console cache:clear

### Apache vhost

	<VirtualHost *:80>
  	ServerName dyt.local
  	DocumentRoot "/usr/local/zend/apache2/htdocs/dyt.local/web"
  	DirectoryIndex index.php
  	<Directory "/usr/local/zend/apache2/htdocs/dyt.local/web">
    	Options +Indexes +FollowSymLinks +ExecCGI
    	DirectoryIndex index.php
    	AllowOverride All
    	Order allow,deny
    	Allow from all
  	</Directory>
	</VirtualHost>