<?php
displayPageHeader('Movies | ' . WEB_NAME);
displayMainNavigation('movies');
$movie_cats = MovieCategories::getAllMovieCategories();
 ?>
 <div class="swiper-container sn-sub-nav-container">
 <div class="swiper-wrapper sn-nav-sub-list">
     <div class="swiper-slide <?php echo ($id) ? '': 'active' ?>"><a <?php echo ($id) ? 'href="' . URL . '/movies/display/"': '' ?>>General</a></div>
     <?php foreach ($movie_cats as $movie): ?>
       <div class="swiper-slide <?php echo ($movie->getValue('id') == $id) ? 'active' : '' ?>">
         <a <?php echo ($movie->getValue('id') == $id) ? '' : 'href="' . URL . '/movies/display/' . $movie->getValue('id') . '"' ?>><?php echo $movie->getValue('name') ?></a>
       </div>
     <?php endforeach; ?>
 </div>
</div>
<?php
$start = isset( $_GET["start"] ) ? (int)$_GET["start"] : 0;

$prevStart = $start - DETAIL_ROWS;
$nextStart = $start + DETAIL_ROWS;
$isPrevEmpty = false;
$isNextExceed = false;

$numRowsInMovie = 0;
$movies = array();
if($id){
  $movies = Movies::getMoviesByMovieCategoryId($id, $start, DETAIL_ROWS);
  $numRowsInMovie = Movies::getNumRowsByMovieCategoryId($id) - 1;
}
else{
  $movies = Movies::getLimitMovies($start, DETAIL_ROWS);
  $numRowsInMovie = Movies::getNumRows() - 1;
}
if($nextStart > $numRowsInMovie)
  $isNextExceed = true;

if($prevStart < 0)
  $isPrevEmpty = true;

if($movies):
 ?>
 <div class="wp-general-container wp-movie-container">
	<div class="wp-general-details-container">
    <?php foreach ($movies as $movie): ?>
      <div class="wp-detail-container">
        <a href="<?php echo URL . '/movies/detail/' . $movie->getValue('id') ?>">
          <div class="wp-general-detail-image">
            <img src="<?php echo EXTERNAL_URL . '/photos/movies/id_' . $movie->getValue('id'). '_' . $movie->getValue('photo') ?>" alt="<?php echo $movie->getValue('name') ?>">
          </div>
          <div class="wp-general-details">
            <div id="general-label"><?php echo $movie->getValue('name') ?></div>
            <div class="general-rating-container">
              <span id="general-rating"><i class="fas fa-star"></i><?php echo $movie->getValue('rate') ?></span>
              <span id="general-series"></span>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
	</div>
	<div class="wp-general-buttons">
    <?php if($isPrevEmpty): ?>
      <a class="not-active"><span><i class="fas fa-angle-left"></i></span></a>
    <?php else: ?>
      <a href="<?php echo URL . '/movies/display/'. $id .'?start=' . $prevStart ?>"><span><i class="fas fa-angle-left"></i></span></a>
    <?php endif; ?>

    <?php if($isNextExceed): ?>
      <a class="not-active"><span><i class="fas fa-angle-right"></i></span></a>
    <?php else: ?>
      <a href="<?php echo URL . '/movies/display/'. $id .'?start=' . $nextStart ?>"><span><i class="fas fa-angle-right"></i></span></a>
    <?php endif; ?>
	</div>
</div>
<?php else: ?>
  <div class="category-error-container">
  <div class="category-error">
    <div id="category-arrow">
      <svg width="34" height="151" viewBox="0 0 34 151" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.5 20C-3.7 69.6 19.8333 127.667 34 150.5C-7.99998 101.7 -1.16666 41.1667 7.5 17L0 13.5L18.5 0L24.5 24L15.5 20Z" fill="#00CED1"/>
        <path d="M15.5 20C-3.7 69.6 19.8333 127.667 34 150.5C-7.99998 101.7 -1.16666 41.1667 7.5 17L0 13.5L18.5 0L24.5 24L15.5 20Z" fill="url(#paint0_linear)"/>
        <path d="M17.5 23C-2.10001 65 20.3333 125.5 34 150.5C-1.60001 88.1 6.83333 37.5 15.5 20L24.5 24L18.5 0H20L27 27L17.5 23Z" fill="#2F2F2F"/>
        <defs>
        <linearGradient id="paint0_linear" x1="34" y1="151" x2="18.5" y2="3.26603e-06" gradientUnits="userSpaceOnUse">
        <stop stop-color="#181A20"/>
        <stop offset="0.619792" stop-color="white" stop-opacity="0"/>
        </linearGradient>
        </defs>
      </svg>
      <span id="show-arrow"></span>
    </div>
    <span id="category-error-message">Please select a category...</span>
  </div>
  </div>
<?php endif; ?>
<script src="<?php echo FILE_URL ?>/scripts/movie.js"></script>
 <?php
displayPageFooter();
  ?>
