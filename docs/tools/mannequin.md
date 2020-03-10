Mannequin
=========
[Mannequin](https://mannequin.io) is installed at `vendor/bin/mannequin`.

Configuration
-------------
Mannequin is configured in `.mannequin.php`.  Mannequin metadata is added to theme templates as YAML comment blocks.

Accessing
---------
Mannequin is configured as a mannequin service, and can be accessed at https://mannequin.lndo.site

This is using mannequin in "server" mode, so it watches for changes and will automatically update as templates css changes

Uninstalling
------------
1. Run `composer remove --dev lastcall/mannequin-drupal`.
1. Run `git rm .mannequin.php`.
1. Remove the following sections from `.lando.yml`
   *
   ```
     proxy:
       mannequin:
         - mannequin.lndo.site
   ```
   *
   ```
   services:
     mannequin:
       type: compose
       services:
         image: devwithlando/php:7.3-apache
         command: docker-php-entrypoint /app/vendor/bin/mannequin start -c /app/.mannequin.php *:80
   ```

1. Commit changes.
