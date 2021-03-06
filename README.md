# Eloquent-lockable

![Packagist](https://img.shields.io/packagist/dt/envant/eloquent-lockable)
[![StyleCI](https://styleci.io/repos/216244512/shield?style=flat)](https://styleci.io/repos/216244512)
[![Build Status](https://travis-ci.org/envant/eloquent-lockable.svg?branch=master)](https://travis-ci.org/envant/eloquent-lockable)
![GitHub](https://img.shields.io/github/license/envant/eloquent-lockable)

Package for locking update and deletion actions with a specific eloquent model

## Installation

Install package through Composer

``` bash
$ composer require envant/eloquent-lockable
```

## Usage

1. Add the `Lockable` trait to your model
2. Add the `$table->lockable()` to model migration
3. Use method `$model->lockDeleting()` and `$model->unlockDeleting()` to lock and unlock deletion
3. Use method `$model->lockUpdating()` and `$model->unlockUpdating()` to lock and unlock the update

## Testing

``` bash
$ composer test
```
## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## License

license. Please see the [license file](LICENSE) for more information.
