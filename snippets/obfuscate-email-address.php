/**
 * Get obfuscated email link to be assembled by JS
 * @param string $link_text
 * @return string HTML
 */
function get_obfuscated_email($link_text=null) {
  $theme = ThemeOption::getInstance();
  $email = trim($theme->get('email_address'));
  if(!strlen($email)) return null;
  
  $pos_at = strpos($email, '@');
  $pos_dot = strrpos($email, '.');
  $email_part_1 = substr($email, 0, $pos_at);
  $email_part_2 = substr($email, $pos_at + 1, ($pos_dot - strlen($email_part_1)) - 1);
  $email_part_3 = substr($email, $pos_dot + 1);
  
  if(is_null($link_text)) {
    $email_letters = str_split($email);
    $link_text = join('<span>-</span>', $email_letters);
  }
  
  return sprintf(
    '<a class="obfuscated-email obfuscated" href="#" data-email-1="%s" data-email-2="%s" data-email-3="%s">%s</a>',
    $email_part_1,
    $email_part_2,
    $email_part_3,
    $link_text
  );
}
