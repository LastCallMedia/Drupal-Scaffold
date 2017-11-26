Behat
=====
[Behat](http://behat.org/en/latest/) is installed with the [Behat Drupal Extension](https://behat-drupal-extension.readthedocs.io/en/3.1/) at `vendor/bin/behat`.

Configuration
-------------
Behat configuration lives in `behat.yml` in the repository root.  The FeatureContext and all feature definitions live in the `features` directory.

Running
-------
* `vendor/bin/behat` to run all Behat tests.
* `vendor/bin/behat features/drush.feature` to test a single feature.

Uninstalling
------------
1. Run `git rm behat.yml features/`.
2. Edit `composer.json` to remove the `test:behat` script, and remove the `@test:behat` script from the `test` script.
2. Run `composer remove drupal/drupal-extension`.
4. Remove the `Behat` step from `.circleci/config.yml`
3. Commit changes.
