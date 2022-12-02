<?php
switch ($action) {
  case '':
  case 'display':
    require('./views/movies/display.php');
    break;

  case 'detail':
    require('./views/movies/movie_detail.php');
    break;

  default:
    $requestmessage='Not found your action';
    require('./views/error_display.php');
    break;
}

 ?>
