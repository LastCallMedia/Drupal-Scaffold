Xdebug
======

[Xdebug](https://xdebug.org) is a remote debugging tool that allows you to pause execution of your code and view variables in real time. Xdebug is available for debugging in the `appserver` service within the Lando local development environment.

While Xdebug is a great tool for debugging, it does add additional performance overhead. Because of this, Xdebug is _disabled_ by default in local environments. It's easy to enable though.

Configuration
-------------

Change the value from `xdebug: false` to `xdebug: true` in `.lando.yml` and run `lando rebuild` to enable Xdebug.

Usage
-----

See the Lando documentation to configure Xdebug in your IDE.
* [PHPStorm](https://docs.lando.dev/guides/lando-phpstorm.html) (bonus [youtube video](https://www.youtube.com/watch?v=sHNJxx0L9r0))
* [VSCode](https://docs.lando.dev/guides/lando-with-vscode.html)

Uninstalling
------------
Change the value from `xdebug: true` to `xdebug: false` in `.lando.yml` and run `lando rebuild` to disable Xdebug.
