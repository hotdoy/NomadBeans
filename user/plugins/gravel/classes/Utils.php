<?php

namespace Grav\Plugin\Gravel;

use Grav\Common\Grav;

class Utils {

  public static $country_list = array(
    'AF' => 'Afghanistan',
    'AX' => 'Aland Islands',
    'AL' => 'Albania',
    'DZ' => 'Algeria',
    'AS' => 'American Samoa',
    'AD' => 'Andorra',
    'AO' => 'Angola',
    'AI' => 'Anguilla',
    'AQ' => 'Antarctica',
    'AG' => 'Antigua and Barbuda',
    'AR' => 'Argentina',
    'AM' => 'Armenia',
    'AW' => 'Aruba',
    'AU' => 'Australia',
    'AT' => 'Austria',
    'AZ' => 'Azerbaijan',
    'BS' => 'Bahamas the',
    'BH' => 'Bahrain',
    'BD' => 'Bangladesh',
    'BB' => 'Barbados',
    'BY' => 'Belarus',
    'BE' => 'Belgium',
    'BZ' => 'Belize',
    'BJ' => 'Benin',
    'BM' => 'Bermuda',
    'BT' => 'Bhutan',
    'BO' => 'Bolivia',
    'BA' => 'Bosnia and Herzegovina',
    'BW' => 'Botswana',
    'BV' => 'Bouvet Island (Bouvetoya)',
    'BR' => 'Brazil',
    'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
    'VG' => 'British Virgin Islands',
    'BN' => 'Brunei Darussalam',
    'BG' => 'Bulgaria',
    'BF' => 'Burkina Faso',
    'BI' => 'Burundi',
    'KH' => 'Cambodia',
    'CM' => 'Cameroon',
    'CA' => 'Canada',
    'CV' => 'Cape Verde',
    'KY' => 'Cayman Islands',
    'CF' => 'Central African Republic',
    'TD' => 'Chad',
    'CL' => 'Chile',
    'CN' => 'China',
    'CX' => 'Christmas Island',
    'CC' => 'Cocos (Keeling) Islands',
    'CO' => 'Colombia',
    'KM' => 'Comoros the',
    'CD' => 'Congo',
    'CG' => 'Congo the',
    'CK' => 'Cook Islands',
    'CR' => 'Costa Rica',
    'CI' => 'Cote d\'Ivoire',
    'HR' => 'Croatia',
    'CU' => 'Cuba',
    'CY' => 'Cyprus',
    'CZ' => 'Czech Republic',
    'DK' => 'Denmark',
    'DJ' => 'Djibouti',
    'DM' => 'Dominica',
    'DO' => 'Dominican Republic',
    'EC' => 'Ecuador',
    'EG' => 'Egypt',
    'SV' => 'El Salvador',
    'GQ' => 'Equatorial Guinea',
    'ER' => 'Eritrea',
    'EE' => 'Estonia',
    'ET' => 'Ethiopia',
    'FO' => 'Faroe Islands',
    'FK' => 'Falkland Islands (Malvinas)',
    'FJ' => 'Fiji the Fiji Islands',
    'FI' => 'Finland',
    'FR' => 'France',
    'GF' => 'French Guiana',
    'PF' => 'French Polynesia',
    'TF' => 'French Southern Territories',
    'GA' => 'Gabon',
    'GM' => 'Gambia the',
    'GE' => 'Georgia',
    'DE' => 'Germany',
    'GH' => 'Ghana',
    'GI' => 'Gibraltar',
    'GR' => 'Greece',
    'GL' => 'Greenland',
    'GD' => 'Grenada',
    'GP' => 'Guadeloupe',
    'GU' => 'Guam',
    'GT' => 'Guatemala',
    'GG' => 'Guernsey',
    'GN' => 'Guinea',
    'GW' => 'Guinea-Bissau',
    'GY' => 'Guyana',
    'HT' => 'Haiti',
    'HM' => 'Heard Island and McDonald Islands',
    'VA' => 'Holy See (Vatican City State)',
    'HN' => 'Honduras',
    'HK' => 'Hong Kong',
    'HU' => 'Hungary',
    'IS' => 'Iceland',
    'IN' => 'India',
    'ID' => 'Indonesia',
    'IR' => 'Iran',
    'IQ' => 'Iraq',
    'IE' => 'Ireland',
    'IM' => 'Isle of Man',
    'IL' => 'Israel',
    'IT' => 'Italy',
    'JM' => 'Jamaica',
    'JP' => 'Japan',
    'JE' => 'Jersey',
    'JO' => 'Jordan',
    'KZ' => 'Kazakhstan',
    'KE' => 'Kenya',
    'KI' => 'Kiribati',
    'KP' => 'Korea',
    'KR' => 'Korea',
    'KW' => 'Kuwait',
    'KG' => 'Kyrgyz Republic',
    'LA' => 'Lao',
    'LV' => 'Latvia',
    'LB' => 'Lebanon',
    'LS' => 'Lesotho',
    'LR' => 'Liberia',
    'LY' => 'Libyan Arab Jamahiriya',
    'LI' => 'Liechtenstein',
    'LT' => 'Lithuania',
    'LU' => 'Luxembourg',
    'MO' => 'Macao',
    'MK' => 'Macedonia',
    'MG' => 'Madagascar',
    'MW' => 'Malawi',
    'MY' => 'Malaysia',
    'MV' => 'Maldives',
    'ML' => 'Mali',
    'MT' => 'Malta',
    'MH' => 'Marshall Islands',
    'MQ' => 'Martinique',
    'MR' => 'Mauritania',
    'MU' => 'Mauritius',
    'YT' => 'Mayotte',
    'MX' => 'Mexico',
    'FM' => 'Micronesia',
    'MD' => 'Moldova',
    'MC' => 'Monaco',
    'MN' => 'Mongolia',
    'ME' => 'Montenegro',
    'MS' => 'Montserrat',
    'MA' => 'Morocco',
    'MZ' => 'Mozambique',
    'MM' => 'Myanmar',
    'NA' => 'Namibia',
    'NR' => 'Nauru',
    'NP' => 'Nepal',
    'AN' => 'Netherlands Antilles',
    'NL' => 'Netherlands the',
    'NC' => 'New Caledonia',
    'NZ' => 'New Zealand',
    'NI' => 'Nicaragua',
    'NE' => 'Niger',
    'NG' => 'Nigeria',
    'NU' => 'Niue',
    'NF' => 'Norfolk Island',
    'MP' => 'Northern Mariana Islands',
    'NO' => 'Norway',
    'OM' => 'Oman',
    'PK' => 'Pakistan',
    'PW' => 'Palau',
    'PS' => 'Palestinian Territory',
    'PA' => 'Panama',
    'PG' => 'Papua New Guinea',
    'PY' => 'Paraguay',
    'PE' => 'Peru',
    'PH' => 'Philippines',
    'PN' => 'Pitcairn Islands',
    'PL' => 'Poland',
    'PT' => 'Portugal, Portuguese Republic',
    'PR' => 'Puerto Rico',
    'QA' => 'Qatar',
    'RE' => 'Reunion',
    'RO' => 'Romania',
    'RU' => 'Russian Federation',
    'RW' => 'Rwanda',
    'BL' => 'Saint Barthelemy',
    'SH' => 'Saint Helena',
    'KN' => 'Saint Kitts and Nevis',
    'LC' => 'Saint Lucia',
    'MF' => 'Saint Martin',
    'PM' => 'Saint Pierre and Miquelon',
    'VC' => 'Saint Vincent and the Grenadines',
    'WS' => 'Samoa',
    'SM' => 'San Marino',
    'ST' => 'Sao Tome and Principe',
    'SA' => 'Saudi Arabia',
    'SN' => 'Senegal',
    'RS' => 'Serbia',
    'SC' => 'Seychelles',
    'SL' => 'Sierra Leone',
    'SG' => 'Singapore',
    'SK' => 'Slovakia (Slovak Republic)',
    'SI' => 'Slovenia',
    'SB' => 'Solomon Islands',
    'SO' => 'Somalia, Somali Republic',
    'ZA' => 'South Africa',
    'GS' => 'South Georgia and the South Sandwich Islands',
    'ES' => 'Spain',
    'LK' => 'Sri Lanka',
    'SD' => 'Sudan',
    'SR' => 'Suriname',
    'SJ' => 'Svalbard & Jan Mayen Islands',
    'SZ' => 'Swaziland',
    'SE' => 'Sweden',
    'CH' => 'Switzerland, Swiss Confederation',
    'SY' => 'Syrian Arab Republic',
    'TW' => 'Taiwan',
    'TJ' => 'Tajikistan',
    'TZ' => 'Tanzania',
    'TH' => 'Thailand',
    'TL' => 'Timor-Leste',
    'TG' => 'Togo',
    'TK' => 'Tokelau',
    'TO' => 'Tonga',
    'TT' => 'Trinidad and Tobago',
    'TN' => 'Tunisia',
    'TR' => 'Turkey',
    'TM' => 'Turkmenistan',
    'TC' => 'Turks and Caicos Islands',
    'TV' => 'Tuvalu',
    'UG' => 'Uganda',
    'UA' => 'Ukraine',
    'AE' => 'United Arab Emirates',
    'GB' => 'United Kingdom',
    'US' => 'United States',
    'UM' => 'United States Minor Outlying Islands',
    'VI' => 'United States Virgin Islands',
    'UY' => 'Uruguay, Eastern Republic of',
    'UZ' => 'Uzbekistan',
    'VU' => 'Vanuatu',
    'VE' => 'Venezuela',
    'VN' => 'Vietnam',
    'WF' => 'Wallis and Futuna',
    'EH' => 'Western Sahara',
    'YE' => 'Yemen',
    'ZM' => 'Zambia',
    'ZW' => 'Zimbabwe'
  );

  public static $amenities_list = array(
    'good-food' => 'Good Food',
    'natural-light' => 'Natural LIght',
    'public-restrooms' => 'Public Restrooms',
    'fast-service' => 'Fast Service',
    'outdoor-seating' => 'Outdoor Seating',
    'spacious-interior' => 'Spacious Interior',
    'artistic-decorations' => 'Artistic Decorations',
    'nice-music' => 'Nice Music',
    'open-late' => 'Open Late' ,
    'friendly-service' => 'Friendly Service'
  );

  /**
   * This method creates a slug from the id and the name of a property.
   *
   * @param string $str
   * @param false $lower
   * @return string
   */
  public static function slug(string $str, $lower = false): string {
    if (function_exists('transliterator_transliterate')) {
      $str = transliterator_transliterate('Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove;', $str);
    } else {
      $str = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
    }

    if ($lower) {
      $str = mb_strtolower($str);
    }

    $str = preg_replace('/[-\s]+/', '-', $str);
    $str = preg_replace('/[^a-z0-9-]/i', '', $str);
    return trim($str, '-');
  }

  /**
   * This method returns a country's full name from alpha2 code
   *
   * @param string $str
   * @return string
   */
  public static function getCountryByCode($code) {

    $code = strtoupper($code);

    if (!Self::$country_list[$code]) return $code;
    else return Self::$country_list[$code];
  }

  public static function getCountries() {
    return Self::$country_list;
  }

  public static function getTaxonomiesByType($type) {
    $taxonomies = Grav::instance()->get('flex')->getDirectory('taxonomies');
    $col = $taxonomies ? $taxonomies->getCollection() : null;

    if ($col) {
      return $col->filterBy(['taxonomy_type' => $type]);
    }

    return;
  }

  public static function getTaxonomiesForCheckboxesByType() {
    $t = Self::getTaxonomiesByType('article_tag');

    $slugValuePairs = [];

    foreach($t as $taxObject) {
      $slugValuePairs[$taxObject->getProperty('taxonomy_slug')] = $taxObject->getProperty('taxonomy_value');
    }

    return $slugValuePairs;
  }

  public static function getTaxonomiesForSelectizeByType($type) {
    $t = Self::getTaxonomiesByType($type); 

    $slugValuePairs = [];

    foreach($t as $taxObject) {
      array_push($slugValuePairs, [
        'value' => $taxObject->getProperty('taxonomy_slug'),
        'text' => $taxObject->getProperty('taxonomy_value')
      ]);
    }

    return $slugValuePairs;
  }

  public static function getAmenitiesForSelectize() {
    $formatted_list = array();

    foreach(Self::$amenities_list as $key => $value) {
      array_push($formatted_list, [
        'text' => $value,
        'value' => $key
      ]);
    }

    return $formatted_list;
  }

  public static function getAmenityNameByKey($key) {
    return Self::$amenities_list[$key];
  }

  public static function getAmenitiesList() {
    return Self::$amenities_list;
  }

  public static function getUserFullname() {
    return Grav::instance()['user']->fullname;
  }

  public static function getUserEmail() {
    return Grav::instance()['user']->email;
  }

  public static function getLocationNameByKey($key) {
    $locations = Grav::instance()->get('flex')->getDirectory('locations');
    $col = $locations ? $locations->getCollection() : null;

    if ($col) {
      $obj = $col->get($key);

      if ($obj) {
        return $obj->name;
      }
    }
    
    return null;
  }

  public static function getLocationNameFromUri() {
    $location_key = Grav::instance()['uri']->param('location');
    
    if ($location_key) {
      return Self::getLocationNameByKey($location_key);
    }
  }

  public static function getCityObjectByKey($key) {

    /** @var FlexDirectoryInterface|null $cities */
    $directory = Grav::instance()->get('flex')->getDirectory('cities');

    if ($directory) {
      /** @var FlexObjectInterface|null $city */
      $object = $directory->getObject($key);
  
      return $object;
    }

    return false;
  }

  public static function getUserFavoritesWithNameAsLink() {
    $favs = Grav::instance()['user']->favorites;
    $favSlugNamePairs = [];

    if ($favs) {
      foreach($favs as $key => $val) {
        if ($val) {
          $favSlugNamePairs[$key] = '<a class="link link-primary" target="_blank" href="/locations/'.$key.'">' . Self::getLocationNameByKey($key) . '</a>';
        }
      }

      return $favSlugNamePairs;
    }
  }

  public static function filterLocationCollectionByAmenities($collection, $amenities) {
    return $collection->filter(function ($object) use ($amenities) {
      $missingAmenitiy = false;
      foreach($amenities as $amenity) {
        if (!in_array($amenity, $object->getProperty('amenities'))) {
          $missingAmenitiy = true;
        }
      }

      if ($missingAmenitiy) {
        return false;
      } else {
        return true;
      }
    });
  }
}
