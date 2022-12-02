<?php
require('../config.php');
require('../htmlstructureconfig.php');
require('../models/DataObject.class.php');
require('../models/AdminAccount.class.php');
session_start();

if ( isset( $_POST['action'] ) and $_POST['action'] == 'login' )
{
  processLoginForm();
}
else {
  displayLoginFrom(array(), new AdminAccount(array()));
}

function displayLoginFrom($error_messages, $admin_account)
{
  displayPageHeader('Login | ' . WEB_NAME, true);
  ?>
  <section class="wp-login-container">

  	<header class="wp-login-header">
  		<span><img src="<?php echo FILE_URL ?>/logos/tape.png"></span>
  		<h1>LOGIN</h1>
  	</header>
  	<section class="wp-login-form-container">
  		<div id="error">
        <?php
        if($error_messages)
        {
          foreach($error_messages as $error_message)
            echo $error_message;
        }
        else
        {
          echo '<p class="error">Welcome to the best shop!</p>';
        }
        ?>
      </div>
  		<form action="<?php echo URL ?>/views/login.php" method="post">
        <input type="hidden" name="action" value="login" />
  			<div class="wp-login-input">
  				<input type="text" name="username" placeholder="Username" id="uname" value="<?php echo isset($admin_account) ? $admin_account->getValueEncoded('username') : '' ?>">
  			</div>

  			<div class="wp-login-input">
  				<input type="password" name="password" placeholder="Password" id="pass">
  				<span id="show-pass"><i class="far fa-eye-slash"></i></span>
  			</div>
  			<input type="submit" name="" value="Login">
  		</form>
  	</section>
  </section>

  <script type="text/javascript">
  	$(function(){

  		$('#uname').focus();

      $show = $('#show-pass i');
      $password = $('#pass');

  		$('#show-pass').click(function(){
  			if($password.attr('type') == 'password'){
  				$password.attr('type', 'text');
          $password.focus();
          $show.removeClass('fa-eye-slash');
          $show.addClass('fa-eye');
  			}else{
  				$password.attr('type', 'password');
          $password.focus();
          $show.removeClass('fa-eye');
          $show.addClass('fa-eye-slash');
  			}
  		});

      $('#pass').keydown(function(e){
        if(e.which == 115){
          $password.attr('type', 'text');
          $password.focus();
          $show.removeClass('fa-eye-slash');
          $show.addClass('fa-eye');
        }
      });

      $('#pass').keyup(function(e){
        if(e.which == 115){
          $password.attr('type', 'password');
          $password.focus();
          $show.addClass('fa-eye-slash');
          $show.removeClass('fa-eye');
        }
      });
  	});
  </script>
  <?php
  displayPageFooter();
}

function processLoginForm()
{
  $required_fields = array('username', 'password');
  $missing_fields = array();
  $error_messages = array();

  $admin_account = new AdminAccount(array(
    'username' => isset($_POST['username']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['username']) : '',
    'password' => isset($_POST['password']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['password']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if(!$admin_account->getValue($required_field) )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = '<p class="error">Please complete all fields below.</p>';
  }
  elseif(!$loggedin_account = $admin_account->authenticateAdminAccount())
  {
    $error_messages[] = '<p class="error">Please check your username and password, and try again.</p>';
  }

  if($error_messages)
  {
    displayLoginFrom($error_messages, $admin_account);
  }
  else
  {
    $_SESSION['admin_account'] = $loggedin_account;
    header('location: ' . URL . '/movies/');
  }

}
 ?>
