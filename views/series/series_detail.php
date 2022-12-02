<?php
displayPageHeader('Series detail | ' . WEB_NAME);
displayTitleInDetail();

if($id AND $series = Series::getSeriesById($id)):
  $related_series = Series::getSeriesBySeriesCategoryId($series->getValue('series_category_id'), 0, RELATED_ROWS);
  $episodes = SeriesVideos::getSeriesVideosBySeriesId($series->getValue('id'));
  $episodeId = isset($_GET['episodeId']) ? preg_replace('/[^0-9]/', '', $_GET['episodeId']) : '';
  if($episodeId AND $episode=SeriesVideos::getSeriesVideoById($episodeId)):
    $viewers = SeriesEpisodeViewers::getViewersRelatedEpisode($episode->getValue('id'));
    $addViewers = new SeriesEpisodeViewers(array(
      'series_video_id'=> $episodeId,
      'remote_address'=> $_SERVER['REMOTE_ADDR']
    ));
    $addViewers->record();
 ?>
 <div class="ky-movie-stream">
   <div class="triple-spinner"></div>
   <?php echo $episode->getValue('full_video') ?>
 </div>
 <div class="ky-movie-stream-info-container">
   <span class="ky-viewer"><i class="far fa-eye"></i><?php echo $viewers ?></span>
   <span class="ky-label"><?php echo $episode->getValue('name') ?></span>
   <span class="ky-release-year"><?php echo $series->getValue('released_year') ?></span>
   <span class="ky-download-button"><a href="#"><i class="fas fa-arrow-alt-circle-down"></i>Download</a></span>
 </div>
  <?php else: ?>
    <div class="ky-movie-stream ky-indicate-episode">
      <div class="ky-indicate-episode-name">13 reasons why Season 1</div>
      <div class="ky-indicate-episode-label">Please select an episode below...</div>
      <svg x="0px" y="0px" width="53.425px" height="109.589px" viewBox="0 0 53.425 109.589">
        <path stroke="#00ced1" d="M55.772,3.131c0,0-47.75-16.054-46.379,96.476"/>
        <path stroke="#00ced1" d="M2.152,91.193l8.023,16.243c0,0,6.654-26.224,9.98-15.265"/>
      </svg>
    </div>
  <?php endif; ?>
 <div class="ky-series-tabs">
   <ul>
     <li class="selected" id="ky-episodes">Episodes</li>
     <li id="ky-synopsis">Synopsis</li>
     <li id="ky-trailer">Trailer</li>
   </ul>
   <div class="ky-series-tabs-content">
     <div class="ky-episodes-content">
       <?php $count = 1; foreach($episodes as $episode): ?>
         <span><a href="<?php echo URL . '/series/detail/' . $id . '/?episodeId=' . $episode->getValue('id') ?>">Episode <?php echo $count++ ?></a></span>
       <?php endforeach; ?>
     </div>
     <div class="ky-synopsis-content">
       [Unicode]<br>
       <?php echo $series->getValue('unicode') ?>
       <br>[Zawgyi]<br>
       <?php echo $series->getValue('zawgyi') ?>
     </div>
     <div class="ky-trailer-content">
       <?php echo $series->getValue('trailer') ?>
   </div>
 </div>
</div>

<div class="series-related-video-container">
  <div class="series-related-video-header">
    <div class="related-label">Related videos</div>
    <div class="series-related-video-nav">
      <span class="swiper-button-prev series-prev"><i class="fas fa-angle-left"></i></span>
      <span class="swiper-button-next series-next"><i class="fas fa-angle-right"></i></span>
    </div>
  </div>

  <div class="swiper-container series-related-video-details-container">
      <div class="swiper-wrapper">
        <?php foreach ($related_series as $row): ?>
          <div class="swiper-slide">
            <a href="<?php echo URL . '/series/detail/' . $row->getValue('id') ?>">
              <div class="series-related-details-container">
                <div class="series-related-image">
                  <img src="<?php echo EXTERNAL_URL . '/photos/series/id_' . $row->getValue('id'). '_' . $row->getValue('photo') ?>">
                </div>
                <div class="series-related-details">
                  <div id="series-related-details-label"><?php echo $row->getValue('name') ?></div>
                  <div class="series-related-details-rating">
                    <span id="series-related-rating"><i class="fas fa-star"></i><?php echo $row->getValue('rate') ?></span>
                    <span id="series-logo"><img src="<?php echo FILE_URL ?>/logos/serie.png"></span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
  </div>
</div>
<?php
  else:
    displayNotFoundVideo();
  endif;
  ?>
 <script src="<?php echo FILE_URL ?>/scripts/movie_detail.js"></script>
<?php
displayPageFooter();
  ?>
