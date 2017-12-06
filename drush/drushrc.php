<?php

/**
 * @file
 * Used to configure Drush for your site.
 *
 * @see http://api.drush.org/api/drush/examples%21example.drushrc.php/8.0.x
 */

/**
 * List of tables whose data we can skip during `sql-dump`.
 */
$options['structure-tables']['common'] = [
  'cache_*',
  'history',
  'search_*',
  'sessions',
  'watchdog',
];

/**
 * Use the 'common' structure tables when executing `sql-dump`.
 */
$command_specific['sql-dump']['structure-tables-key'] = 'common';
