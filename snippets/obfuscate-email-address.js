;(function($){
  var email_obfuscated_class = 'obfuscated';
  var email_data_attr_prefix = 'data-email-';
  
  $(document)
    .on('mouseenter focus click touchstart keydown', 'a.obfuscated-email.' + email_obfuscated_class, function(e){
      assemble_email(e);
    })
  ;
  
  function assemble_email(e) {
    e.stopPropagation();
    e.preventDefault();
    
    var $email_link = $(e.target);
    var email_address =
      $email_link.attr(email_data_attr_prefix + '1')
      + '@' + $email_link.attr(email_data_attr_prefix + '2')
      + '.' + $email_link.attr(email_data_attr_prefix + '3');
    var email_href = 'mailto:' + email_address;
    $email_link.attr('href', email_href).removeClass(email_obfuscated_class).removeAttr(email_data_attr_prefix + '1').find('span').remove();
    
    // Prevent having to double-tap email link on mobile
    if(e.type === 'touchstart') {
      window.location = email_href;
    }
  }
})(jQuery);
