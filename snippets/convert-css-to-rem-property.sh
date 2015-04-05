# Find
^(\s*(?:left|top|width|height|background|background-image)+)\:\s?(?:r\()?([^(?:\);)]*)\)?;$

# Replace
$1: r($2);