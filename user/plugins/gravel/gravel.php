<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Common\Grav;

/**
 * Class GravelPlugin
 * @package Grav\Plugin
 */
class GravelPlugin extends Plugin {
  /** @var int[] */
  public $features = [
    'blueprints' => 1000,
  ];

  public static function getFlexCities(): array {
    $flex       = Grav::instance()['flex'] ?? null;
    $collection = $flex ? $flex->getCollection('cities') : null; // change this line

    if (!$collection) {
      return [];
    }

    $objects = $collection->toArray();
    $result  = [];

    foreach ($objects as $object) {
      $result[$object->getStorageKey()] = $object->getProperty('id') . ' - ' . $object->getProperty('name') . ' (' . $object->getProperty('country') . ')';
    }

    return $result;
  }

  /**
   * @return array
   *
   * The getSubscribedEvents() gives the core a list of events
   *     that the plugin wants to listen to. The key of each
   *     array section is the event that the plugin listens to
   *     and the value (in the form of an array) contains the
   *     callable (or function) as well as the priority. The
   *     higher the number the higher the priority.
   */
  public static function getSubscribedEvents(): array {
    return [
      'onPluginsInitialized' => [
        // Uncomment following line when plugin requires Grav < 1.7
        // ['autoload', 100000],
        ['onPluginsInitialized', 0]
      ]
    ];
  }

  /**
   * Composer autoload
   *
   * @return ClassLoader
   */
  public function autoload(): ClassLoader {
    return require __DIR__ . '/vendor/autoload.php';
  }

  /**
   * Initialize the plugin
   */
  public function onPluginsInitialized(): void {
    // Don't proceed if we are in the admin plugin
    if ($this->isAdmin()) {
      $this->enable([
        'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 11],
      ]);
      return;
    }

    // Enable the main events we are interested in
    $this->enable([
      // Put your main events here
    ]);
  }

  /**
   * Add plugin templates path
   *
   * @param Event $event
   * @return void
   */
  public function onAdminTwigTemplatePaths($event): void {
    $paths          = $event['paths'];
    $paths[]        = __DIR__ . '/admin/templates';
    $event['paths'] = $paths;
  }
}
