<div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
	aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content green-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="close-x" aria-hidden="true">&times;</span>
        	<span class="sr-only">Close</span></button>
        <h2 class="modal-title">
        <?php 
        if($modalTitle == null): ?>
        Share This
        <?php 
        else: 
        	echo $modalTitle;
        	endif;
        ?>
        </h2>
      </div>
      <div id="<?php echo $suffix; ?>_send_email_form">
        <form action="" method="POST" role="form">
          <div class="modal-body">

              <div class="form-group form-override">
                <?php if($emailAddress == null): ?>
                	<label for="">Email To: </label>
                	<input type="email" class="form-control" id="<?php echo $suffix; ?>_send_to" name="to" 
                		placeholder="Email Here" required>
                	<input type="hidden" id="<?php echo $suffix; ?>_send_from" name="from" value="none">
                <?php else: ?>
                	<label for="">Email From: </label>
                	<input type="email" class="form-control" id="<?php echo $suffix; ?>_send_from" name="from" 
                		placeholder="Email Here" required>
                	<input type="hidden" id="<?php echo $suffix; ?>_send_to" name="to" value="<?php echo $emailAddress; ?>">
                <?php endif; ?>
                
                <input type="hidden" class="form-control" id="<?php echo $suffix; ?>_subject" name="subject" value="<?php echo $subject; ?>">
                <input type="hidden" class="form-control" id="<?php echo $suffix; ?>_url" name="url" value="<?php 
                	echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>">
                
                <?php if($emailAddress != null): ?>
	                <label for="">Message: </label>
	                <textarea rows="5" cols="" id="<?php echo $suffix; ?>_content" class="form-control"></textarea>
                <?php else: ?>
                	<input type="hidden" class="form-control" id="<?php echo $suffix; ?>_content" name="content" value="none"> 
                <?php endif; ?>
                
              </div>

          </div>
          <div class="modal-footer">
                <div type="button" class="large-btn pull-left btn-modal" onclick="sendEmail_<?php echo $suffix; ?>();">
                SUBMIT
                </div>
              <input type="hidden" name="send_email" value="true">
          </div>
        </form>
      </div>

      <div id="<?php echo $suffix; ?>_sent_email" style="display:none; padding: 0px 0px 15px 15px;">
        <h2>The email was sent successfully</h2>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  function sendEmail_<?php echo $suffix; ?>() {
    var to = jQuery("#<?php echo $suffix; ?>_send_to").val();
    var from = jQuery("#<?php echo $suffix; ?>_send_from").val();
    var subject = jQuery("#<?php echo $suffix; ?>_subject").val();
    var url = jQuery("#<?php echo $suffix; ?>_url").val(); 
    var send_email = true; 
    var content = jQuery("#<?php echo $suffix; ?>_content").val();

    var data = {
        to: to,
        from: from,
        url: window.location.href,
        subject: subject,
        send_email: send_email,
        content: content
    };

    jQuery.ajax({
        url: "/../wp-content/plugins/in_utils/Rest/EmailRest.php",
        method: "POST",
        data: jQuery.param(data),
        ContentType: 'application/x-www-form-urlencoded'
    })
    .success(function(results) {
      	jQuery("#<?php echo $suffix; ?>_send_email_form").css({'display':'none'});
        jQuery("#<?php echo $suffix; ?>_sent_email").css({'display':'block'});
    });

  }
</script>