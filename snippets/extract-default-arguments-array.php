$default_args = array(
  'max_pages' => 5,
  'per_page' => 10,
  'link_prefix' => null,
  'previous_label' => '&hellip;',
  'next_label' => '&hellip;',
  'is_ajax' => false,
);
$args = (Arr::iterable($args))
  ? array_merge($default_args, $args)
  : $default_args;
extract($args);
