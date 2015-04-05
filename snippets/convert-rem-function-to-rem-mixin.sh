# Find
^(\s*)([a-z-]+):\s*r\((.*)\);

# Replace
$1@include rem($2, $3);