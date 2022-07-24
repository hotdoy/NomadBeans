<?php

declare(strict_types=1);

/**
 * @package    Grav\Plugin\Gravel
 *
 * @copyright  Copyright (c) 2015 - 2021 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Gravel\Flex\Types\Taxonomies;

use Grav\Common\Grav;
use Grav\Common\Flex\Types\Generic\GenericObject;
use Grav\Plugin\Gravel\Utils;

/**
 * Class TaxonomiesObject
 * @package Grav\Plugin\Gravel\Flex\Taxonomies
 */
class TaxonomiesObject extends GenericObject {
  /**
   * {@inheritdoc}
   * @see FlexObjectInterface::save()
   */
  public function save() {

    if (!$this->exists()) {
      $this->setSlug($this->getProperty('taxonomy_value'));
    }

    $changes = $this->getChanges();
    if (!empty($changes)) {
      if (isset($changes['taxonomy_value'])) {
        $this->setSlug($changes['taxonomy_value']);
      }
    }

    parent::save();
  }

  public function setSlug($value) {
    $slug = Utils::slug($value, true);
    $this->setProperty('taxonomy_slug', $slug);
    // $this->setStorageKey($slug);
  }
}
