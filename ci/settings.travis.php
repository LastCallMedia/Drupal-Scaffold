<?php
/**
 * @file
 *   Travis CI settings.local.php override.
 */
$databases['default']['default'] = array(
  'driver' => 'mysql',
  'username' => 'root',
  'database' => 'scaffold_test',
);
