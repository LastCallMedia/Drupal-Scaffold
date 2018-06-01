Blackfire
=====
[Blackfire](https://blackfire.io) is a PHP profiling tool that can provide in-depth performance profiles of web requests and CLI.

Configuration
-------------
Blackfire is already set up, but profiling requires the entry of your client and server tokens in the `.env` file.  See https://blackfire.io to sign up (free) and get those tokens.

Running
-------
* From the Drupal container: `blackfire curl http://127.0.0.1/my/page` will run a profile of `/my/page`.
* From the Drupal container: `blackfire run php myscript.php` will run a profile of `myscript.php`.

Uninstalling
------------
1. Remove your Blackfire tokens from the `.env` file.
2. Remove the blackfire container from `docker-compose.yml`
3. Remove the BLACKFIRE_* environment variables from `docker-compose.yml`.
4. Commit the changes.
