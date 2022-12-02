<?php
  switch ($action) {
    case '':
    case 'display':
      require('./views/setting/display.php');
      break;
    case 'change_account':
      changeAccount();
      break;

    default:
      $requestmessage='Not found your action';
      require('./views/error_display.php');
      break;
  }
function changeAccount()
{
  $request_account = new AdminAccount(array(
    'username' => isset($_POST['current_username']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['current_username']) : '',
    'password' => isset($_POST['current_password']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['current_password']) : ''
  ));

  $current_account = $request_account->authenticateAdminAccount();

  if($current_account)
  {
    $required_fields = array('username', 'password');
    $missing_fields = array();
    $error_messages = array();

    $new_account = new AdminAccount(array(
      'username' => isset($_POST['new_username']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['new_username']) : '',
      'password' => ( isset($_POST['new_password1']) and isset($_POST['new_password2']) and $_POST['new_password1'] == $_POST['new_password2']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['new_password1']) : ''
    ));
    foreach($required_fields as $required_field)
    {
      if(!$new_account->getValue($required_field) )
        $missing_fields[] = $required_field;
    }

    if($missing_fields)
    {
      $error_messages[] = 'Some missing in current field. Make sure that and submit again';
    }

    if(!isset($_POST['new_password1']) or !isset($_POST['new_password2']) or !$_POST['new_password1'] or !$_POST['new_password2'] or $_POST['new_password1'] != $_POST['new_password2'])
    {
      $error_messages[] = 'Make sure you enter your password correctly in both password fields';
    }

    if($error_messages)
    {
      require('./views/error_display.php');
    }
    else
    {
      $new_account->updateAdminAccount($current_account->getValue('id'));
    }

  }
  else
  {
    $error_messages = array();
    $error_messages[] = 'Current username and/or password are not correct.';
    $error_messages[] = 'Please make sure and submit again';
    require('./views/error_display.php');
  }

}
 ?>
