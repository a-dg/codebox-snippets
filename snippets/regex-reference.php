$pattern = '/^[\+-]{3}/i';

[abc]     // A single character: a, b or c
[^abc]    // Any single character but a, b, or c
[a-z]     // Any single character in the range a-z
[a-zA-Z]  // Any single character in the range a-z or A-Z
^         // Start of line
$         // End of line
.         // Any single character
\A        // Start of string
\z        // End of string
\s        // Any whitespace character
\S        // Any non-whitespace character
\d        // Any digit
\D        // Any non-digit
\w        // Any word character (letter, number, underscore)
\W        // Any non-word character
\b        // Any word boundary character
(...)     // Capture everything enclosed
(a|b)     // a or b
a?        // Zero or one of a
a*        // Zero or more of a
a+        // One or more of a
a{3}      // Exactly 3 of a
a{3,}     // 3 or more of a
a{3,6}    // Between 3 and 6 of a
(.*?)     // ungreedy
(?:http)  // non-capture flag (treat http as string
          // instead of individual characters, but
          // don't capture the group

/*
  options:
  i  case insensitive
  s  treat everything as a single line (multi-line)
  m  make dot match newlines
  x  ignore whitespace in regex
  o  perform #{...} substitutions only once
  U  ungreedy (inverted by ?)
*/
