<?php
function displayPageHeader($page_title, $dir_level=false)
{?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title><?php echo $page_title ?></title>
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/reset.css">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.12.0/css/all.css'>
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/<?php echo $dir_level ? 'login.css' : 'config.css'?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.12.0/css/all.css'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css">
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP|Ubuntu&display=swap" rel="stylesheet">
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
      <script src='https://kit.fontawesome.com/a076d05399.js'></script>
      <script src="<?php echo FILE_URL ?>/scripts/jquery.js"></script>
      <script>
        var PAGE_URL = '<?php echo URL ?>';
        var PAGE_FILE_URL = '<?php echo FILE_URL ?>';
        var CAT_URL = '/<?php echo $_GET['controller'] ?>/';
      </script>
    </head>
    <body>
  <?php
}

function displayMainNavigation($active_page='')
{?>
  <header class="ssn-main-header">
    <!-- logo div -->
    <div class="ssn-header-logo">
      <a href="<?php echo URL ?>/"><img src="<?php echo FILE_URL ?>/logos/logo3.png" width="50px;"/></a>
    </div>

    <!-- navigation -->
    <div class="ssn-nav-list">
      <ul>
        <li class="<?php echo ($active_page == 'movies') ? "active" : "" ?>"><a <?php echo ($active_page == 'movies') ? '' : 'href="' . URL . '/movies/"' ?>>Movies</a></li>
        <li class="<?php echo ($active_page == 'series') ? "active" : "" ?>"><a <?php echo ($active_page == 'series') ? '' : 'href="' . URL . '/series/"' ?>>Series</a></li>
        <li class="<?php echo ($active_page == 'short_videos') ? "active" : "" ?>"><a <?php echo ($active_page == 'short_videos') ? '' : 'href="' . URL . '/short_videos/"' ?>>Short Videos</a></li>
        <li class="<?php echo ($active_page == 'setting') ? "active" : "" ?>"><a <?php echo ($active_page == 'setting') ? '' : 'href="' . URL . '/setting/"' ?>>Setting</a></li>
      </ul>
    </div>
    <div class="ssn-logout"><a href="<?php echo URL  ?>/setting/logout/">Log Out  <i class="fas fa-sign-out-alt"></i></a></div>
  </header>
  <?php
}

function displayPageFooter()
{?>
    </body>
  </html>
  <?php
}

 ?>
