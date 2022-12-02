<?php
displayPageHeader('Series | ' . WEB_NAME);
displayMainNavigation('series');
$order = isset( $_GET["order"] ) ? preg_replace( "/[^_a-zA-Z]/", "", $_GET["order"] ) : "created_date";
 ?>
 <section class="ssn-cat">
   <nav class="ssn-cat-sidebar">
     <div>
       <h4 class="ssn-cat-names">
         All Categories
       <div class="ssn-plus-icon" onclick="AddCat()">
         <a href="#"><i class="fa fa-plus-circle"></i></a>
         <span class="ssn-tooltip">Add New</span>
       </div>
       </h4>
       <form action="<?php echo URL ?>/series/create_category/" method="post" id="Catinput">
         <input class="ssn-input" name="name" type="text" value="">
         <button class="ssn-ok" type="submit" name="button" onclick="">Ok</button>
       </form>
       <button class="ssn-cancel" type="button" name="button" onclick="CancelCat()">Cancel</button>
       <button class="ssn-edit-cat" id="hk-main-cat-edit-js">List Category</button>
     </div>
     <ul class="ssn-cat-list">
       <?php
       $categories = SeriesCategories::getAllSeriesCategories();
       foreach ($categories as $category):
         ?>
         <li>
           <a href="<?php echo URL . '/series/display/' . $category->getValue('id') ?>"><?php echo $category->getValue('name') ?></a>
           <button class="hk-main-cat-delete-js" title="delete" data-id="<?php echo $category->getValue('id') ?>"><i class="fas fa-times"></i></button>
         </li>
       <?php endforeach; ?>
     </ul>
   </nav>
   <section class="ssn-cat-mani">
     <?php
      if($id):
        $items = Series::getSeriesBySeriesCategoryId($id, $order);
        $category = SeriesCategories::getSeriesCategoryById($id);
        if($category):
      ?>
       <header class="ssn-item-header">
         <h1>Series</h1>
       </header>
       <div class="ssn-item-add">
         <a href="#" onclick="AddItem()"><i class="fa fa-plus-circle"></i>Add Item</a>
       </div>
       <div class="ssn-add-item-overlay">
         <form action="<?php echo URL ?>/series/create_series/" method="post" enctype="multipart/form-data">
           <input type="hidden" name="series_category_id" value="<?php echo $category->getValue('id') ?>">
           <div>
             <label for="name">Name</label>
             <div class="ssn-input-container">
               <input type="text" name="name" id="name">
               <span class="ssn-line"></span>
             </div>
           </div>
           <div>
             <label for="releasedYear">Released Year</label>
             <div class="ssn-input-container">
               <input type="number" name="released_year" id="releasedYear">
               <span class="ssn-line"></span>
             </div>
           </div>
           <div>
             <label for="rate">Rate</label>
             <div class="ssn-input-container">
               <input type="number" step="0.1" max="10.0" name="rate" id="rate">
               <span class="ssn-line"></span>
             </div>
           </div>
           <div>
             <label for="unicode">Description</label>
             <div class="ssn-input-container">
               <textarea name="unicode" rows="8" cols="80" placeholder="Unicode" id="unicode"></textarea>
               <span class="ssn-line"></span>
             </div>
           </div>
           <div>
             <label for="zawgyi">Description</label>
             <div class="ssn-input-container">
               <textarea name="zawgyi" rows="8" cols="80" placeholder="Zawgyi" id="zawgyi"></textarea>
               <span class="ssn-line"></span>
             </div>
           </div>
           <div>
             <label for="trailer">Trailer</label>
             <div class="ssn-input-container">
               <textarea name="trailer" rows="8" cols="80" placeholder="<iframe>...</iframe>" id="trailer"></textarea>
               <span class="ssn-line"></span>
             </div>
           </div>
          <div id="ssn-image-item-preview"><div>No Photo Chosen</div></div>
           <div class="ssn-upload-wrapper">
             <label for="">Photo</label>
               <button class="ssn-upload-btn">
                 <i class="fas fa-arrow-alt-circle-up"></i>
                 <div>Choose a Photo&hellip;</div>
               </button>
               <input type="file" name="itemImages" id="itemimages" onchange="checkFiles(this.files)"/>
           </div>
           <div class="ssn-item-button">
             <button type="submit" class="ssn-add-item-button">Add</button>
             <button type="button" name="cancel_upload" class="ssn-cancel-item-button" onclick="CancelItem()">Cancel</button>
           </div>
         </form>
       </div>
       <div class="ssn-sub-item">
         <div class="hk-sub-cat-wrap">
           <form class="ssn-sub-cat-title">
             <button type="button" name="button" class="hk-cat-edit-js"><i class='far fa-edit'></i></button>
             <button type="button" name="button" class="hk-cat-save-js" style="display:none"><i class='fas fa-save'></i></button>
             <input type="text" name="" data-id="<?php echo $category->getValue('id') ?>" value="<?php echo $category->getValue('name') ?>" disabled>
           </form>
           <?php if($items): ?>
             <div class="hk-order-link">
               <span>Order by: </span>
               <a <?php echo ($order=='name')? 'class="active-order"' : 'href="' . URL . '/series/display/' . $id . '/' . '?order=name"' ?>>Name</a> |
               <a <?php echo ($order=='name')? 'href="' . URL . '/series/display/' . $id . '/' . '?order=created_date"' : 'class="active-order"'?>>Created Date</a>
             </div>
             <button class="hk-items-edit-js ssn-edit-cat">Delete Items</button>
             <button class="hk-items-save-js ssn-edit-cat" style="display:none">Save</button>
             <ul class="hk-item-order-ajax">
               <?php foreach ($items as $item): ?>
                 <li class="marquee" data-id="<?php echo $item->getValue('id') ?>">
                   <a href="<?php echo URL . '/series/detail/' . $item->getValue('id') ?>">
                     <img src="<?php echo URL . '/photos/series/id_' . $item->getValue('id'). '_' . $item->getValue('photo') ?>" alt="<?php echo $item->getValue('name') ?>">
                     <div class="ssn-item-sum">
                       <span class="ssn-item-name"><?php echo $item->getValue('name') ?></span>
                     </div>
                   </a>
                   <button class="hk-items-delete-js"><i class="far fa-times-circle"></i></button>
                 </li>
               <?php endforeach; ?>
             </ul>
           <?php else: ?>
             <h1 class="hk-empty-item"><span>Empty Movie.</span></h1>
           <?php endif; ?>
          <!-- <h3 class="hk-empty-items">Not Inserted Any Items</h3> -->
        </div>
       </div>
       <?php else: ?>
         <h1 class="hk-select-item"><span>This category number does not contain in Database.</span></h1>
       <?php endif; ?>
     <?php else: ?>
       <h1 class="hk-select-item"><span>Please Select Category</span></h1>
     <?php endif; ?>
   </section>
 </section>
 <script src="<?php echo FILE_URL ?>/scripts/m_s_sv.js"></script>
 <?php
displayPageFooter();
  ?>
