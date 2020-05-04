Backstop Visual Regression Testing
==================================

Visual regression tests are run manually before and after a Pull Request has been created.

## Before any changes to the branch
To get a baseline of the local setup. If you update the database you should redo the reference before running the test

Run this from outside the container:
1. `docker-compose run backstop reference`

## After the changes to the branch has happen or committed
1. `docker-compose run backstop test`
2. `open backstop/report/index.html`
