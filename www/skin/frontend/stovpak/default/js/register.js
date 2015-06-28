$(document).ready(function() {
  $('.designer-check')
    .on('ifChecked',function() {
      $('.register-designer-options').show();
    })
    .on('ifUnchecked',function() {
      $('.register-designer-options').hide();
    });
});
