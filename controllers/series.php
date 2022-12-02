<?php
  switch ($action) {
    case '':
    case 'display':
      require('./views/series/display.php');
      break;
    case 'detail':
      require('./views/series/series_detail.php');
      break;

    default:
      $requestmessage='Not found your action';
      require('./views/error_display.php');
      break;
  }
  
 ?>
