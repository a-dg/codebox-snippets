class Section extends \Taco\Post {
  public function getFields() {
    return array(
      'instructor_name_full' => array(
        'type' => 'text',
        'label' => 'Instructor Name',
        'style' => 'width: 100%;',
        'description' => 'Type any portion of the instructor name, then click the appropriate result. The instructor post must already exist for this to work. If the instructor post title changes, their correct name will appear on the front-end, but this field will not be updated automatically.',
        'class' => 'autocomplete-input',
        'data-post-type' => 'instructor',
        'autocomplete' => 'off'
      ),
      'instructor_id' => array(
        'type' => 'hidden'
      ),
    );
  }
  
  public function getRenderMetaBoxField($name, $field) {
    if(array_key_exists('autocomplete', $field)) {
      return sprintf(
        '<div class="autocomplete-container clearfix">
          %s
          <div class="autocomplete-suggestions" data-post-type="%s"></div>
        </div>',
        parent::getRenderMetaBoxField($name, $field),
        $field['data-post-type']
      );
    } else {
      return parent::getRenderMetaBoxField($name, $field);
    }
  }
}
