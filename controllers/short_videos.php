<?php
  switch ($action) {
    case '':
    case 'display':
      require('./views/short_videos/display.php');
      break;

    case 'detail':
      require('./views/short_videos/short_video_detail.php');
      break;

    default:
      $requestmessage='Not found your action';
      require('./views/error_display.php');
      break;
  }

 ?>
