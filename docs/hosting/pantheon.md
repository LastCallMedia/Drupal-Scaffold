Pantheon
========

This project comes pre-configured for deployment on Pantheon.  

Recommended Workflow
--------------------
We recommend that all work happens in feature branches, and goes through a Pull Request process on Github before being merged to the `master` branch.  This is our standard workflow:

1. Developer starts work on a new feature by branching off of `master` into a new branch, `p-123`, where 123 is the ticket number.
2. Developer pushes work to Github on the `p-123` branch and creates a Pull Request.  As soon as the `p-123` branch is pushed to Github, it is also sent to a Pantheon multidev instance for review.
3. Pull request is reviewed and merged to master.  As soon as the `p-123` branch is deleted, the `p-123` multidev instance is destroyed.  As soon as the code is merged to master, it is deployed to the Pantheon `dev` instance for final signoff and deployment.

This workflow is automated through the [Circle CI configuration](../../.circleci/config.yml) that comes with this project.

Not hosting on Pantheon?
------------------------
These are the pieces that are specific to Pantheon's architecture:

* `pantheon.yml`.
* `web/` docroot.
* `web/sites/default/settings.pantheon.php`.
* Inclusion of `settings.pantheon.php` from `settings.php`.
* The multidev deployment workflow in `.circleci/config.yml`.
* Terminus package in `composer.json`.
