<?php
displayPageHeader('Item | ' . WEB_NAME);
displayMainNavigation('item');
?>
  <section class="ky-movies">
    <nav class="ssn-cat-sidebar">
      <div>
        <h4 class="ssn-cat-names">
          All Categories
        <!-- <div class="ssn-plus-icon" onclick="AddCat()">
          <a href="#"><i class="fa fa-plus-circle"></i></a>
          <span class="ssn-tooltip">Add New</span>
        </div> -->
        </h4>
        <!-- <form action="<?php echo URL ?>/movies/create_category/" method="post" id="Catinput">
          <input class="ssn-input" name="name" type="text" value="">
          <button class="ssn-ok" type="submit" name="button" onclick="">Ok</button>
        </form>
        <button class="ssn-cancel" type="button" name="button" onclick="CancelCat()">Cancel</button> -->
        <button class="ssn-edit-cat" id="hk-main-cat-edit-js">List Category</button>
      </div>
      <ul class="ssn-cat-list">
        <?php
        $categories = MovieCategories::getAllMovieCategories();
        foreach ($categories as $category):
          ?>
          <li>
            <a href="<?php echo URL . '/movies/display/' . $category->getValue('id') ?>"><?php echo $category->getValue('name') ?></a>
            <!-- <button class="hk-main-cat-delete-js" title="delete" data-id="<?php echo $category->getValue('id') ?>"><i class="far fa-times-circle"></i></button> -->
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <?php
    if($id and $movie = Movies::getMovieById($id)):
      $category = MovieCategories::getMovieCategoryById($movie->getValue('movie_category_id'));
      $viewer = MovieViewers::getViewersRelatedMovie($id);
      ?>
    <section class="ky-movies-detail">
      <div class="ky-movies-trace">
        <a href="<?php echo URL ?>/movies/">Movies</a>
        <i class="fa fa-chevron-right"></i>
        <a href="<?php echo URL . '/movies/display/' . $category->getValue('id') ?>"><?php echo $category->getValue('name') ?></a>
        <i class="fa fa-chevron-right"></i>
        <span><?php echo $movie->getValue('name') ?></span>
      </div>
      <div class="ky-movies-info-container-wrapper">
        <div class="ky-series-info-container">
          <div class="ky-series-info">
            <div class="ky-series-image">
              <img src="<?php echo URL . '/photos/movies/id_' . $movie->getValue('id'). '_' . $movie->getValue('photo') ?>" alt="">
              <span id="ky-series-image-edit"><i class='far fa-edit'></i></span>
              <form action="<?php echo URL ?>/movies/update_movie_photo/" method="post" enctype="multipart/form-data">
                <input type="file" name="itemImages" id="ky-series-image">
                <div><button type="submit">Save</button><span>Cancel</span></div>
                <input type="hidden" name="id" value="<?php echo $movie->getValue('id') ?>">
              </form>
            </div>
            <div class="ky-series-info-detail">
              <input type="text"value="<?php echo $movie->getValue('rate') ?>" id="imdb-rate">
              <div id="series-name"><?php echo $movie->getValue('name') ?></div>
              <div id="series-released-year"><?php echo $movie->getValue('released_year') ?></div>
              <div id="series-imdb-rating"><span>IMDb</span><span><?php echo $movie->getValue('rate') ?></span></div>
              <div id="series-stars">
                <div class="stars-outer">
                  <div class="stars-inner"></div>
                </div>
              </div>
              <div id="series-viewer"><span><i class="fa fa-eye"></i></span><span><?php echo $viewer ?></span></div>
            </div>
          </div>
          <div class="ky-series-description">
            <div id="ky-item-description-tabs">
              <ul>
                <li id="ky-unicode-tab">Unicode</li>
                <li id="ky-zawgyi-tab">Zawgyi</li>
              </ul>
              <div id="ky-description-indicator"></div>
            </div>
            <div class="ky-unicode-description hide active" data-simplebar>
              <?php echo $movie->getValue('unicode') ?>
            </div>
            <div class="ky-zawgyi-description hide" data-simplebar>
              <?php echo $movie->getValue('zawgyi') ?>
            </div>
          </div>
          <div class="ky-form-edit-icon">
            <i class='far fa-edit'></i>
          </div>
        </div>
          <div class="ky-series-form-container">
            <div class="ky-movies-info-edit-form-container">
              <form action="<?php echo URL ?>/movies/update_movie_text/" method="post">
                <input type="hidden" name="id" value="<?php echo $movie->getValue('id') ?>">
                <input type="hidden" name="movie_category_id" value="<?php echo $movie->getValue('movie_category_id') ?>">
                <span><label for="seriesName">Series Name</label><input type="text" name="name" value="<?php echo $movie->getValue('name') ?>" placeholder="name" id="seriesName"></span>
                <span><label for="seriesIMDbRate">IMDb Rate</label><input type="number" max="10.0" step="0.1" name="rate" value="<?php echo $movie->getValue('rate') ?>" placeholder="rate" id="seriesIMDbRate"></span>
                <span><label for="fullVideoCode">Full Video Code</label><textarea name="full_video" placeholder="iframe" id="fullVideoCode"><?php echo $movie->getValue('full_video') ?></textarea></span>
                <span><label for="trailerCode">Trailer Code</label><textarea name="trailer" placeholder="iframe" id="trailerCode"><?php echo $movie->getValue('trailer') ?></textarea></span>
                <span><label for="unicodeDescription">Description</label><textarea name="unicode" placeholder="unicode" id="unicodeDescription"><?php echo $movie->getValue('unicode') ?></textarea></span>
                <span><label for="zawgyiDescription">Description</label><textarea name="zawgyi" placeholder="zawgyi" id="zawgyiDescription"><?php echo $movie->getValue('zawgyi') ?></textarea></span>
                <span><label for="releasedYear">Released Year</label><input type="number" name="released_year" value="<?php echo $movie->getValue('released_year') ?>" placeholder="released year" id="releasedYear"></span>
                <span>
                  <button type="submit" name="button" class="ky-item-save-button">Save</button>
                  <button type="button" name="button" class="ky-item-cancel-button">Cancel</button>
                </span>
              </form>
            </div>
          </div>
      </div>
    </section>
    <?php else: ?>
      <h1 class="hk-select-item"><span>This movie does not contain in Database.</span></h1>
    <?php endif; ?>
  </section>

  <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
  <script src="<?php echo URL ?>/scripts/movie_detail.js"></script>
<?php
displayPageFooter();
?>
