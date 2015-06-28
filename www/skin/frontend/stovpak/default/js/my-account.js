$(document).ready(function() {
  var passwordBlock = $('.change-password-hidden');

  $('.change-password-toggle .form-checkbox').on('ifToggled',function() {
    passwordBlock.toggle();
  });

  // edit address
  $('.email-address-edit').on('click',function() {
    var editRow = $(this).parents('.edit-row').eq(0);
    editRow
      .hide()
      .next('.save-row')
        .show()
        .find('.form-text')
          .val(editRow.children('.email-address-inline').text().trim())
          .focus();
  });

  // remove address
  $('.email-address-remove').on('click',function() {
    $(this).parents('.email-addresses-item').eq(0)
      .remove();
  });

  // save address
  $('.email-address-save').on('click',function() {
    var saveRow = $(this).parents('.save-row').eq(0);
    saveRow
      .hide()
      .prev('.edit-row')
        .show()
        .children('.email-address-inline')
          .text(saveRow.find('.form-text').val());
  });
});
