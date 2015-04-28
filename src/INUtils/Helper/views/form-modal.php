<?php 
use Festival\Controller\EventController;
use Festival\Controller\FestivalController;
?>
<div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content green-modal small-modal large-modal-scroll-settings">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="close-x" aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title">Add Event</h2>
      </div>
      <div class="modal-body">
      	<h2 id="msj-modal" style="display: none; text-align: center; padding: 0 0 50px 0;">Event saved</h2>
      	<form method="post" id="event_form_modal">
			<div class="inner-content-modal-form">
					<div class="form-group">
						<input type="text" class="form-control" name="title" placeholder="Name" required>
						<input type="hidden" class="form-control" name="action_type" value="addEvent">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="autocomplete1" name="festival_location[]"
							placeholder="Location" onFocus="geolocate(1)" required>
		               	<input type="hidden" name="lat_autocompletes[]" id="lat-autocomplete1" value="">
		            	<input type="hidden" name="lng_autocompletes[]" id="lng-autocomplete1" value="">
					</div>
					<div class="form-group">
					    <div class="input-group go-full-length" data-date-format="mm-dd-yyyy">
		                   	<input type="text" name="start_date" id="start_date"
		                   		placeholder="Start Date" class="form-control datepicker" required/>
						</div>
					</div>
					<div class="form-group">
					    <div class="input-group go-full-length" data-date-format="mm-dd-yyyy">
		                   	<input type="text" name="end_date" id="end_date"
		                   		placeholder="End Date" class="form-control datepicker" required/>
						</div>
					</div>
					<div class="form-group">
					   <textarea class="form-control please-cap-and-color" name="content" rows="6" placeholder="Description"></textarea> 
					</div>
					<div class="form-group">
						<select style="height: 40px;" name="event_type" id="event_type" class="go-full-length new-showcase-selector1 please-cap-and-color">
			                <option placeholder="Type">Type</option>
			                <?php foreach (EventController::getSingleton()->getEventTypes() as $eventType): ?>
		                		<option value="<?php echo $eventType; ?>"><?php echo $eventType; ?></option>
			                <?php endforeach; ?>
			            </select>
			        </div>
                	<div class="input-group">
		                <span class="input-group-btn">
		                    <span class="btn btn-primary btn-file">Upload Image
		                        <span style="margin-left: 5px;" class="glyphicon glyphicon-upload"></span>
		                        <input type="file" name="image" id="image" accept='image/*'>
		                    </span>
		                </span>
		            </div>
		            <br>
		            <div id="file-name"></div>
				</div>
                <div class="modal-footer vanish-left-pad">
                    <input style="max-width: 200px; background: transparent;" type="submit" class="large-btn btn-modal" value="SUBMIT">
                </div>
	       </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script type="text/javascript">

	jQuery(document).ready(function() {
		initialize_autocomplete_and_listener(1);
	});

    jQuery('#start_date').datepicker({
        dateFormat: 'mm-dd-yy',
        onClose: function( selectedDate ) {
            jQuery('#end_date').datepicker( "option", "minDate", selectedDate );
        }      
    });
    jQuery('#end_date').datepicker({
        dateFormat: 'mm-dd-yy',
        onClose: function( selectedDate ) {
            jQuery('#start_date').datepicker( "option", "maxDate", selectedDate );
        }      
    });

	var array_autocompletes = [];

	function geolocate(num_autocomplete) {
	    if(navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(function(position) {
	            var geolocation = new google.maps.LatLng( position.coords.latitude, position.coords.longitude );
	            array_autocompletes[num_autocomplete - 1].setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
	        });
	    }
	}
	function initialize_autocomplete_and_listener(num_autocomplete){
	    array_autocompletes[num_autocomplete - 1] = new google.maps.places.Autocomplete(
	        (document.getElementById('autocomplete' + num_autocomplete )),
	        { types: ['geocode'] }
	    );
	 
	    google.maps.event.addListener(array_autocompletes[num_autocomplete - 1], 'place_changed', function() {
	        var place = array_autocompletes[num_autocomplete - 1].getPlace();
	        jQuery('#lat-autocomplete'+num_autocomplete).val(place.geometry.location.lat());
	        jQuery('#lng-autocomplete'+num_autocomplete).val(place.geometry.location.lng());
	    });
	}

	jQuery("input[type=file]").change(function(){
		var fileName = jQuery('input[type=file]').val();
		fileName = fileName.toUpperCase();
		fileName = fileName.replace('C:\\FAKEPATH\\', '');
		jQuery("#file-name").html(fileName);
	});

</script>