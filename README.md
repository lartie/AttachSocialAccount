# Attach Social Account For Laravel 5.2

- [Installation](#installation)
    - [Composer](#composer)
    - [Service Provider](#service-provider)
    - [Config File And Migrations](#config-file-and-migrations)
    - [HasSocialAccount Trait And Contract](#hassocialaccount-trait-and-contract)
- [License](#license)

## Installation

### Composer
    composer require lartie/attach-social-account

### Service Provider

Add the package to your application service providers in `config/app.php` file.

```php
'providers' => [
    
    /*
     * Application Service Providers..
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    ...
    
    /*
     * Extensions
     */
    LArtie\AttachSocialAccount\ServiceProvider::class,

],
```

### Config File And Migrations

Publish the package config file and migrations to your application. Run these commands inside your terminal.

    php artisan vendor:publish

And also run migrations.

    php artisan migrate

> This uses the default users table which is in Laravel. You should already have the migration file for the users table available and migrated.

### HasSocialAccount Trait And Contract

Include `HasSocialAccount` trait and also implement `HasSocialAccount` contract inside your `User` model.

```php
use LArtie\AttachSocialAccount\Traits\HasSocialAccount;
use LArtie\AttachSocialAccount\Contracts\HasSocialAccount as HasSocialAccountContract;

class User extends Authenticatable implements HasSocialAccountContract
{
    use HasSocialAccount;
```

And that's it!

## License

This package is free software distributed under the terms of the MIT license.
