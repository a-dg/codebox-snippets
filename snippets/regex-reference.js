var pattern = /[^0-9.]+/g;
var contains_string = /string/.test(string_to_test);
var replaced = string.replace(/find/, 'replace');

[abc]     // A single character: a, b or c
[^abc]    // Any single character but a, b, or c
[a-z]     // Any single character in the range a-z
[a-zA-Z]  // Any single character in the range a-z or A-Z
^         // Start of line
$         // End of line
.         // Any single character
\s        // Any whitespace character
\S        // Any non-whitespace character
\d        // Any digit
\D        // Any non-digit
\w        // Any word character (letter, number, underscore)
\W        // Any non-word character
\n        // Linefeed or newline
\r        // Carriage return
\t        // Tab
\b        // Word boundary
\B        // Non-word boundary
(...)     // Capture everything enclosed
(a|b)     // a or b
a?        // Zero or one of a
a*        // Zero or more of a
a+        // One or more of a
a{3}      // Exactly 3 of a
a{3,}     // 3 or more of a
a{3,6}    // Between 3 and 6 of a
a??       // 0 or 1 of a, as few as possible
a*?       // 0 or more of a, as few as possible
a+?       // 1 or more of a, as few as possible
a{3,}?    // 3 or more of a, as few as possible
a{3,6}?   // Between 3 and 6 of a, as few as possible
a(?=b)    // Matches a when followed by b
a(?!b)    // Matches a when not followed by b

/*
  flags:
  g  global search: find all, not just first match
  i  ignore case
  m  multi-line match: treat the subject string as multiple lines (^ and $ match next to \n instead of the start or end of the entire string)
*/
