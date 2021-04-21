#!/bin/bash

composer update

php artisan migrate

php artisan key:generate
php artisan passport:install

php artisan migrate
php artisan db:seed

php artisan optimize