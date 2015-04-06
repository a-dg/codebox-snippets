# Find
^(\s*[a-z-]+)\:\s*(?!(?:r|rr|rem|rem_round)\()(\S.*\d+p[xt].*);(\s*/{2,3}.*\S|\s*/\*.*\*/)?\s*$

# Replace
$1: r($2);$3