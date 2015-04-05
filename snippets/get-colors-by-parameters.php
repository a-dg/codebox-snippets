/**
 * Get colors, optionally by parameters
 *
 * Color format is:
 * 'color_name' => array(
 *   'hex' => '#eff0eb',
 *   'colorful' => false, // Is this color colorful?
 *   'positive' => true, // Is this color light enough for dark text?
 *   'negative' => true, // Is this color dark enough for light text?
 * )
 *
 * Of 'positive' and 'negative' values, at least one must be true
 *
 * @param bool $colorful
 * @param bool $positive
 * @param bool $negative
 * @return array
 */
function get_colors($colorful=null, $positive=null, $negative=null) {
  $colors = array(
    'white' => array(
      'hex' => '#fff',
      'colorful' => false,
      'positive' => true,
      'negative' => false,
    ),
    'off_white' => array(
      'hex' => '#eff0eb',
      'colorful' => false,
      'positive' => true,
      'negative' => false,
    ),
    'gray' => array(
      'hex' => '#5f544b',
      'colorful' => false,
      'positive' => false,
      'negative' => true,
    ),
    'blue' => array(
      'hex' => '#08295f',
      'colorful' => false,
      'positive' => false,
      'negative' => true,
    ),
    'orange' => array(
      'hex' => '#dd7125',
      'colorful' => true,
      'positive' => true,
      'negative' => true,
    ),
    'yellow' => array(
      'hex' => '#ecc34e',
      'colorful' => true,
      'positive' => true,
      'negative' => false,
    ),
  );
  
  if($colorful === true) {
    foreach($colors as $key => $color) {
      if(!$color['colorful']) {
        unset($colors[$key]);
      }
    }
  } elseif($colorful === false) {
    foreach($colors as $key => $color) {
      if($color['colorful']) {
        unset($colors[$key]);
      }
    }
  }
  
  if($positive === true && $negative === true) {
    foreach($colors as $key => $color) {
      if(!($color['positive'] && $color['negative'])) {
        unset($colors[$key]);
      }
    }
  } else {
    if($positive === true) {
      foreach($colors as $key => $color) {
        if(!$color['positive']) {
          unset($colors[$key]);
        }
      }
    } elseif($positive === false) {
      foreach($colors as $key => $color) {
        if($color['positive']) {
          unset($colors[$key]);
        }
      }
    }
    
    if($negative === true) {
      foreach($colors as $key => $color) {
        if(!$color['negative']) {
          unset($colors[$key]);
        }
      }
    } elseif($negative === false) {
      foreach($colors as $key => $color) {
        if($color['negative']) {
          unset($colors[$key]);
        }
      }
    }
  }
  
  return $colors;
}


// Usage:
$colors = get_colors(null, true, false);
echo '<h1 style="color: '.$colors[array_rand($colors)]['hex'].';">';
