<?php
/**
 * @file
 * Quicksilver hook to execute deployment steps, as defined in bin/deploy-steps.
 */
echo "Starting deployment steps";

passthru('../bin/deploy-steps');

echo "Deployment steps complete";
