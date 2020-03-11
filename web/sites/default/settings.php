<?php

// Database configuration is handled in envirionment-specific files.
$databases = [];

// Config directories can be defined in environment specific directories,
// and the CONFIG_SYNC_DIRECTORY is defined at the end of this file so it
// is consistent across all environments.
$config_directories = [];

// Hardcoded setting that prevents anonymous user access to update.php
$settings['update_free_access'] = FALSE;

// Define site services file.
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

// Ignore files in node_modules and bower_components directories because
// they are irrelevant to Drupal's backend functionality.
$settings['file_scan_ignore_directories'] = ['node_modules', 'bower_components'];

// Always include a Pantheon settings file.
require __DIR__.'/settings.pantheon.php';

// Load environment-specific configuration overrides, if applicable.
if((isset($_ENV['LANDO'])) && ($_ENV['LANDO'] === 'ON') && (file_exists(__DIR__ . '/settings.lando.php'))) {
  require __DIR__ . '/settings.lando.php';
}

// Include an optional local settings override. Assumes Pantheon is production
// host, these checks can be changed to work with other hosting providers as
// well.
if(!isset($_ENV['PANTHEON_ENVIRONMENT']) && file_exists(__DIR__ . '/settings.local.php')) {
  require __DIR__ . '/settings.local.php';
}

// Hard-coded config directory.  This should not be overrideable
// from any of the settings files we include, so we set it last.
$config_directories[CONFIG_SYNC_DIRECTORY] = $app_root.'/../config';
