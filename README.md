# Laravel-reactable

![GitHub Release](https://img.shields.io/github/v/release/yuges-code/laravel-reactable)
![Packagist Downloads](https://img.shields.io/packagist/dt/yuges-code/laravel-reactable)
![GitHub License](https://img.shields.io/github/license/yuges-code/laravel-reactable)
![Packagist Stars](https://img.shields.io/packagist/stars/yuges-code/laravel-reactable)

Package for easily attaching reactions to Laravel eloquent models

## Installation

### Preparing the database
You need to publish the migration to create the reactions table:

```
php artisan vendor:publish --provider="Yuges\Reactable\Providers\ReactableServiceProvider" --tag="reactable-migrations"
```

After that, you need to run migrations.

```
php artisan migrate
```

### Publishing the config file
Publishing the config file (`config/reactable.php`) is optional:

```
php artisan vendor:publish --provider="Yuges\Reactable\Providers\ReactableServiceProvider" --tag="reactable-config"
```

