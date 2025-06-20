#!/usr/bin/env bash

php artisan migrate:fresh
php artisan db:seed
php artisan key:generate
