# edulog
Technical test for Edulog

# Install project:
composer install

# Update .env ( change : <login> <password> <databaseName>
LINE 32 : DATABASE_URL=mysql://<login>:<password>@127.0.0.1:3306/<databaseName>?serverVersion=5.7

# Create database
php bin/console doctrine:database:create

# Update database
php bin/console doctrine:migrations:migrate

# Fake data:
php bin/console doctrine:fixtures:load

# Launch project
php bin/console server:run
