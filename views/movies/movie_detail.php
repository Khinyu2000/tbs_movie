<?php
displayPageHeader('Movie detail | ' . WEB_NAME);
displayTitleInDetail();
if($id AND $movie = Movies::getMovieById($id)):
  $viewers = MovieViewers::getViewersRelatedMovie($movie->getValue('id'));
  $related_movies = Movies::getMoviesByMovieCategoryId($movie->getValue('movie_category_id'), 0, RELATED_ROWS);
  $addViewers = new MovieViewers(array(
    'movie_id'=> $movie->getValue('id'),
    'remote_address'=> $_SERVER['REMOTE_ADDR']
  ));
  $addViewers->record();
 ?>
  <div class="ky-movie-stream">
    <div class="triple-spinner"></div>
    <?php echo $movie->getValue('full_video') ?>
  </div>
  <div class="ky-movie-stream-info-container">
    <span class="ky-viewer"><i class="far fa-eye"></i><?php echo $viewers ?></span>
    <span class="ky-label"><?php echo $movie->getValue('name') ?></span>
    <span class="ky-release-year"><?php echo $movie->getValue('released_year') ?></span>
    <span class="ky-download-button"><a href="#"><i class="fas fa-arrow-alt-circle-down"></i>Download</a></span>
  </div>
  <div class="ky-movie-tabs">
    <ul>
      <li class="selected" id="ky-synopsis">Synopsis</li>
      <li id="ky-trailer">Trailer</li>
    </ul>
    <div class="ky-movie-tabs-content">
      <div class="ky-synopsis-content">
        [Unicode]<br>
        <?php echo $movie->getValue('unicode') ?>
        <br>[Zawgyi]<br>
        <?php echo $movie->getValue('zawgyi') ?>
      </div>
      <div class="ky-trailer-content">
        <?php echo $movie->getValue('trailer') ?>
      </div>
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
          <?php foreach ($related_movies as $related_movie): ?>
            <div class="swiper-slide">
              <a href="<?php echo URL . '/movies/detail/' . $related_movie->getValue('id') ?>">
                <div class="movie-related-details-container">
                  <div class="movie-related-image">
                    <img src="<?php echo EXTERNAL_URL . '/photos/movies/id_' . $related_movie->getValue('id'). '_' . $related_movie->getValue('photo') ?>">
                  </div>
                  <div class="movie-related-details">
                    <div id="movie-related-details-label"><?php echo $related_movie->getValue('name') ?></div>
                    <div class="movie-related-details-rating">
                      <span id="movie-related-rating"><i class="fas fa-star"></i><?php echo $related_movie->getValue('rate') ?></span>
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
