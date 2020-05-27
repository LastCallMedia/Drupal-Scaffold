#!/usr/bin/env bash
set -e

echo "Installing Blackfire PHP Probe..."
curl -o $(php -r "echo ini_get('extension_dir');")/blackfire.so -L -s https://packages.blackfire.io/binaries/blackfire-php/1.34.0/blackfire-php-linux_amd64-php-$(php -r "echo PHP_MAJOR_VERSION . PHP_MINOR_VERSION;").so
printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini

echo "Installing Blackfire CLI..."
curl -o /usr/local/bin/blackfire -L -s https://packages.blackfire.io/binaries/blackfire-agent/1.35.1/blackfire-cli-linux_static_amd64
chmod +x /usr/local/bin/blackfire
