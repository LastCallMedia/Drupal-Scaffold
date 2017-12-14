<?php
/**
 * Created by PhpStorm.
 * User: rbayliss
 * Date: 12/14/17
 * Time: 12:44 PM
 */

namespace Project;

use Drupal\Core\Composer\Composer as CoreScriptHandler;
use Symfony\Component\Filesystem\Filesystem;
use Composer\Script\Event;

class ComposerHandler {

  /**
   * Fired when we run composer create-project.
   *
   * Remove the manifests directory (we'll rely on remote manifests).
   *
   * @param \Composer\Script\Event $event
   */
  public static function postCreateProject() {
    (new Filesystem())->remove(__DIR__.'/../manifests');
  }

  /**
   * Fired on composer install for each installed package.
   *
   * @param \Composer\Script\Event $event
   */
  public static function postPackageInstall(Event $event) {
    CoreScriptHandler::vendorTestCodeCleanup($event);
  }

  /**
   * Fired on composer update for each updated package.
   *
   * @param \Composer\Script\Event $event
   */
  public static function postPackageUpdate(Event $event) {
    CoreScriptHandler::vendorTestCodeCleanup($event);
  }

  /**
   * Fired on autoload dump (triggered by -o flag to composer install).
   *
   * @param \Composer\Script\Event $event
   */
  public static function preAutoloadDump(Event $event) {
    CoreScriptHandler::preAutoloadDump($event);
  }

}
