<?php

namespace Grav\Plugin;

// use Grav\Plugin\Gravel\Utils;
use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Uri;
use Grav\Common\Utils;
use Grav\Framework\Psr7\Response;
use Grav\Plugin\Gravel\Utils as GravelUtils;
use RocketTheme\Toolbox\File\File;
use Symfony\Component\Yaml\Yaml;
use Grav\Plugin\Gravel\GravelLoginController as Controller;

/**
 * Class GravelPlugin
 * @package Grav\Plugin
 */
class GravelPlugin extends Plugin {
  /** @var int[] */
  public $features = [
    'blueprints' => 1000,
  ];

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
      'onPluginsInitialized' => ['onPluginsInitialized', 0],
      'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
      'onTask.login.login'  => ['gravelLoginController', 1],
    ];
  }

  /**
   * Initialize the plugin
   */
  public function onPluginsInitialized(): void {
    if ($this->isAdmin()) {
      $this->enable([
        'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 11],
        'onTask.comments.delete' => ['onCommentDelete', 0]
      ]);
      // Don't proceed if we are in the admin plugin
      return;
    }

    // Enable the main events we are interested in
    $this->enable([
      'onTask.report.submit' => ['onReportSubmit', 0]
    ]);

    $this->router();
  }

  protected function json(array $json, $code = 200): void {
    $response = new Response(
      $code,
      [
        'Content-Type' => 'application/json',
        'Cache-Control' => 'no-cache, no-store, must-revalidate'
      ],
      json_encode($json)
    );

    $this->grav->close($response);
  }

  public function onReportSubmit() {
    $slug = $this->grav['uri']->param('location_slug');
    $username = $this->grav['uri']->param('username');

    if ($username === $this->grav['session']->user->username) {
      $dir = $this->grav['flex']->getDirectory('reported');
      $obj = $dir->createObject([
        'location' => $slug,
        'datetime' => date('m/d/Y h:i:s a', time()),
        'username' => $username
      ]);

      $obj->save();

      $this->json([
        'success' => true,
        'slug' => json_encode($obj)
      ]);
    } else {
      $response = new Response(403);
      $this->grav->close($response);
    }
  }

  public function onCommentDelete($stuff) {
    $directory = $this->grav['uri']->param('directory');
    $filename = $this->grav['uri']->param('filename');
    $email = $this->grav['uri']->param('email');
    $date = $this->grav['uri']->param('date');
    $locator = $this->grav['locator'];

    $relpath = $directory . '/' . $filename . '.yaml';
    $filepath = $locator->findResource('user://data/comments/' . $relpath);
    $file = File::instance($filepath);

    if (file_exists($filepath)) {
      $data = Yaml::parse($file->content());

      $data['comments'] = array_filter($data['comments'], function ($c) use ($email, $date) {
        return ($c['email'] != $email && $c['date'] != urldecode($date));
      });

      $data['comments'] = array_values($data['comments']);

      $file->save(Yaml::dump($data));

      $this->grav->redirect('/admin/comments');
    } else {
      $this->grav['messages']->add('The requested location doesn\'t exist.', 'error');
    }
  }

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

  /**
   * Initialize login controller
   */
  public function gravelLoginController(): void {
    /** @var Uri $uri */
    $uri = $this->grav['uri'];
    $task = $_POST['task'] ?? $uri->param('task');
    $task = substr($task, \strlen('login.'));
    $post = !empty($_POST) ? $_POST : [];

    switch ($task) {
      case 'login':
        if (!isset($post['login-form-nonce']) || !Utils::verifyNonce($post['login-form-nonce'], 'login-form')) {
          $this->grav['messages']->add(
            $this->grav['language']->translate('PLUGIN_LOGIN.ACCESS_DENIED'),
            'info'
          );
          $twig = $this->grav['twig'];
          $twig->twig_vars['notAuthorized'] = true;

          return;
        }
        break;

      case 'forgot':
        if (!isset($post['forgot-form-nonce']) || !Utils::verifyNonce($post['forgot-form-nonce'], 'forgot-form')) {
          $this->grav['messages']->add($this->grav['language']->translate('PLUGIN_LOGIN.ACCESS_DENIED'), 'info');
          return;
        }
        break;
    }

    $controller = new Controller($this->grav, $task, $post);
    $controller->execute();
    $controller->redirect();
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
   * Composer autoload
   *
   * @return ClassLoader
   */
  public function autoload(): ClassLoader {
    return require __DIR__ . '/vendor/autoload.php';
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
}
