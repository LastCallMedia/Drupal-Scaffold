Behat
=====
PHPUnit is included out of the box.

Configuration
-------------
PHPUnit configuration lives in `phpunit.xml.dist` in the repository root.  It is configured to look for PHPUnit tests in all custom modules.

Running
-------
* `vendor/bin/phpunit` to run all Behat tests.
* `vendor/bin/phpunit web/modules/custom/mymodule/tests/src/Functional/Foo.php` to run a single test.

Uninstalling
------------
1. Run `git rm phpunit.xml.dist`.
2. Edit `composer.json` to remove the `test:phpunit` script, and remove the `@test:phpunit` script from the `test` script.
3. Run `composer remove phpunit/phpunit mikey179/vfsStream`.
4. Remove the `PHPUnit` step from `.circleci/config.yml`
4. Commit changes.
