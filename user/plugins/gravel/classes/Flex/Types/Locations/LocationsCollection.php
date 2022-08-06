<?php

declare(strict_types=1);

namespace Grav\Plugin\Gravel\Flex\Types\Locations;

use Grav\Common\Flex\Types\Generic\GenericCollection;
use Grav\Plugin\Gravel\Utils;

/**
 * Class LocationsCollection
 * @package Grav\Common\Flex\Generic
 *
 * @extends GenericCollection<GenericCollection>
 */
class LocationsCollection extends GenericCollection {
  public function inArray($key, array $values) {
    $mappedCollection = $this->map(function ($obj) use ($values, $key) {
      foreach ($values as $value) {
        if (in_array($value, $obj->getProperty($key, []))) {
          return $obj;
        }
      }
      return false;
    });

    $array_with_falsy_elements_removed = array_filter($mappedCollection->getElements(), function ($e) {
      return $e; 
    });

    return $this->createFrom(array_values($array_with_falsy_elements_removed));
  }

  public function filterByAmenities($amenities) {
    return $this->filter(function ($object) use ($amenities) {
      $missingAmenitiy = false;
      foreach($amenities as $amenity) {
        if (!in_array($amenity, $object->getProperty('amenities'))) {
          $missingAmenitiy = true;
        }
      }

      return !$missingAmenitiy;
    });
  }
}
