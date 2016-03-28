# Table Flip for PHP
## (╯°□°）╯︵ ┻━┻)

A simple and stupid Exception/error handler for [PHP](http://php.net) and [WordPress](http://wordpress.org).

# Requirements

* PHP 5, PHP 7 for exceptions
* PHP 4 >= 4.01, PHP 5, PHP 7 for error handling
* WordPress 4.x probably, if you want it in WordPress
* **NB** This does not *require* WordPress, it just happens to have support for it.

# How to Use

Include the main flip file in `lib/` and then either create the instance with `$autobind = true`,
or bind the functions `flip_error` and `flip_exception` yourself.

```php
<?php
// Require the library
require_once( 'vendor/php-tableflip/lib/flip.php' );

// Automatically bind flips.
phatsk\PHP_TableFlip::get_instance( true );

// Bind the error handler yourself.
set_error_handler( array( 'phatsk\PHP_TableFlip', 'flip_error' ) );

// You can also flip and fix tables yourself (as of 0.1.1)
echo phatsk\PHP_TableFlip::manual_flip(); // (╯°□°）╯︵ ┻━┻
echo phatsk\PHP_TableFlip::manual_flip( 'fix' ); // ┬─┬ノ(ಠ_ಠノ)
echo phatsk\PHP_TableFlip::manual_flip( 'emotional' ); // (ノಠ益ಠ)ノ彡┻━┻

// Or just use the damn constants.
echo phatsk\PHP_TableFlip::FIX; // // ┬─┬ノ(ಠ_ಠノ)
```

### WordPress Instructions

* Clone or download the repo
* Stick the folder in your `wp-content/plugins` folder.
* Activate it in your admin plugins screen under "PHP TableFlip for WordPress"

# Why?

I was actually inspired by [this little ruby gem](https://github.com/iridakos/table_flipper). Otherwise, because why
not?

# Support

* Open an issue or
* Fork it
* Fix it
* Submit a PR

# Versions

## 0.1.4

* WordPress shortcode support is here!
* `[tableflip]` for the standard flipper.
* `[tableflip type="flip|fix|emotional]` same as calling `manual_flip`

## 0.1.3

* Added initial WordPress support

## 0.1.2

* Fix testing code that got checked in.

## 0.1.1

* Add a fix table
* Add an emotional flip
* Add a largely useless helper function, `manual_flip`

## 0.1

* Initial build.

# Roadmap

## 0.2

* Include a plugin file that will turn this into a WordPress plugin.

## 0.3

* Add hooks to put this in various WP places (configurable)
