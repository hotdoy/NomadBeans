<?php

declare(strict_types=1);

/**
 * @package    Grav\Plugin\Gravel
 *
 * @copyright  Copyright (c) 2015 - 2021 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Gravel\Flex\Types\Locations;

use Grav\Common\Grav;
use Grav\Common\Flex\Types\Generic\GenericObject;
use Grav\Plugin\Gravel\Utils;

/**
 * Class LocationsObject
 * @package Grav\Plugin\Gravel\Flex\Locations
 */
class LocationsObject extends GenericObject {
  /**
   * {@inheritdoc}
   * @see FlexObjectInterface::save()
   */
  public function save() {

    if (!$this->exists()) {
      $this->setSlug($this->getProperty('city') . '-', $this->getProperty('name'));
    }

    $changes = $this->getChanges();
    if (!empty($changes)) {
      if (isset($changes['name']) || isset($changes['city'])) {
        $this->setSlug($this->getProperty('city') . '-', $this->getProperty('name'));
      }
    }

    parent::save();
  }

  public function setSlug($city, $str) {
    $slug = Utils::slug($str, true);
    $this->setStorageKey($city . $slug);
    $this->setProperty('slug', $city . $slug);
  }
}
