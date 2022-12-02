<?php
switch ($action) {
  case '':
  case 'display':
    require('./views/general/display.php');
    break;
  case 'search_data':
    getSearchData();
    break;

  default:
    $requestmessage='Not found your action';
    require('./views/error_display.php');
    break;
}

function loopData($rows, $link)
{
  foreach ($rows as $row) {
    echo '<li><a href="'. URL . $link . $row->getValue('id') .'">'. $row->getValue('name') .'</a></li>';
  }
}

function getSearchData()
{
  $result = array();
  $series = Series::getAllSeries();
  loopData($series, '/series/detail/');
  $movies = Movies::getAllMovies();
  loopData($movies, '/movies/detail/');


}

 ?>
