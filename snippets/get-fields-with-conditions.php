public function getFields() {
  $fields = array(
    'image_path'=>array('type'=>'image'),
  );
  
  // Only Pages under the Events landing page
  // will see the related_event_id field
  $fields['related_event_id'] = ($this->post_parent == POST_ID_EVENTS)
    ? array('type'=>'select', 'options'=>Event::getPairs())
    : array('type'=>'hidden');
  
  return array_merge(
    parent::getFields(),
    $fields
  );
}
