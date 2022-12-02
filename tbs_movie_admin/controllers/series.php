<?php
  switch ($action) {
    case '':
    case 'display':
      require('./views/series/display.php');
      break;
    case 'detail':
      require('./views/series/series_detail.php');
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

    case 'create_series':
      createSeries();
      break;

    case 'update_series_text':
      updateSeriesText();
      break;

    case 'update_series_photo':
      updateSeriesPhoto();
      break;

    case 'delete_series':
      deleteSeries();
      break;

    case 'create_episode':
      createEpisode();
      break;

    case 'edit_episode':
      updateEpisode();
      break;

    case 'delete_episode':
      deleteEpisode();
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

    $category = new SeriesCategories(array(
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

    if(SeriesCategories::getSeriesCategoryByName($category->getValue('name')))
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
      header('location: ' . URL . '/series/');
    }
  }

  function editCategory()
  {
    $required_fields = array('id', 'name');
    $missing_fields = array();
    $error_messages = array();

    $category = new SeriesCategories(array(
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
      $category->updateSeriesCategoryName();
    }
  }

  function deleteCategory()
  {
    $required_fields = array('id');
    $missing_fields = array();
    $error_messages = array();

    $category = new SeriesCategories(array(
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
      $category->deleteSeriesCategory();
    }
  }

  function createSeries()
  {
    $required_fields = array('name', 'released_year', 'rate', 'unicode', 'zawgyi', 'trailer', 'photo', 'series_category_id');
    $missing_fields = array();
    $error_messages = array();

    $series = new Series(array(
      'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
      'released_year' => isset($_POST['released_year']) ? preg_replace('/[^0-9]/', '', $_POST['released_year']) : '',
      'rate' => isset($_POST['rate']) ? preg_replace('/[^.\0-9]/', '', $_POST['rate']) : '',
      'unicode' => isset($_POST['unicode']) ? $_POST['unicode'] : '',
      'zawgyi' => isset($_POST['zawgyi']) ? $_POST['zawgyi'] : '',
      'trailer' => isset($_POST['trailer']) ? $_POST['trailer'] : '',
      'photo' => isset($_FILES['itemImages']['name']) ? strip_tags($_FILES['itemImages']['name']) : '',
      'series_category_id' => isset($_POST['series_category_id']) ? preg_replace('/[^0-9]/', '', $_POST['series_category_id']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$series->getValue($required_field) )
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
      $insertedId = $series->insert();
      $tmp = $_FILES['itemImages']['tmp_name'];
      $photo_name = 'id_' . $insertedId . '_' . $_FILES['itemImages']['name'];
      move_uploaded_file($tmp, './photos/series/' . $photo_name);

      header('location: ' . URL . '/series/display/' . $series->getValue('series_category_id'));
    }
  }

  function updateSeriesText()
  {
    $required_fields = array('id', 'name', 'released_year', 'rate', 'unicode', 'zawgyi', 'trailer', 'series_category_id');
    $missing_fields = array();
    $error_messages = array();

    $series = new Series(array(
      'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
      'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
      'released_year' => isset($_POST['released_year']) ? preg_replace('/[^0-9]/', '', $_POST['released_year']) : '',
      'rate' => isset($_POST['rate']) ? preg_replace('/[^.\0-9]/', '', $_POST['rate']) : '',
      'unicode' => isset($_POST['unicode']) ? $_POST['unicode'] : '',
      'zawgyi' => isset($_POST['zawgyi']) ? $_POST['zawgyi'] : '',
      'trailer' => isset($_POST['trailer']) ? $_POST['trailer'] : '',
      'series_category_id' => isset($_POST['series_category_id']) ? preg_replace('/[^0-9]/', '', $_POST['series_category_id']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$series->getValue($required_field) )
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
      $series->updateSeriesTextInfo();
      header('location: ' . URL . '/series/detail/' . $series->getValue('id'));
    }
  }

  function updateSeriesPhoto()
  {
    $required_fields = array('id', 'photo');
    $missing_fields = array();
    $error_messages = array();

    $series = new Series(array(
      'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
      'photo' => isset($_FILES['itemImages']['name']) ? strip_tags($_FILES['itemImages']['name']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$series->getValue($required_field) )
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
      $deleteSeries = Series::getSeriesById($series->getValue('id'));
      $deletePhotoName = 'id_' . $deleteSeries->getValue('id') . '_' . $deleteSeries->getValue('photo');
      $dir = './photos/series/';
      $dirHandle = opendir($dir);
      while($file = readdir($dirHandle))
      {
        if($file === $deletePhotoName)
          unlink($dir.$file);
      }
      closedir($dirHandle);

      $tmp = $_FILES['itemImages']['tmp_name'];
      $photo_name = 'id_' . $series->getValue('id') . '_' . $_FILES['itemImages']['name'];
      move_uploaded_file($tmp, './photos/series/' . $photo_name);

      $series->updateSeriesPhoto();
      header('location: ' . URL . '/series/detail/' . $series->getValue('id'));
    }
  }

  function deleteSeries()
  {
    $required_fields = array('id');
    $missing_fields = array();
    $error_messages = array();

    $series = new Series(array(
      'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$series->getValue($required_field) )
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
      $deleteSeries = Series::getSeriesById($series->getValue('id'));
      $deletePhotoName = 'id_' . $deleteSeries->getValue('id') . '_' . $deleteSeries->getValue('photo');
      $dir = './photos/series/';
      $dirHandle = opendir($dir);
      while($file = readdir($dirHandle))
      {
        if($file === $deletePhotoName)
          unlink($dir.$file);
      }
      closedir($dirHandle);

      $series->deleteSeries();
    }
  }

  function createEpisode()
  {
    $required_fields = array('name', 'info', 'full_video', 'series_id');
    $missing_fields = array();
    $error_messages = array();

    $episode = new SeriesVideos(array(
      'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
      'info' => isset($_POST['info']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['info']) : '',
      'full_video' => isset($_POST['full_video']) ? $_POST['full_video'] : '',
      'series_id' => isset($_POST['series_id']) ? preg_replace('/[^0-9]/', '', $_POST['series_id']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$episode->getValue($required_field) )
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
      $episode->insert();
      header('location: ' . URL . '/series/detail/' . $episode->getValue('series_id'));
    }
  }

  function updateEpisode()
  {
    $required_fields = array('id', 'name', 'info', 'full_video');
    $missing_fields = array();
    $error_messages = array();

    $episode = new SeriesVideos(array(
      'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
      'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
      'info' => isset($_POST['info']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['info']) : '',
      'full_video' => isset($_POST['full_video']) ? $_POST['full_video'] : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$episode->getValue($required_field) )
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
      $episode->updateSeriesVideo();
      header('location: ' . URL . '/series/detail/' . $_POST['series_id']);
    }
  }

  function deleteEpisode()
  {
    $required_fields = array('id');
    $missing_fields = array();
    $error_messages = array();

    $episode = new SeriesVideos(array(
      'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$episode->getValue($required_field) )
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
      $episode->deleteSeriesVideo();
        header('location: ' . URL . '/series/detail/' . $_POST['series_id']);
    }
  }
 ?>
