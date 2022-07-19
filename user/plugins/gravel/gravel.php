<?php

namespace Grav\Plugin;

// use Grav\Plugin\Gravel\Utils;
use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Uri;
use Grav\Common\Utils;
use Grav\Plugin\Gravel\Utils as GravelUtils;

/**
 * Class GravelPlugin
 * @package Grav\Plugin
 */
class GravelPlugin extends Plugin {
  /** @var int[] */
  public $features = [
    'blueprints' => 1000,
  ];

  public function router() {
    /** @var Uri $uri */
    $uri = $this->grav['uri'];
    $route = Uri::getCurrentRoute()->getRoute();

    if (Utils::startsWith($route, '/locations')) {
      $this->enable([
        'onPagesInitialized' => ['addLocationPage', 0]
      ]);
    }
  }

  public function addLocationPage() {
    $route = Uri::getCurrentRoute()->getRoute();
    $parts = explode("/", $route);
    $key = array_shift($parts);
    $directory = array_shift($parts);
    $path = array_shift($parts);

    /** @var Pages $pages */
    $pages = $this->grav['pages'];
    if ($pages->find($route)) {
      /** @var Debugger $debugger */
      $debugger = $this->grav['debugger'];
      $debugger->addMessage("Page {$route} already exists, page cannot be added", 'error');
      return;
    }

    $flex = Grav::instance()->get('flex');
    $location = $flex->getObject($path, 'locations');

    $page = $pages->find('/locations/location');
    if ($page) {
      $page->id($page->modified() . md5($route));
      $page->slug(basename($route));
      $page->folder(basename($route));
      $page->route($route);
      $page->rawRoute($route);
      $page->modifyHeader('object', $path);
      if ($location) {
        $page->modifyHeader('title', $location->getProperty('name'));
      }
      $pages->addPage($page, $route);
    }
  }

  public static function getFlexCities(): array {
    $flex       = Grav::instance()['flex'] ?? null;
    $collection = $flex ? $flex->getCollection('cities') : null;

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
      ],
      'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
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
        'onFlexObjectBeforeSave' => ['onFlexObjectBeforeSave', 0],
        'onTask.task:comment.delete' => ['onTaskDeleteComment', 0],
      ]);
      return;
    }

    // Enable the main events we are interested in
    $this->enable([]);

    $this->router();
  }

  public function onTaskDeleteComment($val) {
    dd($val);
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

  public function onTwigSiteVariables() {
    $twig = $this->grav['twig'];

    $twig->twig_vars['gravel_utils'] = new GravelUtils;
  }

  public function onAdminPageInitialized() {

    if (isset($_GET['blahblah'])) {
      dd($_GET["blahblah"]);
    }
  }
}
