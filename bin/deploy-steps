#!/bin/bash

#
# Execute deployment steps for this site.
#
# Customize this script to match your workflow.  It should be triggered
# anytime the code is deployed to a Pantheon, local, or CI environment.

set -e

bindir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
webroot="$bindir/../web"

drush -r "$webroot" updb --entity-updates

# In this silly example, we just set the default theme,
# but in reality you would probably want to use drush cim -y
drush -r "$webroot" en -y scaffold
drush -r "$webroot" config-set -y system.theme default scaffold
# drush -r "$webroot" cim -y

