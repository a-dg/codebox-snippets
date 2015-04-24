/**
 * Source: /wp-includes/nav-menu-template.php
 * This is copied directly from WordPress core. The start_el() method handles
 * the bulk of rendering an individual menu item. The entire method is copied
 * here, with minor modifications.
 */
class WalkerAddDescriptions extends Walker_Nav_Menu {
  // ...
  public function start_el(&$output, $item, $depth=0, $args=array(), $id=0) {
    // ...
    
    // Insert description for News
    $theme = ThemeOption::getInstance();
    if($item->title === 'News') {
      $item_output .= '<p class="nav-item-description">'.$theme->getSafe('news_nav_description_text').'</p>';
    }
    
    // ...
  }
}
