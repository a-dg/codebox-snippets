# Find
^(\s*(?:left|right|top|bottom|margin|margin-left|margin-right|margin-top|margin-bottom|padding|padding-left|padding-right|padding-top|padding-bottom|width|height|min-width|min-height|max-width|max-height|border|border-left|border-right|border-top|border-bottom|border-width|border-left-width|border-right-width|border-top-width|border-bottom-width|background-position|background-size|box-shadow|font-size|line-height|letter-spacing|word-spacing|text-indent|text-shadow|marker-offset))\:\s*(?!(?:r|rr|rem|rem_round)\()(\S.*\d+.*);(\s*/{2,3}.*\S|\s*/\*.*\*/)?\s*$

# Replace
$1: r($2);$3