<?php
switch ($action) {
  case '':
  case 'display':
    require('./views/movies/display.php');
    break;

  case 'detail':
    require('./views/movies/movie_detail.php');
    break;

  case 'create_category':
    createCategory();
    break;

  case 'edit_category':
    editCategory();
    break;

  case 'delete_category':
    deleteCategory();
    break;

  case 'create_movie':
    createMovie();
    break;

  case 'update_movie_text':
    updateMovieText();
    break;

  case 'update_movie_photo':
    updateMoviePhoto();
    break;

  case 'delete_movie':
    deleteMovie();
    break;

  default:
    $requestmessage='Not found your action';
    require('./views/error_display.php');
    break;
}

function createCategory()
{
  $required_fields = array('name');
  $missing_fields = array();
  $error_messages = array();

  $category = new MovieCategories(array(
    'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if(!$category->getValue($required_field) )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = 'Please fill the category name.';
  }

  if(MovieCategories::getMovieCategoryByName($category->getValue('name')))
  {
    $error_messages[] = 'A category with that name already exists in the database. Please choose another name.';
  }

  if($error_messages)
  {
    require('./views/error_display.php');
  }
  else
  {
    $category->insert();
    header('location: ' . URL . '/movies/');
  }
}

function editCategory()
{
  $required_fields = array('id', 'name');
  $missing_fields = array();
  $error_messages = array();

  $category = new MovieCategories(array(
    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
    'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if(!$category->getValue($required_field) )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = 'Please fill the category name and related Id';
  }

  if($error_messages)
  {
    require('./views/error_display.php');
  }
  else
  {
    $category->updateMovieCategoryName();
  }
}

function deleteCategory()
{
  $required_fields = array('id');
  $missing_fields = array();
  $error_messages = array();

  $category = new MovieCategories(array(
    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if(!$category->getValue($required_field) )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = 'Invalid request category.';
  }

  if($error_messages)
  {
    require('./views/error_display.php');
  }
  else
  {
    $category->deleteMovieCategory();
  }
}

function createMovie()
{
  $required_fields = array('name', 'released_year', 'rate', 'unicode', 'zawgyi', 'full_video', 'trailer', 'photo', 'movie_category_id');
  $missing_fields = array();
  $error_messages = array();

  $movie = new Movies(array(
    'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
    'released_year' => isset($_POST['released_year']) ? preg_replace('/[^0-9]/', '', $_POST['released_year']) : '',
    'rate' => isset($_POST['rate']) ? preg_replace('/[^.\0-9]/', '', $_POST['rate']) : '',
    'unicode' => isset($_POST['unicode']) ? $_POST['unicode'] : '',
    'zawgyi' => isset($_POST['zawgyi']) ? $_POST['zawgyi'] : '',
    'full_video' => isset($_POST['full_video']) ? $_POST['full_video'] : '',
    'trailer' => isset($_POST['trailer']) ? $_POST['trailer'] : '',
    'photo' => isset($_FILES['itemImages']['name']) ? strip_tags($_FILES['itemImages']['name']) : '',
    'movie_category_id' => isset($_POST['movie_category_id']) ? preg_replace('/[^0-9]/', '', $_POST['movie_category_id']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if(!$movie->getValue($required_field) )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = 'Please fill all the required information';
  }

  if($error_messages)
  {
    require('./views/error_display.php');
  }
  else
  {
    $insertedId = $movie->insert();
    $tmp = $_FILES['itemImages']['tmp_name'];
    $photo_name = 'id_' . $insertedId . '_' . $_FILES['itemImages']['name'];
    move_uploaded_file($tmp, './photos/movies/' . $photo_name);

    header('location: ' . URL . '/movies/display/' . $movie->getValue('movie_category_id'));
  }
}

function updateMovieText()
{
  $required_fields = array('id', 'name', 'released_year', 'rate', 'unicode', 'zawgyi', 'full_video', 'trailer', 'movie_category_id');
  $missing_fields = array();
  $error_messages = array();

  $movie = new Movies(array(
    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
    'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
    'released_year' => isset($_POST['released_year']) ? preg_replace('/[^0-9]/', '', $_POST['released_year']) : '',
    'rate' => isset($_POST['rate']) ? preg_replace('/[^.\0-9]/', '', $_POST['rate']) : '',
    'unicode' => isset($_POST['unicode']) ? $_POST['unicode'] : '',
    'zawgyi' => isset($_POST['zawgyi']) ? $_POST['zawgyi'] : '',
    'full_video' => isset($_POST['full_video']) ? $_POST['full_video'] : '',
    'trailer' => isset($_POST['trailer']) ? $_POST['trailer'] : '',
    'movie_category_id' => isset($_POST['movie_category_id']) ? preg_replace('/[^0-9]/', '', $_POST['movie_category_id']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if(!$movie->getValue($required_field) )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = 'Please fill all the required information';
  }

  if($error_messages)
  {
    require('./views/error_display.php');
  }
  else
  {
    $movie->updateMovieTextInfo();
    header('location: ' . URL . '/movies/detail/' . $movie->getValue('id'));
  }
}

function updateMoviePhoto()
{
  $required_fields = array('id', 'photo');
  $missing_fields = array();
  $error_messages = array();

  $movie = new Movies(array(
    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
    'photo' => isset($_FILES['itemImages']['name']) ? strip_tags($_FILES['itemImages']['name']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if(!$movie->getValue($required_field) )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = 'Please fill all the required information';
  }

  if($error_messages)
  {
    require('./views/error_display.php');
  }
  else
  {
    $deleteMovie = Movies::getMovieById($movie->getValue('id'));
    $deletePhotoName = 'id_' . $deleteMovie->getValue('id') . '_' . $deleteMovie->getValue('photo');
    $dir = './photos/movies/';
    $dirHandle = opendir($dir);
    while($file = readdir($dirHandle))
    {
      if($file === $deletePhotoName)
        unlink($dir.$file);
    }
    closedir($dirHandle);

    $tmp = $_FILES['itemImages']['tmp_name'];
    $photo_name = 'id_' . $movie->getValue('id') . '_' . $_FILES['itemImages']['name'];
    move_uploaded_file($tmp, './photos/movies/' . $photo_name);
    $movie->updateMoviePhoto();

    header('location: ' . URL . '/movies/detail/' . $movie->getValue('id'));
  }
}

function deleteMovie()
{
  $required_fields = array('id');
  $missing_fields = array();
  $error_messages = array();

  $movie = new Movies(array(
    'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : ''
  ));

  foreach($required_fields as $required_field)
  {
    if(!$movie->getValue($required_field) )
      $missing_fields[] = $required_field;
  }

  if($missing_fields)
  {
    $error_messages[] = 'Invalid request movie Id.';
  }

  if($error_messages)
  {
    require('./views/error_display.php');
  }
  else
  {
    $deleteMovie = Movies::getMovieById($movie->getValue('id'));
    $deletePhotoName = 'id_' . $deleteMovie->getValue('id') . '_' . $deleteMovie->getValue('photo');
    $dir = './photos/movies/';
    $dirHandle = opendir($dir);
    while($file = readdir($dirHandle))
    {
      if($file === $deletePhotoName)
        unlink($dir.$file);
    }
    closedir($dirHandle);

    $movie->deleteMovie();
  }
}
 ?>
