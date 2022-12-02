<?php
  displayPageHeader('Error | ' . WEB_NAME);
?>
<!--  -->
 <section class="ky-error-display">
   <div class="ky-fields-container">
     <span><a href="<?php echo URL ?>/promotion/">Movies</a></span>
     <span><a href="<?php echo URL ?>/category/">Series</a></span>
     <span><a href="<?php echo URL ?>/item/">Short Videos</a></span>
     <span><a href="<?php echo URL ?>/order/">Setting</a></span>
     <span><a href="javascript:history.go(-1)">Back</a></span>
   </div>
   <div class="ky-error-message-container">
     <div><span>Oops!</span>
          <span>Something has <br /> broken.</span>
     </div>
     <div>
       <span>The problem may be...</span>
       <?php if (isset($requestmessage)): ?>
         <span><i class='far fa-frown'></i><?php echo $requestmessage ?></span>
       <?php endif; ?>
       <?php if(isset($error_messages)): foreach($error_messages as $error_message): ?>
         <span><i class='far fa-frown'></i><?php echo $error_message ?></span>
       <?php endforeach; endif; ?>
       <span>Please go back to <span><a href="javascript:history.go(-1)">home page</a></span> or re-enter the respective field that describe above.</span>
     </div>
   </div>
 </section>

 <?php displayPageFooter(); ?>
