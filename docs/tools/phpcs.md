PHPCS
=====

Configuration
-------------
PHPCS is configured using the `phpcs.xml.dist` file in the repository root.

Running
-------
* `vendor/bin/phpcs` will lint all files that are set up for linting in the phpcs.xml.dist.
* `vendor/bin/phpcs my/file.php` will lint one file.

Uninstalling
------------
1. Run `git rm phpcs.xml.dist`
2. Edit `composer.json` to remove the `lint:phpcs` script, and remove the `@lint:phpcs` script from the `lint` script.
3. Run `composer remove squizlabs/php_codesniffer drupal/coder`
4. Remove the `PHPCS` step from `.circleci/config.yml`
5. Commit changes.
