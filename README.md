
# Laravel Multi Tenancy Multi Database

### step by step
Create file .env
```sh
cd example-project/
cp .env.example .env
```


Update file environment variables .env
```dosini
APP_NAME=NameApp
APP_URL=http://localhost:8180

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Up project containers
```sh
docker-compose up -d
```


Access the container
```sh
docker-compose exec app-laravel-multi-tenancy bash
```


Install project dependencies
```sh
composer install
```


Generate the project key
```sh
php artisan key:generate
```


Access the project
[http://localhost:8180](http://localhost:8180)
