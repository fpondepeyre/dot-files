DYT
========================

Welcome to "DO YOU TEACH" project.

This document contains information on how to download and start using "dyt".

1) Installation
---------------

    git clone git@bitbucket.org:dyt/dyt.git dyt.local
    cd dyt.local
    chmod -R 777 app/cache app/logs

Copy parameters.ini-dist and configure it:

    cp app/config/parameters.ini-dist app/config/parameters.ini
    chmod 777 app/config/parameters.ini

Run the vendors script:

    php bin/vendors install

And don't forget to clear your cache:

    php ./app/console cache:clear

Create database and tables

    php app/console propel:database:create
    php app/console propel:build-sql
    php app/console propel:insert-sql

Build model

   php app/console propel:build-model

Load fixtures

    ./app/console propel:fixtures:load

Copy phpunit.xml.dist for launch test
    
    cp app/phpunit.xml.dist app/phpunit.xml
    phpunit -c app/

### Apache vhost

    <VirtualHost *:80>
        ServerName dyt.local
        DocumentRoot "/usr/local/zend/apache2/htdocs/dyt.local/web"
        <Directory "/usr/local/zend/apache2/htdocs/dyt.local/web">
            DirectoryIndex app.php
            Options -Indexes FollowSymLinks SymLinksifOwnerMatch
            AllowOverride All
            Allow from all
        </Directory>
    </VirtualHost>
