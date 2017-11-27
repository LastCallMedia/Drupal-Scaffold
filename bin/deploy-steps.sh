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
# drush -r "$webroot" cim -y

