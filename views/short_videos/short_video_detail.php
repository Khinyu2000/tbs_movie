<?php
displayPageHeader('Short Videos | ' . WEB_NAME);
displayTitleInDetail();
if($id AND $short_video = ShortVideos::getShortVideoById($id)):
  $viewers = ShortVideoViewers::getViewersRelatedShortVideo($short_video->getValue('id'));
  $related_videos = ShortVideos::getShortVideosByCategoryId($short_video->getValue('short_video_category_id'), 0, RELATED_ROWS);
  $addViewers = new ShortVideoViewers(array(
    'short_video_id'=> $short_video->getValue('id'),
    'remote_address'=> $_SERVER['REMOTE_ADDR']
  ));
  $addViewers->record();
 ?>
  <div class="ky-movie-stream">
    <div class="triple-spinner"></div>
    <?php echo $short_video->getValue('full_video') ?>
  </div>
  <div class="ky-movie-stream-info-container">
    <span class="ky-viewer"><i class="far fa-eye"></i><?php echo $viewers ?></span>
    <span class="ky-label"><?php echo $short_video->getValue('name') ?></span>
    <span class="ky-download-button"><a href="#"><i class="fas fa-arrow-alt-circle-down"></i>Download</a></span>
    <!-- <span class="ky-release-year">2019</span> -->
  </div>
  <div class="ky-short-video-tabs">
    <ul>
      <li class="selected" id="ky-synopsis">Synopsis</li>
    </ul>
    <div class="ky-short-video-tabs-content">
      <div class="ky-synopsis-content">
        [Unicode]<br>
        <?php echo $short_video->getValue('unicode') ?>
        <br>[Zawgyi]<br>
        <?php echo $short_video->getValue('zawgyi') ?>
      </div>
    </div>
      <div class="ky-trailer-content"></div>
    </div>
  </div>

  <div class="movie-related-video-container">
    <div class="movie-related-video-header">
      <div class="related-label">Related videos</div>
      <div class="movie-related-video-nav">
        <span class="swiper-button-prev movie-prev"><i class="fas fa-angle-left"></i></span>
        <span class="swiper-button-next movie-next"><i class="fas fa-angle-right"></i></span>
      </div>
    </div>

    <div class="swiper-container movie-related-video-details-container">
      <div class="swiper-wrapper">
        <?php foreach ($related_videos as $related_video): ?>
          <div class="swiper-slide">
            <a href="<?php echo URL . '/short_videos/detail/' . $related_video->getValue('id') ?>">
              <div class="movie-related-details-container">
                <div class="short-video-related-image">
                  <img src="<?php echo EXTERNAL_URL . '/photos/short_videos/id_' . $related_video->getValue('id'). '_' . $related_video->getValue('photo') ?>">
                </div>
                <div class="movie-related-details">
                  <div id="movie-related-details-label"><?php echo $related_video->getValue('name') ?></div>
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
