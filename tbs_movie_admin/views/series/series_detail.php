<?php
displayPageHeader('Series | ' . WEB_NAME);
displayMainNavigation('series');
?>
  <section class="ky-series">
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
        $categories = SeriesCategories::getAllSeriesCategories();
        foreach ($categories as $category):
          ?>
          <li>
            <a href="<?php echo URL . '/series/display/' . $category->getValue('id') ?>"><?php echo $category->getValue('name') ?></a>
            <!-- <button class="hk-main-cat-delete-js" title="delete" data-id="<?php echo $category->getValue('id') ?>"><i class="far fa-times-circle"></i></button> -->
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <?php
    if($id and $series = Series::getSeriesById($id)):
      $category = SeriesCategories::getSeriesCategoryById($series->getValue('series_category_id'));
      $viewer = SeriesEpisodeViewers::getViewersRelatedMovie($id);
      $episodes = SeriesVideos::getSeriesVideosBySeriesId($series->getValue('id'))
      ?>
    <section class="ky-series-detail">
      <div class="ky-series-info-wrapper">
        <div class="ky-series-trace">
          <a href="<?php echo URL ?>/series/">Series</a>
          <i class="fa fa-chevron-right"></i>
          <a href="<?php echo URL . '/series/display/' . $category->getValue('id') ?>"><?php echo $category->getValue('name') ?></a>
          <i class="fa fa-chevron-right"></i>
          <span><?php echo $series->getValue('name') ?></span>
        </div>
        <div class="ky-series-info-container-wrapper">
          <div class="ky-series-info-container">
            <div class="ky-series-info">
              <div class="ky-series-image">
                <img src="<?php echo URL . '/photos/series/id_' . $series->getValue('id'). '_' . $series->getValue('photo') ?>" alt="">
                <span id="ky-series-image-edit"><i class='far fa-edit'></i></span>
                <form action="<?php echo URL ?>/series/update_series_photo/" method="post" enctype="multipart/form-data">
                  <input type="file" name="itemImages" id="ky-series-image">
                  <div><button type="submit">Save</button><span>Cancel</span></div>
                  <input type="hidden" name="id" value="<?php echo $series->getValue('id') ?>">
                </form>
              </div>
              <div class="ky-series-info-detail">
                <input type="number" step="0.1" max="10.0" name="" value="<?php echo $series->getValue('rate') ?>" id="imdb-rate">
                <div id="series-name"><?php echo $series->getValue('name') ?></div>
                <div id="series-released-year"><?php echo $series->getValue('released_year') ?></div>
                <div id="series-imdb-rating"><span>IMDb</span><span><?php echo $series->getValue('rate') ?></span></div>
                <div id="series-stars">
                  <div class="stars-outer">
                    <div class="stars-inner"></div>
                  </div>
                </div>
                <!-- <div id="series-viewer"><span><i class="fa fa-eye"></i></span><span><?php echo $viewer ?></span></div> -->
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
                <?php echo $series->getValue('unicode') ?>
              </div>
              <div class="ky-zawgyi-description hide" data-simplebar>
                <?php echo $series->getValue('zawgyi') ?>
              </div>
            </div>
            <div class="ky-form-edit-icon">
              <i class='far fa-edit'></i>
           </div>
          </div>
          <div class="ky-series-form-container">
            <div class="ky-movies-info-edit-form-container">
              <form class="" action="<?php echo URL ?>/series/update_series_text/" method="post">
                <input type="hidden" name="id" value="<?php echo $series->getValue('id') ?>">
                <input type="hidden" name="series_category_id" value="<?php echo $series->getValue('series_category_id') ?>">
                <span><label for="seriesName">Series Name</label><input type="text" name="name" value="<?php echo $series->getValue('name') ?>" placeholder="name" id="seriesName"></span>
                <span id="trailer"><label for="trailerCode">Trailer Code</label><textarea name="trailer" placeholder="iframe" id="trailerCode"><?php echo $series->getValue('trailer') ?></textarea></span>
                <span><label for="seriesIMDbRate">IMDb Rate</label><input type="number" max="10.0" step="0.1" name="rate" value="<?php echo $series->getValue('rate') ?>" placeholder="rate" id="seriesIMDbRate"></span>
                <span><label for="releasedYear">Released Year</label><input type="number" name="released_year" value="<?php echo $series->getValue('released_year') ?>" placeholder="released year" id="releasedYear"></span>
                <span id="unicodeDec"><label for="unicodeDescription">Description</label><textarea name="unicode" placeholder="unicode" id="unicodeDescription"><?php echo $series->getValue('unicode') ?></textarea></span>
                <span><label for="zawgyiDescription">Description</label><textarea name="zawgyi" placeholder="zawgyi" id="zawgyiDescription"><?php echo $series->getValue('zawgyi') ?></textarea></span>
                <span>
                  <button type="submit" name="button" class="ky-item-save-button">Save</button>
                  <button type="button" name="button" class="ky-item-cancel-button">Cancel</button>
                </span>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="ky-series-episodes-container">
        <div id="ky-series-add-icon"><span><i class="fa fa-plus-circle"></i>Add Episode</span></div>
        <div class="ky-episodes-add-form">
          <form action="<?php echo URL ?>/series/create_episode/" method="post">
            <input type="hidden" name="series_id" value="<?php echo $series->getValue('id') ?>">
            <div>
              <input type="text" name="name" class="episodeName" placeholder="Name">
              <input type="text" name="info" class="episodeSize" placeholder="Size">
            </div>
            <div>
              <textarea name="full_video" placeholder="Full Video Code"></textarea>
            </div>
            <div>
              <button type="submit" class="ky-add-episode-btn"><span><i class="fa fa-plus-circle"></i></span></button>
              <span><i class="far fa-times-circle"></i></span>
            </div>
          </form>
        </div>
        <div class="ky-series-episodes" data-simplebar>
          <ol class="ky-episodes-list">
            <?php $count=1; foreach ($episodes as $episode): ?>
              <li>
                <div class="ky-episode-info">
                  <span><?php echo $count++ ?>.</span>
                  <span class="ky-episodes-edit-name"><?php echo $episode->getValue('name') ?></span>
                  <span class="ky-episodes-edit-size"><?php echo $episode->getValue('info') ?></span>
                  <span class="ky-episodes-edit-icon"><i class="far fa-edit"></i></span>
                </div>
                <div class="ky-episodes-edit-form">
                  <form action="<?php echo URL ?>/series/edit_episode/" method="post">
                    <input type="hidden" name="id" value="<?php echo $episode->getValue('id') ?>">
                    <input type="hidden" name="series_id" value="<?php echo $episode->getValue('series_id') ?>">
                    <div>
                      <input type="text" name="name" value="<?php echo $episode->getValue('name') ?>" class="episodeName" placeholder="Name">
                      <input type="text" name="info" value="<?php echo $episode->getValue('info') ?>" class="episodeSize" placeholder="Size">
                    </div>
                    <div>
                      <textarea name="full_video" placeholder="Full Video Code"><?php echo $episode->getValueEncoded('full_video') ?></textarea>
                    </div>
                    <div class="">
                      <button type="submit" class="ky-add-episode-btn"><span><i class="fa fa-plus-circle"></i></span></button>
                      <span><i class="far fa-times-circle"></i></span>
                    </div>
                  </form>
                </div>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </section>
    <?php else: ?>
      <h1 class="hk-select-item"><span>This series does not contain in Database.</span></h1>
    <?php endif; ?>
  </section>
  <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
  <script src="<?php echo URL ?>/scripts/series_detail.js"></script>
<?php
displayPageFooter();
?>
