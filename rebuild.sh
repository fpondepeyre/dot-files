#!/bin/sh
set -xe

# Symlink assets
php app/console assets:install web --symlink

# Rebuild propel default
php app/console propel:database:drop --force --connection=default
php app/console propel:database:create --connection=default

# Rebuild propel models
php app/console propel:build --verbose

# Insert propel sql
php app/console propel:build-sql
php app/console propel:insert-sql --force --connection=default
php app/console propel:fixtures:load --connection=default

# Create the demo user fos
php app/console fos:user:create admin admin@demo.com admin
php app/console fos:user:promote admin ROLE_ADMIN
php app/console fos:user:change-password florian pass4florian
php app/console  fos:user:change-password laurent pass4laurent
