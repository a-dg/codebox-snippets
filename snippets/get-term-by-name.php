$autogen_term = reset(
  get_terms(
    'status',
    array(
      'name__like'=>'auto-generated',
      'hide_empty'=>0
    )
  )
);
$course->setTerms(
  $autogen_term->term_id,
  'status',
  true
);
