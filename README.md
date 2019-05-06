# Savanyu-SPA
Don't mind this repository.

## Setup

```bash
composer update
php artisan key:generate
php artisan jwt:secret
npm install
touch database/savanyu.db
php artisan migrate
php artisan db:seed
php artisan storage:link
```

## Run

```bash
php artisan serve
npm run watch
```

## Update

```bash
composer dump-autoload # If some errors occure.
```

## Set in production

Set `APP_ENV` to "production" in `.env` then run

```bash
npm run prod
```
