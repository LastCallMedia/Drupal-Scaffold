<?php
/**
 * @file
 *   Travis CI settings.local.php override.
 */
$databases['default']['default'] = array(
  'driver' => 'mysql',
  'hostname' => '127.0.0.1',
  'username' => 'root',
  'database' => 'test',
);

$settings['hash_salt'] = getenv('TRAVIS_BUILD_ID');
