<?php
displayPageHeader('Short Videos | ' . WEB_NAME);
displayMainNavigation('short_videos');
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
        $categories = ShortVideoCategories::getAllShortVideoCategories();
        foreach ($categories as $category):
          ?>
          <li>
            <a href="<?php echo URL . '/short_videos/display/' . $category->getValue('id') ?>"><?php echo $category->getValue('name') ?></a>
            <!-- <button class="hk-main-cat-delete-js" title="delete" data-id="<?php echo $category->getValue('id') ?>"><i class="far fa-times-circle"></i></button> -->
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <?php
    if($id and $short_video = ShortVideos::getShortVideoById($id)):
      $category = ShortVideoCategories::getShortVideoCategoryById($short_video->getValue('short_video_category_id'));
      $viewer = ShortVideoViewers::getViewersRelatedShortVideo($id);
      ?>
    <section class="ky-movies-detail">
      <div class="ky-movies-trace">
        <a href="<?php echo URL ?>/short_videos/">Short Videos</a>
          <i class="fa fa-chevron-right"></i>
          <a href="<?php echo URL . '/short_videos/display/' . $category->getValue('id') ?>"><?php echo $category->getValue('name') ?></a>
          <i class="fa fa-chevron-right"></i>
          <span><?php echo $short_video->getValue('name') ?></span>
      </div>
      <div class="ky-movies-info-container-wrapper">
        <div class="ky-series-info-container">
            <div class="ky-series-info">
              <div class="ky-series-image">
                <img src="<?php echo URL . '/photos/short_videos/id_' . $short_video->getValue('id'). '_' . $short_video->getValue('photo') ?>" alt="">
                <span id="ky-series-image-edit"><i class='far fa-edit'></i></span>
                <form action="<?php echo URL ?>/short_videos/update_short_video_photo/" method="post" enctype="multipart/form-data">
                  <input type="file" name="itemImages" id="ky-series-image">
                  <div><button type="submit">Save</button><span>Cancel</span></div>
                  <input type="hidden" name="id" value="<?php echo $short_video->getValue('id') ?>">
                </form>
              </div>
              <div class="ky-series-info-detail">
                <input type="number" step="0.1" name="" value="6.7" id="imdb-rate">
                <div id="series-name"><?php echo $short_video->getValue('name') ?></div>
                <!-- <div id="series-released-year">2019</div> -->
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
                <?php echo $short_video->getValue('unicode') ?>
              </div>
              <div class="ky-zawgyi-description hide" data-simplebar>
                <?php echo $short_video->getValue('zawgyi') ?>
              </div>
            </div>
            <div class="ky-form-edit-icon">
              <i class='far fa-edit'></i>
           </div>
          </div>
          <div class="ky-series-form-container">
            <div class="ky-movies-info-edit-form-container">
              <form action="<?php echo URL ?>/short_videos/update_short_video_text/" method="post">
                <input type="hidden" name="id" value="<?php echo $short_video->getValue('id') ?>">
                <input type="hidden" name="short_video_category_id" value="<?php echo $short_video->getValue('short_video_category_id') ?>">
                <span><label for="seriesName">Series Name</label><input type="text" name="name" value="<?php echo $short_video->getValue('name') ?>" placeholder="name" id="seriesName"></span>
                <span><label for="fullVideoCode">Full Video Code</label><textarea name="full_video" placeholder="iframe" id="fullVideoCode"><?php echo $short_video->getValue('full_video') ?></textarea></span>
                <span><label for="unicodeDescription">Description</label><textarea name="unicode" placeholder="unicode" id="unicodeDescription"><?php echo $short_video->getValue('unicode') ?></textarea></span>
                <span><label for="zawgyiDescription">Description</label><textarea name="zawgyi" placeholder="zawgyi" id="zawgyiDescription"><?php echo $short_video->getValue('zawgyi') ?></textarea></span>
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
