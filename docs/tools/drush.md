Drush
=====

[Drush](http://docs.drush.org/en/8.x/) is installed at `vendor/bin/drush`.

Configuration
-------------
Drush configuration and extra commands can be added in the `drush/` directory in the repository root.

Running
-------
Drush comes preinstalled in the `appserver` service of the Lando development environment.
You can run it from the host machine by typing `lando drush`.  Examples:
* `lando drush uli` - Generate a one time login link.
* `lando drush en page_cache` - Enable the page cache module.
