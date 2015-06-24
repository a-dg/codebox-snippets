// These all yield the same result
$class_name = get_called_class();
$class_name = static::class;
$class_name = static();

// Instantiate
$instance = new get_called_class(); // Error
$instance = new static::class; // Error
$instance = new static();
$instance = new $class_name;
