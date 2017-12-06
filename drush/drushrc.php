<?php

/**
 * @file
 * Used to configure Drush for your site.
 *
 * @see http://api.drush.org/api/drush/examples%21example.drushrc.php/8.0.x
 */

/**
 * List of tables whose *data* is skipped by the 'sql-dump' and 'sql-sync'
 * commands when the "--structure-tables-key=common" option is provided.
 * You may add specific tables to the existing array or add a new element.
 */
$options['structure-tables']['common'] = [
  'cache_*',
  'history',
  'search_*',
  'sessions',
  'watchdog'
];

/**
 * Make sql-dump default to using the 'common' structure tables, as defined
 * above.
 */
$command_specific['sql-dump']['structure-tables-key'] = 'common';
