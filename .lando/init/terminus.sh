#!/usr/bin/env bash

wget https://github.com/pantheon-systems/terminus/releases/download/2.3.0/terminus.phar -O /usr/local/bin/terminus
chmod +x /usr/local/bin/terminus
[ -z "$TERMINUS_MACHINE_TOKEN" ] && echo "Terminus machine token not set" || terminus auth:login --machine-token=$TERMINUS_MACHINE_TOKEN
