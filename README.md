# edulog
Technical test for Edulog

# Install project:
composer install

# Fake data:
php bin/console doctrine:fixtures:load

# Update .env
LINE 32 : DATABASE_URL=mysql://<login>:<password>@127.0.0.1:3306/<databaseName>?serverVersion=5.7

# Create database
php bin/console doctrine:database:create

# Update database
php bin/console doctrine:migrations:migrate

# Launch project
php bin/console server:run