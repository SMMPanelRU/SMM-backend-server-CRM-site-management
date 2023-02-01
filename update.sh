#!/bin/bash
git pull
php artisan migrate --force
npm i
npm run dev

