/**
 * Get edit link when admin is logged in
 * @param int $id Post ID or term ID
 * @param string $edit_type Post type or taxonomy slug
 * @param string $label Optional admin-facing name for $edit_type
 * @return string HTML
 */
function get_edit_link($id=null, $edit_type='post', $label=null) {
  if(!(is_user_logged_in() && current_user_can('manage_options'))) return null;
  
  $edit_link_css_class = 'front-end-edit-link clearfix';
  if(is_null($label)) {
    $label = Str::human(str_replace('-', ' ', $edit_type));
  }
  $subclasses = \Taco\Post\Loader::getSubclasses();
  $subclasses_machine = array_map(
    function($el){
      $el = substr($el, strrpos($el, '\\'));
      $el = Str::camelToHuman($el);
      $el = Str::machine($el, '-');
      return $el;
    }, $subclasses
  );
  if(in_array($edit_type, $subclasses_machine)) {
    // Taco post
    return sprintf(
      '<p class="%s"><a href="%s">Edit %s</a></p>',
      $edit_link_css_class,
      get_edit_post_link($id),
      $label
    );
  }
  
  // Find an applicable post type for editing a term
  $post_type = null;
  $post_types_by_taxonomy = array();
  foreach($subclasses as $subclass) {
    if(strpos($subclass, '\\') !== false) {
      $subclass = '\\'.$subclass;
    }
    $taxonomies = \Taco\Post\Factory::create($subclass)->getTaxonomies();
    if(Arr::iterable($taxonomies)) {
      foreach($taxonomies as $taxonomy) {
        $post_types_by_taxonomy[$taxonomy][] = $subclass;
      }
    }
  }
  $post_types_by_taxonomy = array_unique($post_types_by_taxonomy);
  if(array_key_exists($edit_type, $post_types_by_taxonomy)) {
    $post_type = reset($post_types_by_taxonomy[$edit_type]);
    $post_type = substr($post_type, strrpos($post_type, '\\'));
    $post_type = Str::camelToHuman($post_type);
    $post_type = Str::machine($post_type, '-');
  } else {
    $post_type = 'post';
  }
  
  if(is_null($id)) {
    // View taxonomy term list
    return sprintf(
      '<p class="%s"><a href="/wp-admin/edit-tags.php?taxonomy=%s&post_type=%s">View %ss</a></p>',
      $edit_link_css_class,
      $edit_type,
      $post_type,
      $label
    );
  }
  
  return sprintf(
    '<p class="%s"><a href="%s">Edit %s</a></p>',
    $edit_link_css_class,
    get_edit_term_link($id, $edit_type, $post_type),
    $label
  );
}
function get_theme_options_link($what='this') {
  if(!(is_user_logged_in() && current_user_can('manage_options'))) return null;
  
  $theme = ThemeOption::getInstance();
  return get_edit_link($theme->ID, 'theme-option', $what.' in Theme Options');
}