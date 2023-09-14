
$('#confirm_password').on('keyup', function() {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Password matched').css('color', 'green');
    $('.submit_password').removeAttr('disabled');
  } else {
    $('#message').html('Password mismatched').css('color', 'red');
    $('.submit_password').attr('disabled', 'disabled');
  }
});
