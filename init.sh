#!/bin/bash

composer update

php artisan passport:install
php artisan key:generate

php artisan migrate
php artisan db:seed

php artisan optimize