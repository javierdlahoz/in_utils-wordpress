<div class="modal fade" id="<?php echo $data["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content green-modal" style="background-color: #fff; padding:0; overflow-x: hidden">
      <div class="modal-header" style="padding: 0px;">
        <button type="button" class="close new-close" data-dismiss="modal"><span class="close-x" aria-hidden="true">×</span>
        	<span class="sr-only">Close</span></button>
            <div class="showcase-img" style="min-height: 290px;">
                 <img src="<?php echo $data["image"]; ?>" class="img-resposive">
            </div>
      </div>
      <div class="modal-body" style="padding: 0px;">
            <div class="container">
                <div class="col-md-6 vanish-left-pad">
                    <h3><?php echo $data["title"]; ?> | <?php echo $data["location"]; ?></h3>
                    <p><?php echo $data["startDate"]; ?> - <?php echo $data["endDate"]; ?></p>
                </div>
                <br>
            </div>

			<div class="container-fluid new-modal-body">
                <div class="col-md-12">
                    <br>
                    <p class="normal-text"><?php echo $data["long_content"]; ?></p>
                    <br>
                    <div type="button" class="large-btn pull-left btn-modal" 
                    	onclick="window.location='<?php echo $data['url']; ?>';" data-dismiss="modal">
                    	<?php if($data['type'] == "festival"): ?>VIEW FESTIVAL<?php else: 
                    	?>VIEW EVENT<?php endif; ?>
                    </div>
                </div>
			</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>