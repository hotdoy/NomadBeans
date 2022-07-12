<?php

declare(strict_types=1);

/**
 * @package    Grav\Plugin\Gravel
 *
 * @copyright  Copyright (c) 2015 - 2021 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Gravel\Flex\Types\Cities;

use Grav\Common\Grav;
use Grav\Common\Flex\Types\Generic\GenericObject;
use Grav\Plugin\Gravel\Utils;
use RuntimeException;

/**
 * Class LocationsObject
 * @package Grav\Plugin\Gravel\Flex\Locations
 */
class CitiesObject extends GenericObject {

  public function create(string $key = null) {

    dd('created called');

    if ($key) {
      $this->setStorageKey($key);
    }

    if ($this->exists()) {
      throw new RuntimeException('Cannot create new object (Already exists)');
    }

    return $this->save();
  }

  public function save() {

    if (!$this->exists()) {
      $this->setSlug($this->getProperty('country') . ' ' . $this->getProperty('ascii_name'));
    }

    $changes = $this->getChanges();
    if (!empty($changes)) {

      if (isset($changes['country']) || isset($changes['ascii_name'])) {
        $this->setSlug($this->getProperty('country') . ' ' . $this->getProperty('ascii_name'));
      }
    }

    if ($this->getProperty('country')) {
      $this->setProperty('country_long', Utils::getCountryByCode($this->getProperty('country')));
    }

    parent::save();
  }

  public function setSlug($str) {
    $slug = Utils::slug($str, true);
    $this->setStorageKey($slug);
    $this->setProperty('slug', $slug);
  }
}
