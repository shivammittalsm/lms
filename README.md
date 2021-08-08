# Learning Management System-LMS (Laravel 8 Application)
### Prerequisites
-   php v7.4, [see](https://laravel.com/docs/installation) Laravel specific requirements
-   Apache v2.4.41 with `mod_rewrite`
-   [Composer](https://getcomposer.org) v2.0
-   [node-js](https://github.com/creationix/nvm) >=15.5.0

### Quick setup 
* Clone this repo, checkout to ```dev``` branch
* Install dependencies
```
composer install
```
composer require ankurk91/laravel-alert
```
* Write permissions on ```storage``` and ```bootstrap/cache``` folders
* Create config (copy from ```.env.example```), and update environment variables in ```.env``` file
```
cp .env.example .env
php artisan key:generate
```
* Migrate and Seed database
```
php artisan migrate
php artisan db:seed
```
* Create the symbolic link for local file uploads
```
php artisan storage:link
```
use php artisan passport:client to generate a client

```
* Point your web server to **public** folder of this project
* Additionally you can run this command on production server
```
php artisan optimize
```


