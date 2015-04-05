$text_with_shortcode = '[short code="blah"] regular text';
$text = preg_replace('/\[(.+?)\](.+?\[/\\1\])?/s', '', $text_with_shortcode);
