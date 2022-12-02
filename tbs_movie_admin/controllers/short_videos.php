<?php
  switch ($action) {
    case '':
    case 'display':
      require('./views/short_videos/display.php');
      break;

    case 'detail':
      require('./views/short_videos/short_video_detail.php');
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

    case 'create_short_video':
      createShortVideo();
      break;

    case 'update_short_video_text':
      updateShortVideoText();
      break;

    case 'update_short_video_photo':
      updateShortVideoPhoto();
      break;

    case 'delete_short_video':
      deleteShortVideo();
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

    $category = new ShortVideoCategories(array(
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

    if(ShortVideoCategories::getShortVideoCategoryByName($category->getValue('name')))
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
      header('location: ' . URL . '/short_videos/');
    }
  }

  function editCategory()
  {
    $required_fields = array('id', 'name');
    $missing_fields = array();
    $error_messages = array();

    $category = new ShortVideoCategories(array(
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
      $category->updateShortVideoCategoryName();
    }
  }

  function deleteCategory()
  {
    $required_fields = array('id');
    $missing_fields = array();
    $error_messages = array();

    $category = new ShortVideoCategories(array(
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
      $category->deleteShortVideoCategory();
    }
  }

  function createShortVideo()
  {
    $required_fields = array('name', 'unicode', 'zawgyi', 'full_video', 'photo', 'short_video_category_id');
    $missing_fields = array();
    $error_messages = array();

    $short_video = new ShortVideos(array(
      'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
      'full_video' => isset($_POST['full_video']) ? $_POST['full_video'] : '',
      'unicode' => isset($_POST['unicode']) ? $_POST['unicode'] : '',
      'zawgyi' => isset($_POST['zawgyi']) ? $_POST['zawgyi'] : '',
      'photo' => isset($_FILES['itemImages']['name']) ? strip_tags($_FILES['itemImages']['name']) : '',
      'short_video_category_id' => isset($_POST['short_video_category_id']) ? preg_replace('/[^0-9]/', '', $_POST['short_video_category_id']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$short_video->getValue($required_field) )
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
      $insertedId = $short_video->insert();
      $tmp = $_FILES['itemImages']['tmp_name'];
      $photo_name = 'id_' . $insertedId . '_' . $_FILES['itemImages']['name'];
      move_uploaded_file($tmp, './photos/short_videos/' . $photo_name);

      header('location: ' . URL . '/short_videos/display/' . $short_video->getValue('short_video_category_id'));
    }
  }

  function updateShortVideoText()
  {
    $required_fields = array('id', 'name', 'unicode', 'zawgyi', 'full_video', 'short_video_category_id');
    $missing_fields = array();
    $error_messages = array();

    $short_video = new ShortVideos(array(
      'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
      'name' => isset($_POST['name']) ? preg_replace('/[^ \-\_a-zA-Z0-9]/', '', $_POST['name']) : '',
      'full_video' => isset($_POST['full_video']) ? $_POST['full_video'] : '',
      'unicode' => isset($_POST['unicode']) ? $_POST['unicode'] : '',
      'zawgyi' => isset($_POST['zawgyi']) ? $_POST['zawgyi'] : '',
      'short_video_category_id' => isset($_POST['short_video_category_id']) ? preg_replace('/[^0-9]/', '', $_POST['short_video_category_id']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$short_video->getValue($required_field) )
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
      $short_video->updateShortVideoTextInfo();
      header('location: ' . URL . '/short_videos/detail/' . $short_video->getValue('id'));
    }
  }

  function updateShortVideoPhoto()
  {
    $required_fields = array('id', 'photo');
    $missing_fields = array();
    $error_messages = array();

    $short_video = new ShortVideos(array(
      'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : '',
      'photo' => isset($_FILES['itemImages']['name']) ? strip_tags($_FILES['itemImages']['name']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$short_video->getValue($required_field) )
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
      $deleteMovie = ShortVideos::getShortVideoById($short_video->getValue('id'));
      $deletePhotoName = 'id_' . $deleteMovie->getValue('id') . '_' . $deleteMovie->getValue('photo');
      $dir = './photos/short_videos/';
      $dirHandle = opendir($dir);
      while($file = readdir($dirHandle))
      {
        if($file === $deletePhotoName)
          unlink($dir.$file);
      }
      closedir($dirHandle);

      $tmp = $_FILES['itemImages']['tmp_name'];
      $photo_name = 'id_' . $short_video->getValue('id') . '_' . $_FILES['itemImages']['name'];
      move_uploaded_file($tmp, './photos/short_videos/' . $photo_name);

      $short_video->updateShortVideoPhoto();
      header('location: ' . URL . '/short_videos/detail/' . $short_video->getValue('id'));
    }
  }

  function deleteShortVideo()
  {
    $required_fields = array('id');
    $missing_fields = array();
    $error_messages = array();

    $short_video = new ShortVideos(array(
      'id' => isset($_POST['id']) ? preg_replace('/[^0-9]/', '', $_POST['id']) : ''
    ));

    foreach($required_fields as $required_field)
    {
      if(!$short_video->getValue($required_field) )
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
      $deleteMovie = ShortVideos::getShortVideoById($short_video->getValue('id'));
      $deletePhotoName = 'id_' . $deleteMovie->getValue('id') . '_' . $deleteMovie->getValue('photo');
      $dir = './photos/short_videos/';
      $dirHandle = opendir($dir);
      while($file = readdir($dirHandle))
      {
        if($file === $deletePhotoName)
          unlink($dir.$file);
      }
      closedir($dirHandle);

      $short_video->deleteShortVideo();
    }
  }

 ?>
