/**
 * Prevent short words from being displayed alone on the last line
 * @param string $text
 * @param int $min_last_word_length
 * @return string HTML
 */
public static function adoptOrphans($text, $min_last_word_length=8) {
  $text = trim(preg_replace('/(\s|&nbsp;)+/', ' ', $text));
  if(strlen($text) <= $min_last_word_length) return $text;
  
  $all_words = explode(' ', $text);
  $word_count = count($all_words);
  for($i = 0; $i < $word_count; $i++) {
    $word = $all_words[$i];
    if(strpos($word, '-') === false) continue;
    
    // If any hyphenated word starts or ends with a one- or two-letter
    // segment, replace hyphens with non-breaking hyphens
    $word_segments = explode('-', $word);
    if(
      strlen(current($word_segments)) <= 2
      || strlen(end($word_segments)) <= 2
    ) {
      array_splice($all_words, $i, 1, str_replace('-', '&#8209;', $word));
    }
  }
  
  $all_words = join(' ', $all_words);
  $new_text = substr($all_words, 0, strlen($all_words) - $min_last_word_length);
  $new_text .= str_replace(' ', '&nbsp;', substr($all_words, strlen($all_words) - $min_last_word_length));
  
  return $new_text;
}