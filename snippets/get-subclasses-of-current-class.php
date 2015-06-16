function getSubclasses() {
  $subclasses = array();
  foreach(get_declared_classes() as $class) {
    if(is_subclass_of($class, __CLASS__)) {
      $subclasses[] = $class;
    }
  }
  return $subclasses;
}
