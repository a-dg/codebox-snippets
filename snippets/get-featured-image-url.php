if(has_post_thumbnail($post->ID)) {
  $attachment_id = get_post_thumbnail_id($post->ID);
  $image = wp_get_attachment_image_src($attachment_id, 'size');
  $image_url = $image[0];
}
