/**
 * Get pagination
 * $args contains arguments for both wrapper and page numbers
 * @param int $current_page
 * @param int $total_posts
 * @param array $args
 * Wrapper:
 * - string $label
 * - string $container_class
 * Page numbers:
 * - int $max_pages
 * - int $per_page
 * - string $link_prefix
 * - string $previous_label
 * - string $next_label
 * - bool $is_ajax
 * Both wrapper and page numbers:
 * - bool $is_select
 * @return string HTML
 */
public static function getPagination($current_page, $total_posts, $args=array()) {
  $default_args = array(
    'label' => 'Page:',
    'container_class' => 'page-numbers clearfix',
    'is_select' => false,
  );
  $args = (Arr::iterable($args))
    ? array_merge($default_args, $args)
    : $default_args;
  extract($args);
  
  $label = (strlen($label)) ? '<p>'.$label.'</p>' : null;
  $list_element = ($is_select) ? 'select' : 'ul';
  $pagination = self::getPaginationItems($current_page, $total_posts, $args);
  if(is_null($pagination)) return null;
  
  return sprintf(
    '<div class="%s">
      %s
      <%s>
        %s
      </%s>
    </div>',
    $container_class,
    $label,
    $list_element,
    $pagination,
    $list_element
  );
}


/**
 * Get page numbers for pagination, either as links or option elements
 * @param int $current_page
 * @param int $total_posts
 * @param array $args
 * - int $max_pages
 * - int $per_page
 * - string $link_prefix
 * - string $previous_label
 * - string $next_label
 * - bool $is_ajax
 * - bool $is_select
 * @return string HTML
 */
public static function getPaginationItems($current_page, $total_posts, $args=array()) {
  if(is_null($current_page) || is_null($total_posts)) return null;
  
  $default_args = array(
    'max_pages' => 5,
    'per_page' => 10,
    'link_prefix' => null,
    'previous_label' => 'Previous',
    'next_label' => 'Next',
    'is_ajax' => false,
    'is_select' => false,
  );
  $args = (Arr::iterable($args))
    ? array_merge($default_args, $args)
    : $default_args;
  extract($args);
  
  if($total_posts <= $per_page) return null;
  
  $pagination = array();
  $page_count = (int) ceil($total_posts / $per_page);
  
  if($is_select) {
    $options = array();
    for($i = 1; $i <= $page_count; $i++) {
      $current_page_attr = ($i == $current_page)
        ? ' selected'
        : null;
      $page_number_value = (!$is_ajax)
        ? $link_prefix.$i.'/'
        : $i;
      $options[] = sprintf(
        '<option%s value="%s" data-page="%d">%d</option>',
        $current_page_attr,
        $page_number_value,
        $i,
        $i
      );
    }
    return join("\n", $options);
  }
  
  // Set first and last page numbers to be displayed
  // between "previous" and "next" links
  $first_page_number = ($max_pages < $page_count)
    ? (int) max($current_page - floor($max_pages / 2), 1)
    : 1;
  $last_page_number = (int) min($first_page_number + ($max_pages - 1), $page_count);
  
  // Evaluate first page number again, for when
  // one of the last pages is selected
  $first_page_number = ($max_pages < $page_count)
    ? (int) min($first_page_number, $last_page_number - ($max_pages - 1))
    : $first_page_number;
  
  if(!$is_ajax) {
    $link_prefix = $link_prefix.'/page/';
    $link_prefix = preg_replace('/\/{2,}/', '/', $link_prefix);
  }
  
  // Previous link
  if($current_page !== 1) {
    $previous_link = (!$is_ajax)
      ? $link_prefix.($current_page - 1).'/'
      : '#';
    $pagination[] = sprintf(
      '<li class="prev" data-page="%d"><a href="%s">%s</a></li>',
      ($current_page - 1),
      $previous_link,
      $previous_label
    );
  }
  
  // Page 1
  if($first_page_number !== 1) {
    $page_number_link = (!$is_ajax)
      ? $link_prefix.'1/'
      : '#';
    $pagination[] = sprintf(
      '<li data-page="1"><a href="%s">1</a></li>',
      $page_number_link
    );
  }
  
  // Dots after page 1
  if($first_page_number > 2) {
    $pagination[] = '<li class="dots">&hellip;</li>';
  }
  
  // Page number links
  for($i = $first_page_number; $i <= $last_page_number; $i++) {
    $current_page_class = ($i == $current_page)
      ? ' class="on"'
      : null;
    $page_number_link = (!$is_ajax)
      ? $link_prefix.$i.'/'
      : '#';
    $pagination[] = sprintf(
      '<li%s data-page="%d"><a href="%s">%d</a></li>',
      $current_page_class,
      $i,
      $page_number_link,
      $i
    );
  }
  
  // Dots before last page
  if($last_page_number < $page_count - 1) {
    $pagination[] = '<li class="dots">&hellip;</li>';
  }
  
  // Last page
  if($last_page_number !== $page_count) {
    $page_number_link = (!$is_ajax)
      ? $link_prefix.$page_count.'/'
      : '#';
    $pagination[] = sprintf(
      '<li data-page="%d"><a href="%s">%d</a></li>',
      $page_count,
      $page_number_link,
      $page_count
    );
  }
  
  // Next link
  if($current_page !== $page_count) {
    $next_link = (!$is_ajax)
      ? $link_prefix.($current_page + 1).'/'
      : '#';
    $pagination[] = sprintf(
      '<li class="next" data-page="%d"><a href="%s">%s</a>',
      ($current_page + 1),
      $next_link,
      $next_label
    );
  }
  
  return join("\n", $pagination);
}
