<?php

namespace Project;

use Drupal\Core\Composer\Composer as CoreScriptHandler;
use Symfony\Component\Filesystem\Filesystem;
use Composer\Script\Event;
use Composer\Installer\PackageEvent;

/**
 * Handle composer events.
 */
class ComposerHandler {

  /**
   * Fired when we run composer create-project.
   *
   * Remove the manifests directory (we'll rely on remote manifests).
   *
   * @param \Composer\Script\Event $event
   *   The event object.
   */
  public static function postCreateProject(Event $event) {
    (new Filesystem())->remove([
      __DIR__ . '/Resources/manifests',
    ]);

  }

  /**
   * Fired on composer install for each installed package.
   *
   * @param \Composer\Installer\PackageEvent $event
   *   The event object.
   */
  public static function postPackageInstall(PackageEvent $event) {
    if (class_exists(CoreScriptHandler::class)) {
      CoreScriptHandler::vendorTestCodeCleanup($event);
    }
  }

  /**
   * Fired on composer update for each updated package.
   *
   * @param \Composer\Installer\PackageEvent $event
   *   The event object.
   */
  public static function postPackageUpdate(PackageEvent $event) {
    if (class_exists(CoreScriptHandler::class)) {
      CoreScriptHandler::vendorTestCodeCleanup($event);
    }
  }

  /**
   * Fired on autoload dump (triggered by -o flag to composer install).
   *
   * @param \Composer\Script\Event $event
   *   The event object.
   */
  public static function preAutoloadDump(Event $event) {
    if (class_exists(CoreScriptHandler::class)) {
      CoreScriptHandler::preAutoloadDump($event);
    }
  }

}
