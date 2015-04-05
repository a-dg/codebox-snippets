// Sorts alphabetically by default
['d', 'a', 'b'].sort();
=> ['a', 'b', 'd']

// Does not work with a list of numbers
[2, 10, 1].sort();
=> [1, 10, 2]

// To get around this, supply a comparator
[2, 10, 1].sort(function(a, b) { return a - b; });
=> [1, 2, 10]
