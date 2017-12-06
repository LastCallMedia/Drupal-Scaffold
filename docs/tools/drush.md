Drush
=====

[Drush](http://docs.drush.org/en/8.x/) is installed at `vendor/bin/drush`.

Configuration
-------------
Drush configuration and extra commands can be added in the `drush/` directory in the repository root.

Running
-------
Inside of the `drupal` container, you can run Drush just by typing `drush`.  Examples:
* `drush uli`
* `drush en page_cache`

Uninstalling
------------
1. Run `composer remove --dev drush/drush`.
2. Run `git rm drush/`
3. Commit changes.
