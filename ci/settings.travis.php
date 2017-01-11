<?php
/**
 * @file
 *   Travis CI settings.local.php override.
 */
$databases['default']['default'] = array(
  'driver' => 'mysql',
  'host' => '127.0.0.1',
  'username' => 'drupal',
  'password' => 'drupal',
  'database' => 'drupal',
);

$settings['hash_salt'] = 'TRAVIS_CI';
