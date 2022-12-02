<?php
displayPageHeader('General | ' . WEB_NAME);
displayMainNavigation('general');
$start = isset( $_GET["start"] ) ? (int)$_GET["start"] : 0;

$prevStart = $start - GENERAL_ROWS;
$nextStart = $start + GENERAL_ROWS;
$isPrevEmpty = false;
$isNextExceed = false;
$numRowsInMovie = Movies::getNumRows() - 1;
$numRowsInSeries = Series::getNumRows() - 1;

if($nextStart > $numRowsInMovie AND $nextStart > $numRowsInSeries)
  $isNextExceed = true;

if($prevStart < 0)
  $isPrevEmpty = true;

$short_videos = ShortVideos::getLimitShortVideos(0, 5);
$movies = Movies::getLimitMovies($start, GENERAL_ROWS);
$series = Series::getLimitSeries($start, GENERAL_ROWS);
 ?>
<div class="wp-short-video-container">
	<div class="wp-short-video-header">
		<div class="wp-short-video-label">
			<span><i class="fas fa-video"></i></span>
			<span><a href="<?php echo URL ?>/short_videos/display/">short videos</a></span>
		</div>
		<div class="wp-short-video-nav">
			<span class="swiper-button-prev short-video-prev"><i class="fas fa-angle-left"></i></span>
			<span class="swiper-button-next short-video-next"><i class="fas fa-angle-right"></i></span>
		</div>
	</div>

	<div class="swiper-container wp-short-video-detail-container">
	    <div class="swiper-wrapper wp-short-video-detail">
        <?php foreach ($short_videos as $short_video): ?>
          <div class="swiper-slide">
            <a href="<?php echo URL . '/short_videos/detail/' . $short_video->getValue('id') ?>">
    					<span class="short-video-detail-image">
    						<img src="<?php echo EXTERNAL_URL . '/photos/short_videos/id_' . $short_video->getValue('id'). '_' . $short_video->getValue('photo') ?>" alt="<?php echo $short_video->getValue('name') ?>">
    					</span>
    				</a>
          </div>
        <?php endforeach; ?>
	    </div>
	</div>

	<div class="wp-see-all-short-video">
		<a href="<?php echo URL ?>/short_videos/display/"><span id="more-short-video"><i class="fas fa-angle-down"></i></span></a>
	</div>
</div>

<div class="wp-general-container">
	<div class="wp-general-header">
		<span>
			<i class="fas fa-film"></i>
			<a href="<?php echo URL ?>/movies/display/">Movies</a>&nbsp;&&nbsp;<a href="<?php echo URL ?>/series/display/">Series</a>
		</span>
	</div>
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
    <?php foreach ($series as $series_row): ?>
      <div class="wp-detail-container">
        <a href="<?php echo URL . '/series/detail/' . $series_row->getValue('id') ?>">
          <div class="wp-general-detail-image">
            <img src="<?php echo EXTERNAL_URL . '/photos/series/id_' . $series_row->getValue('id'). '_' . $series_row->getValue('photo') ?>" alt="<?php echo $series_row->getValue('name') ?>">
          </div>
          <div class="wp-general-details">
            <div id="general-label"><?php echo $series_row->getValue('name') ?></div>
            <div class="general-rating-container">
              <span id="general-rating"><i class="fas fa-star"></i><?php echo $series_row->getValue('rate') ?></span>
              <span id="general-series"><img src="<?php echo FILE_URL ?>/logos/serie.png"></span>
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
      <a href="<?php echo URL . '/general/display/?start=' . $prevStart ?>"><span><i class="fas fa-angle-left"></i></span></a>
    <?php endif; ?>

    <?php if($isNextExceed): ?>
      <a class="not-active"><span><i class="fas fa-angle-right"></i></span></a>
    <?php else: ?>
      <a href="<?php echo URL . '/general/display/?start=' . $nextStart ?>"><span><i class="fas fa-angle-right"></i></span></a>
    <?php endif; ?>
	</div>
</div>

<script src="<?php echo FILE_URL ?>/scripts/general.js"></script>
 <?php
displayPageFooter();
  ?>
