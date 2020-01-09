XDebug
======

[XDebug](https://xdebug.org) is a remote debugging tool that allows you to pause execution of your code and view variables in real time. XDebug is available for debugging in the `drupal` container.

Configuration
-------------
Create or update the `.env` file at the repository root to enable XDebug:

```bash
XDEBUG_ENABLE=1
```

Then, run `docker-compose up -d drupal` to recreate the Drupal container with this setting. This will configure XDebug with the following defaults:

```
xdebug.remote_host=host.docker.internal
xdebug.idekey=PHPSTORM
xdebug.remote_enable=On
xdebug.remote_autostart=On
```

This configuration is sufficient to tell XDebug to always be on, and to connect back to your local computer to initiate a debugging session. See the "[Usage](#Usage)" section below for next steps.

You can test if XDebug is properly enabled by running:
```shell script
docker-compose exec drupal php -i | grep xdebug
```
If XDebug is enabled and configured, you should see several XDebug configuration parameters listed.

Usage
-----

1. Using PHPStorm, add a new "PHP Remote Debug" configuration.
2. Set breakpoints in your code.
3. Visit the site in your browser.
4. Step through code in your IDE.

Uninstalling
------------
Xdebug is bundled with the [PHP Docker](https://github.com/LastCallMedia/PHP-Docker) container used for this project and can't be uninstalled. In the absence of the XDEBUG_ENABLE environment variable, the extension will be disabled though.
