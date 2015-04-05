[WordPress data validation](http://codex.wordpress.org/Data_Validation)

- `like_escape()`
  - `"matt's %s mom"` => `"matt's \%s mom"`

- `esc_sql()`
  - `"matt's %s mom"` => `"matt\'s %s mom"`

- `like_escape(esc_sql())`
  - `"matt's %s mom"` => `"matt\'s \%s mom"`

- `esc_sql(like_escape())` **NO!**
  - `"matt's %s mom"` => `"matt\'s \\%s mom"`

- `sanitize_title()`
  - Same as `Str::machine($string, '-')`

- `esc_html()` and `esc_attr()`
  - Encodes < > & " '

- `esc_textarea()`

- `$wpdb->prepare()`
  - Handles quotes, sanitizing, escaping
  - Expects very simple input/output format
  - Does not handle complex input like `'%s%%'` => `''stuff'%'`
