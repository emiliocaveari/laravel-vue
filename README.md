<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Projeto

Crud simples (criar, recuperar, listar e remover) em PHP, com banco de dados MySQL, utilizando uma API REST.

Front-End em VueJS 3.
Back-End Laravel 10

Servidor Docker com Laravel Sail.


## Instalação

- Download do projeto no github
- Acessar a pasta do projeto:
- Renomear o arquivo .env.example para .env
- composer install
- ./vendor/bin/sail up -d
- ./vendor/bin/sail php artisan migrate
- ./vendor/bin/sail php artisan db:seed
- ./vendor/bin/sail npm install
- ./vendor/bin/sail npm run build

Acessar http://localhost
