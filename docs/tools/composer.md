Composer
========

We recommend using [Composer]() to manage all third party PHP code dependencies, include contributed Drupal modules and themes.

Installing a new Module/Theme/Library
-------------------------------------
Use `composer require` to install new packages. Example:

```bash
# Install the ctools module. This will fail if ctools requires an update to one of your existing dependencies.
composer require drupal/ctools

# Install the ctools module and update any dependencies ctools has.
composer require drupal/ctools --update-with-dependencies
```

### Installation troubleshooting

@todo

Updating Packages
-----------------
Use `composer update` to update existing packages.  Packages will be updated according to the version constraints set in `composer.json`, and considering the version constraints of any other installed packages. It is best practice when updating packages to update one package at a time (with all of it's dependencies). Example:

```bash
# Update Drupal core only.
composer update drupal/core

# Update Drupal core and all of the things it depends on.
composer update drupal/core --with-dependencies
```
