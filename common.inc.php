<?php
require('./config.php');
require('./models/DataObject.class.php');
require('./htmlstructureconfig.php');

$controller = $_GET['controller'];
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

require('./models/MovieCategories.class.php');
require('./models/SeriesCategories.class.php');
#Loading model
switch ($controller)
{
  case 'general':
    require('./models/Movies.class.php');
    require('./models/Series.class.php');
    require('./models/ShortVideos.class.php');
    require('./models/ShortVideoCategories.class.php');
    break;

  case 'movies':
    require('./models/Movies.class.php');
    require('./models/MovieViewers.class.php');
    break;

  case 'series':
    require('./models/Series.class.php');
    require('./models/SeriesVideos.class.php');
    require('./models/SeriesEpisodeViewers.class.php');
    break;

  case 'short_videos':
    require('./models/ShortVideos.class.php');
    require('./models/ShortVideoViewers.class.php');
    require('./models/ShortVideoCategories.class.php');
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
