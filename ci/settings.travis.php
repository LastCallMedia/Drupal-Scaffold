<?php
/**
 * @file
 *   Travis CI settings.local.php override.
 */
$databases['default']['default'] = array(
  'driver' => 'mysql',
  'username' => 'root',
  'database' => 'test',
);

$settings['hash_salt'] = getenv('TRAVIS_BUILD_ID');
