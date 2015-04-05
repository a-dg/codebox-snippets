public function getPostTypeConfig() {
  if($this->getPostType() === 'gated-post') return null;
  
  return parent::getPostTypeConfig();
}