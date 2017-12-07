<?php
/**
 * @file
 * Quicksilver hook to execute deployment steps, as defined in bin/deploy-steps.
 */
echo "Starting deployment steps";

passthru('drush updatedb -y --entity-updates');

passthru('drush en -y scaffold && drush config-set -y system.theme default scaffold');

echo "Deployment steps complete";
