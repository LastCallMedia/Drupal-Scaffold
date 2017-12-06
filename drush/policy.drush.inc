<?php

/**
 * @file
 * Used to set sitewide "policies" for Drush commands.
 */

/**
 * Implements drush_hook_COMMAND_validate().
 *
 * Encourage folks to use `composer` instead of Drush pm commands.
 */
function drush_policy_pm_updatecode_validate() {
  return _deny_message();
}

/**
 * Implements hook_drush_COMMAND_validate().
 */
function drush_policy_pm_update_validate() {
  return _deny_message();
}

/**
 * Implements hook_drush_COMMAND_validate().
 */
function drush_policy_pm_download_validate() {
  return _deny_message();
}

/**
 * Throw a "denied" error.
 */
function _deny_message() {
  if (!drush_get_option('pm-force')) {
    $msg = 'This codebase is assembled with Composer instead of Drush. Use `composer update` and `composer require` instead of `drush pm-updatecode` and `drush pm-download`. You may override this error by using the --pm-force option.';
    return drush_set_error('POLICY_PM_DENY', dt($msg));
  }
}

/**
 * Implements hook_drush_help_alter().
 */
function policy_drush_help_alter(&$command) {
  $commands = [
    'pm-updatecode',
    'pm-update',
    'pm-download',
  ];
  if (in_array($command['command'], $commands)) {
    $command['options']['pm-force'] = 'Override site policy and allow Drush codebase management (pm-* commands)';
  }
}
