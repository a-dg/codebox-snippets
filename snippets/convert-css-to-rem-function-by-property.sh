# Find
^(\s*(?:left|top|width|height|background|background-position|margin))\:\s*(?!(?:r|rr|rem|rem_round)\()(\S.*\d+.*);(\s*/{2,3}.*\S|\s*/\*.*\*/)?\s*$

# Replace
$1: r($2);$3