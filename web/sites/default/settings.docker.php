<?php

$databases['default']['default'] = [
  'driver' => 'mysql',
  'collation' => 'utf8mb4_general_ci',
  'host' => getenv('MYSQL_HOST') ?: 'mysql',
  'database' => getenv('MYSQL_DATABASE'),
  'username' => getenv('MYSQL_USER'),
  'password' => getenv('MYSQL_PASSWORD'),
];

// Important: set a consistent cache prefix.  Otherwise,
// prefix will be different between drush and web runs.
$prefix = sprintf("%s:%s", getenv('SITE_NAME'), getenv('DOCKER_ENV'));
$settings['cache_prefix'] = $prefix;
$settings['hash_salt'] = getenv('HASH_SALT') ?: 'insecurehashsalt';
$config['search_api_solr.settings']['site_hash'] = $prefix;

// Allow any docker container to serve as a reverse
// proxy for this one.
$settings['reverse_proxy'] = TRUE;
$settings['reverse_proxy_addresses'] = ['172.0.0.0/8'];

if(FALSE !== getenv('REDIS_HOST')) {
  $settings['redis.connection']['interface'] = 'PhpRedis';
  $settings['redis.connection']['base'] = getenv('REDIS_BASE') ?: 0;
  $settings['redis.connection']['host'] = getenv('REDIS_HOST') ?: 'redis';
  $settings['redis.connection']['port'] = getenv('REDIS_PORT') ?: 6379;
  $settings['redis.connection']['password'] = getenv('REDIS_PASSWORD') ?: NULL;

  /**
   * The following configuration can only be used after the Redis module
   * has been enabled.  It uses Redis as the primary cache bin, but uses
   * the chainedfast (Redis + APCu) backend for frequently used items.
   */
//  $settings['container_yamls'][] = __DIR__ .'/redis.services.yml';
//  $settings['cache']['default'] = 'cache.backend.redis';
//  $settings['cache']['bins']['bootstrap'] = 'cache.backend.chainedfast';
//  $settings['cache']['bins']['config'] = 'cache.backend.chainedfast';
//  $settings['cache']['bins']['discovery'] = 'cache.backend.chainedfast';
}

