<?php
/**
 * @file
 * Put local development settings here.
 *
 * Databases, environment specific settings, and overrides should go in this file.
 */

/**
 * Enable development settings, which include turning off twig caching, and
 * enabling twig debug mode.
 */
$settings['container_yamls'][] = __DIR__ . '/development.services.yml';

/**
 * More local development settings.  Disable CSS/JS aggregation,
 * and disable the render cache.
 *
 * This will make your site pretty slow.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;
$settings['cache']['bins']['render'] = 'cache.backend.null';
