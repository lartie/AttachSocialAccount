# Attach Social Account For Laravel 5.2

[![Latest Stable Version](https://poser.pugx.org/lartie/attach-social-account/v/stable)](https://packagist.org/packages/lartie/attach-social-account)
[![Total Downloads](https://poser.pugx.org/lartie/attach-social-account/downloads)](https://packagist.org/packages/lartie/attach-social-account)
[![Latest Unstable Version](https://poser.pugx.org/lartie/attach-social-account/v/unstable)](https://packagist.org/packages/lartie/attach-social-account)
[![License](https://poser.pugx.org/lartie/attach-social-account/license)](https://packagist.org/packages/lartie/attach-social-account)
[![composer.lock](https://poser.pugx.org/lartie/attach-social-account/composerlock)](https://packagist.org/packages/lartie/attach-social-account)

- [Installation](#installation)
    - [Composer](#composer)
    - [Service Provider](#service-provider)
    - [Config File And Migrations](#config-file-and-migrations)
    - [HasSocialAccount Trait And Contract](#hassocialaccount-trait-and-contract)
- [Usage](#usage)
    - [Creating Social Network](#creating-social-network)
    - [Attach Social Account](#attach-social-account)
    - [Detach Social Account](#detach-social-account)
    - [Checking](#checking)
    - [Blade Extensions](#blade-extensions)
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
use LArtie\AttachSocialAccount\Core\Traits\HasSocialAccount;
use LArtie\AttachSocialAccount\Core\Contracts\HasSocialAccount as HasSocialAccountContract;

class User extends Authenticatable implements HasSocialAccountContract
{
    use HasSocialAccount;
```

And that's it!

## Usage

```php
 $user = User::first();
 
 $vkData = [
     'token' => 'token',
     'uid' => 'user_id',
     'nickname' => 'username',
     'name' => 'first name and last name',
     'email' => 'example@gmail.com',
     'avatar' => 'link_to',
 ];
```

### Creating Social Network
```php
$socialNetwork = SocialNetworks::create([
    'provider' => 'vkontakte', 
    'short_name' => 'vk'
]);
```

### Attach Social Account
```php
$user->attachSocialAccountById($socialNetwork->id, $vkData);
```
or
```php
$user->attachSocialAccountByShortName('vk', $vkData);
```
or
```php
$user->attachSocialAccountByProvider('vkontakte', $vkData);
```

### Detach Social Account
```php
$user->detachSocialAccountById($socialNetwork->id);
```
or
```php
$user->detachSocialAccountByShortName('vk');
```
or
```php
$user->detachSocialAccountByProvider('vkontakte');
```

### Checking

```php
$user->hasSocialAccountById($socialNetwork->id);
```
or
```php
$user->hasSocialAccountByShortName('vk');
```
or
```php
$user->hasSocialAccountByProvider('vkontakte');
```

### Blade Extensions

```php
@providerExists('vkontakte') {
// see detach button, etc..
}

@providerNotExists('vkontakte') {
// see attach button, etc.. 
}
```

> For more information visit trait `HasSocialAccount` or  contract `HasSocialAccount`

## License

This package is free software distributed under the terms of the MIT license.
