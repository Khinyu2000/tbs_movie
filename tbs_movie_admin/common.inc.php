<?php
require('./config.php');
require('./models/DataObject.class.php');
require('./models/AdminAccount.class.php');
require('./htmlstructureconfig.php');
session_start();

$controller = $_GET['controller'];
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

function checkAuthentication()
{
  if(!$_SESSION["admin_account"] or !$_SESSION["admin_account"] = AdminAccount::getAdminAccountById($_SESSION["admin_account"]->getValue( "id" )))
  {
    $_SESSION['admin_account'] = '';
    header('location: ' . URL . '/views/login.php');
    exit;
  }
}

#Loading model
switch ($controller)
{
  case 'movies':
    checkAuthentication();
    require('./models/Movies.class.php');
    require('./models/MovieViewers.class.php');
    require('./models/MovieCategories.class.php');
    break;

  case 'series':
    checkAuthentication();
    require('./models/Series.class.php');
    require('./models/SeriesVideos.class.php');
    require('./models/SeriesEpisodeViewers.class.php');
    require('./models/SeriesCategories.class.php');
    break;

  case 'short_videos':
    checkAuthentication();
    require('./models/ShortVideos.class.php');
    require('./models/ShortVideoViewers.class.php');
    require('./models/ShortVideoCategories.class.php');
    break;

  case 'setting':
    if ($action == 'logout')
    {
        $_SESSION['admin_account'] = '';
        header('location:' . URL . '/views/login.php');
        exit();
    }
    checkAuthentication();
    break;

  default:
    $requestmessage='Not found your request';
    require('./views/error_display.php');
}

#Loading controller
  $controller = "./controllers/${controller}.php";
  if(file_exists($controller) and !is_dir($controller))
    require($controller);
  else
    exit("models -> ${controller} not found");
 ?>
