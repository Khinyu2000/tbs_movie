<?php
function displayPageHeader($page_title, $dir_level=false)
{?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $page_title ?></title>
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/reset.css">
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP|Ubuntu&display=swap" rel="stylesheet">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.12.0/css/all.css'>
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/<?php echo $dir_level ? '' : 'config.css'?>">
      <script src="<?php echo FILE_URL ?>/scripts/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script> -->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
      <link rel="stylesheet" href="<?php echo FILE_URL ?>/styles/swiper.css">
      <script src="<?php echo FILE_URL ?>/scripts/swiper.js"></script>
      <script>
        var PAGE_URL = '<?php echo URL ?>';
        var PAGE_FILE_URL = '<?php echo FILE_URL ?>';
        var EXTERNAL_URL = '<?php echo EXTERNAL_URL ?>'
        var CAT_URL = '/<?php echo $_GET['controller'] ?>/';
      </script>
      <script type="text/javascript">
      // 	$(window).on('load', function() {
    	// 	$(".spin").fadeOut("slow");;
    	// });
      $(window).on('load', function() {
    	$(".loader").fadeOut();;
    });
//       $(window).load(function(){
//      $('.loader').fadeOut();
// });
      </script>
      <style type="text/css">
    	/* body { display: block;
        position: absolute;}
    	.spin {
    	position: fixed;
    	left: 0px;
    	top: 0px;
    	width: 100%;
    	height: 100%;
    	z-index: 9999;
    	background: url(http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_11.gif) center no-repeat #000;
    } */
      </style>
    </head>
    <body>
      <!-- <div class="spin"></div> -->
      <div class="loader"></div>
  <?php
}

function displayMainNavigation($active_page='')
{
  $movies = MovieCategories::getAllMovieCategories();
  $series = SeriesCategories::getAllSeriesCategories();
  ?>
  <header class="ssn-main-header">
    <!-- logo div -->
      <header class="sn-header">
        <div class="sn-header-logo">
          <a href="<?php echo URL ?>/"><img src="<?php echo FILE_URL ?>/logos/movie.png"/></a>
        </div>
        <div class="sn-search-wrap">
          <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <input type="text" class="form-control mr-sm-2" id="myInput" onkeyup="mySearch()" placeholder="Search for names...">
            <i class="fas fa-search"></i>
            <i class="fas fa-times"></i>
          </nav>
          <ul id="myUL"></ul>
        </div>
        <div id="sn-menu-toggle">
          <div id="sn-hamburger">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div id="sn-cross">
            <span></span>
            <span></span>
          </div>
        </div>
      </header>
    <!-- navigation -->
    <div class="sn-nav-list hide">
      <ul style="padding-bottom:20px">
        <li class="<?php echo ($active_page == 'setting') ? "active" : "" ?>">
          <a <?php echo ($active_page == 'setting') ? '' : 'href="' . URL . '/general/"' ?>>General</a>
        </li>
        <li class="<?php echo ($active_page == 'short_videos') ? "active" : "" ?>">
          <a <?php echo ($active_page == 'short_videos') ? '' : 'href="' . URL . '/short_videos/"' ?>>Short Videos</a>
        </li>
        <li class="sn-movies <?php echo ($active_page == 'movies') ? "active" : "" ?>">
          <a <?php echo ($active_page == 'movies') ? '' : 'href="' . URL . '/movies/"' ?>>Movies</a>
          <i class="fas fa-sort-down sn-border"></i>
          <i class="fas fa-sort-up hide"></i>
          <ul class="sn-movies-sub-list">
            <?php foreach ($movies as $movie): ?>
              <li>
                <a href="<?php echo URL . '/movies/display/' . $movie->getValue('id') ?>"><?php echo $movie->getValue('name') ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="sn-series <?php echo ($active_page == 'series') ? "active" : "" ?>">
          <a <?php echo ($active_page == 'series') ? '' : 'href="' . URL . '/series/"' ?>>Series</a>
          <i class="fas fa-sort-down sn-border"></i>
          <i class="fas fa-sort-up hide"></i>
          <ul class="sn-series-sub-list">
            <?php foreach ($series as $series_row): ?>
              <li>
                <a href="<?php echo URL . '/series/display/' . $series_row->getValue('id') ?>"><?php echo $series_row->getValue('name') ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
      </ul>
    </div>

  </header>
   <script src="<?php echo FILE_URL ?>/scripts/header.js"></script>
  <?php
}

function displayTitleInDetail()
{?>
  <div class="ky-movie-stream-header">
    <a href="javascript:history.go(-1)"><span id="ky-video-back"><i class="fas fa-arrow-left"></i></span></a>
    <a href="<?php echo URL ?>/"><span><img src="<?php echo FILE_URL ?>/logos/movie.png"/></span></a>
  </div>
  <?php
}

function  displayNotFoundVideo()
{?>
  <div class="video-error-container">
  	<div class="video-error">
	    <span><img src="<?php echo FILE_URL ?>/logos/video_error.png"></span>
	    <span id="error-label">No video was found...</span>
	    <span id="error-back"><a href="javascript:history.go(-1)"><button>Go back</button></a></span>
    </div>
  </div>
  <?php
}

function displayPageFooter()
{?>
    </body>
  </html>
  <?php
}

 ?>
