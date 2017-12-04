XDebug
======

XDebug is available for debugging in the Drupal PHP container.

Configuration
-------------
Create or update the `.env` file at the repository root to enter the following:

```bash
XDEBUG_CONFIG=remote_host=docker.for.mac.localhost
```

See [this page](https://xdebug.org/docs/remote) for more information on the XDEBUG_CONFIG environment variable.

Usage
-----

1. Using PHPStorm, add a new "PHP Remote Debug" configuration.
2. Set breakpoints in your code.
3. Visit the site in your browser, adding the XDEBUG_SESSION_START query parameter to the end of the URL.  Example: http://localhost:8080:?XDEBUG_SESSION_START
4. Step through code in your IDE.
