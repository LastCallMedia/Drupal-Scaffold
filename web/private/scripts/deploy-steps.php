<?php
/**
 * @file
 * Execute deployment steps for this site.
 *
 * Customize this script to match your workflow.  It will be triggered
 * anytime the code is deployed to a Pantheon, local, or CI environment. We
 * recommend keeping deployment steps the same in all environments in order
 * to make deployment a consistent, predictable process.
 *
 */

/**
 * Run all database updates.
 *
 * This step is recommended for all workflows.
 */
passthru('drush updatedb -y --entity-updates');

/**
 * Import all config from the config directory.
 *
 * This step is recommended for all workflows (uncomment it).
 */
// passthru('drush config-import -y');

/**
 * Enable the scaffold theme and set it as the default.
 *
 * We do NOT recommend this step for your site. It is only here for automated
 * testing on the scaffold project itself.  Remove this step.
 */
passthru('drush en -y scaffold && drush config-set -y system.theme default scaffold');

