Pantheon
========

This project comes pre-configured for deployment on Pantheon.  

Not hosting on Pantheon?
------------------------
These are the pieces that are specific to Pantheon's architecture:

* `pantheon.yml`.
* `web/` docroot.
* `web/sites/default/settings.pantheon.php`.
* Inclusion of `settings.pantheon.php` from `settings.php`.
* The multidev deployment workflow in `.circleci/config.yml`.
* Terminus package in `composer.json`.
