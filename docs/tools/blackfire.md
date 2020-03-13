Blackfire
=====
[Blackfire](https://blackfire.io) is a PHP profiling tool that can provide in-depth performance profiles of web requests and CLI.

Configuration
-------------
Blackfire is already set up, but profiling requires the entry of your client and server tokens in the `.lando/env/private.env` file.  See https://blackfire.io to sign up (free) and get those tokens from https://blackfire.io/my/settings/credentials.

Running
-------
* From the host: `lando blackfire curl -k https://drupal-scaffold.lndo.site/my/page` will run a profile of `/my/page`.
* From the host: `lando blackfire run php myscript.php` will run a profile of `myscript.php`.

Uninstalling
------------
1. Remove your Blackfire tokens from the `.lando/env/private.env` file.
2. Remove the blackfire config from `.lando.yml`:
   - `build_as_root` in `appserver` service override: remove `.lando/init/blackfire.sh` step
   - `config` in `appserver` service override: remove `conf: .lando/init/php.ini`
   - TODO: Any other steps in `.lando.yml` that need to be removed?
4. Commit the changes.
5. Rebuild appserver lando service `lando rebuild -s appserver`
