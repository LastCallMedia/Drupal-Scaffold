XDebug
======

[XDebug](https://xdebug.org) is a remote debugging tool that allows you to pause execution of your code and view variables in real time. XDebug is available for debugging in the `drupal` container.

Configuration
-------------
Create or update the `.env` file at the repository root to enter your XDebug configuration as an environment variable:

```bash
XDEBUG_CONFIG=remote_host=docker.for.mac.localhost
```

The example above assumes you are on a Mac, and configures XDebug to connect back to your Mac on port 9000 (the default) when a debugging session is started. See [this page](https://xdebug.org/docs/remote) for more information on the XDEBUG_CONFIG environment variable.

Usage
-----

1. Using PHPStorm, add a new "PHP Remote Debug" configuration.
2. Set breakpoints in your code.
3. Visit the site in your browser, adding the XDEBUG_SESSION_START query parameter to the end of the URL.  Example: http://localhost:8080?XDEBUG_SESSION_START
4. Step through code in your IDE.

Uninstalling
------------
Xdebug is bundled with the [PHP Docker](https://github.com/LastCallMedia/PHP-Docker) container used for this project and can't be uninstalled.
