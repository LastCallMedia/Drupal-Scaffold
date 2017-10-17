<?php

use Symfony\Component\Finder\Finder;
use LastCall\Mannequin\Drupal\DrupalExtension;
use LastCall\Mannequin\Core\MannequinConfig;

$templateFinder = Finder::create()
  ->in([__DIR__.'/web/themes/custom/scaffold/templates'])
  ->files()
  ->name('*.html.twig');

$drupalExtension = new DrupalExtension([
  'finder' => $templateFinder,
  'drupal_root' => __DIR__.'/web',
  'twig_options' => [
    'auto_reload' => TRUE,
  ]
]);

$config = MannequinConfig::create()
  ->addExtension($drupalExtension)
  ->setGlobalCss([
    'web/themes/custom/scaffold/dist/css/style.css',
  ])
  ->setGlobalJs([
    'web/core/assets/vendor/jquery/jquery.min.js',
    'web/core/misc/drupal.js',
    'web/themes/custom/scaffold/dist/js/libs.min.js',
    'web/themes/custom/scaffold/dist/js/theme.min.js',
  ]);

return $config;
