<?php
/**
 * Template Name: Perform inspection
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<?php 
	if (!is_user_logged_in()) {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<style>
	#profilePicRemover{
		position: absolute;
		top: 2px;
		right: 22px;
	}
	label.error{color:red;}
</style>
<?php
	global $wpdb;
	$user_id = get_current_user_id();
	$user = wp_get_current_user();
	$table_inspection = $wpdb->prefix . 'inspection';			
	$get_inspection = $wpdb->get_row( "SELECT * FROM $table_inspection WHERE user_id=$user_id ORDER BY id DESC LIMIT 1");
	
	$company_name = get_user_meta( $user_id, 'company_name', true );
	if(empty($company_name)){
		$parent_company_id = get_user_meta( $user_id, 'parrent_user', true );
		$company_name = get_user_meta( $parent_company_id, 'company_name', true );
	}
?>
<article class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <div class="box perform-inspection-box">
              <h2 class="page-title-body">Perform Inspection</h2>
              <form class="perform-inspection-form" id="inspection_form" action="" enctype="multipart/form-data" method="post">
                <div class="row">
					<div class="col-sm-12">
					<?php 
					if(!empty($user) && $user->roles[0] != 'administrator'){
						$parrent_user = get_the_author_meta( 'parrent_user', $user_id );						
						if(empty($parrent_user)) $parrent_user = $user_id;
						$users = get_users(array(
							'meta_key'     => 'parrent_user',
							'meta_value'   => $parrent_user,
							'meta_compare' => '=',
						));
						$user_all[] = $parrent_user;
						if(!empty($users)){
							foreach($users as $company_user){
								$user_all[] = $company_user->ID;
							}
						}
						$selected_user = implode(',',$user_all);
						$table_template = $wpdb->prefix . 'template';						
						$get_share_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE user_id IN ($selected_user) AND your_template=1  ORDER BY created_time ASC", OBJECT );
					} else {
						$table_template = $wpdb->prefix . 'template';
						$get_share_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE your_template=1  ORDER BY created_time ASC", OBJECT );
					}
					?>
                    <label for="template_id">Template</label>
					<select id="template_id" name="template_id" class="form-control required" >
					  <option value="">List of Template</option>
					  <?php if(!empty($get_share_templages)){
							foreach($get_share_templages as $template){
							?>
							<option data-wood="<?php echo $template->wood_inspection; ?>" value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
						<?php } } ?>
					</select>
                  </div>
				  <div id="wood_field" style="display:none;">
					  <div class="col-sm-12">
						<label for="inspector_type">Inspector Type</label>
						<div class="share-checkbox">
						  <input type="checkbox" id="checkbox-technician" name="inspector_type" value="Technician"><label for="checkbox-technician">Technician</label>
						  <input type="checkbox" id="checkbox-certified" name="inspector_type" value="Certified Applicator"><label for="checkbox-certified">Certified Applicator</label>
						</div>
					  </div>
					  <div class="col-sm-12">
						<label for="case_number">Case Number</label>
						<div class="share-checkbox">
						  <input type="checkbox" id="checkbox-va" name="case_number" value="VA"><label for="checkbox-va">VA</label>
						  <input type="checkbox" id="checkbox-fha" name="case_number" value="FHA"><label for="checkbox-fha">FHA</label>
						  <input type="checkbox" id="checkbox-other" name="case_number" value="Other"><label for="checkbox-other">Other</label>
						</div>
					  </div>
					  <div class="col-sm-12">
						<label for="inspection_buyer_name">Inspection Buyer Name</label>
						<input type="text" class="form-control" name="inspection_buyer_name" id="inspection_buyer_name">
					  </div>
					  <div class="col-sm-12">
						<label for="inspection_buyer_type">Inspection Buyer Type</label>
						<div class="share-checkbox">
						  <input type="checkbox" id="buyer-checkbox-seller" name="inspection_buyer_type" value="Seller"><label for="buyer-checkbox-seller">Seller</label>
						  <input type="checkbox" id="buyer-checkbox-agent" name="inspection_buyer_type" value="Agent"><label for="buyer-checkbox-agent">Agent</label>
						  <input type="checkbox" id="buyer-checkbox-buyer" name="inspection_buyer_type" value="Buyer"><label for="buyer-checkbox-buyer">Buyer</label>
						  <input type="checkbox" id="buyer-checkbox-management_co" name="inspection_buyer_type" value="Management Co"><label for="buyer-checkbox-management_co">Management Co</label>
						  <input type="checkbox" id="buyer-checkbox-other" name="inspection_buyer_type" value="Other"><label for="buyer-checkbox-other">Other</label>
						</div>
					  </div>
					  <div class="col-sm-12">
						<label for="owner_type">Owner Type</label>
						<div class="share-checkbox">
						  <input type="checkbox" id="owner-checkbox-seller" name="owner_type" value="Seller"><label for="owner-checkbox-seller">Seller</label>
						  <input type="checkbox" id="owner-checkbox-owner" name="owner_type" value="Owner"><label for="owner-checkbox-owner">Owner</label>
						</div>
					  </div>
					  <div class="col-sm-12">
						<label for="report_forwarded_to">Report Forwarded To</label>
						<div class="share-checkbox">
						  <input type="checkbox" id="forwarded-checkbox-mortgage" name="report_forwarded_to" value="Title Company or Mortgage"><label for="forwarded-checkbox-mortgage">Title Company or Mortgage</label>
						  <input type="checkbox" id="forwarded-checkbox-purchaser" name="report_forwarded_to" value="Purchaser of Service"><label for="forwarded-checkbox-purchaser">Purchaser of Service</label>
						  <input type="checkbox" id="forwarded-checkbox-seller" name="report_forwarded_to" value="Seller"><label for="forwarded-checkbox-seller">Seller</label>
						  <input type="checkbox" id="forwarded-checkbox-agent" name="report_forwarded_to" value="Agent"><label for="forwarded-checkbox-agent">Agent</label>
						  <input type="checkbox" id="forwarded-checkbox-buyer" name="report_forwarded_to" value="Buyer"><label for="forwarded-checkbox-buyer">Buyer</label>
						</div>
					  </div>
					  
					  <?php /* ?><div class="col-sm-12">
						<label for="notice_inspection">Notice of Inspection Was Posted At or Near</label>
						<div class="share-checkbox">
						  <input type="checkbox" id="notice-checkbox-electric" name="notice_inspection" value="Electric Breaker Box"><label for="notice-checkbox-electric">Electric Breaker Box</label>
						  <input type="checkbox" id="notice-checkbox-beneath" name="notice_inspection" value="Water Heater Closet Beneath"><label for="notice-checkbox-beneath">Water Heater Closet Beneath</label>
						  <input type="checkbox" id="notice-checkbox-access" name="notice_inspection" value="Bath Trap Access"><label for="notice-checkbox-access">Bath Trap Access</label>
						  <input type="checkbox" id="notice-checkbox-kitchen" name="notice_inspection" value="Beneath the Kitchen Sink"><label for="notice-checkbox-kitchen">Beneath the Kitchen Sink</label>
						</div>
					  </div><?php */ ?>
					  <div class="col-sm-12">
						<label for="list_structure">List structure(s) </label>
						<textarea class="form-control" rows="2" name="list_structure" id="list_structure"></textarea>
					  </div>
				  </div>
                  <!-- End of col -->
                  <div class="col-sm-6">
                    <label for="company">Company</label>
                    <input type="text" class="form-control required" name="company" id="company" value="<?php echo $company_name; ?>" <?php if(!empty($user) && $user->roles[0] != 'administrator'){ ?>readonly="readonly" <?php } ?> placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-6">
                    <label for="inpection_date">Date</label>
                    <input type="text" class="form-control datepicker required" name="inpection_date" id="inpection_date" placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-12">
                    <label for="report_identification">Property Address</label>
                    <input type="text" class="form-control required" name="report_identification" id="report_identification" placeholder="">
                  </div>
				  <!-- End of col -->
                  <div class="col-sm-12">
                    <label for="inspection_city">City</label>
                    <input type="text" class="form-control required" name="inspection_city" id="inspection_city" placeholder="">
                  </div>
				  <!-- End of col -->
                  <div class="col-sm-12">
                    <label for="zip_code">Zip Code</label>
                    <input type="text" class="form-control required" name="zip_code" id="zip_code" placeholder="">
                  </div>
                  <!-- End of col -->
				  <?php /*?><div class="col-sm-12">
                    <label for="building_orientation">Building Orientation</label>
                    <input type="text" class="form-control required" name="building_orientation" id="building_orientation" placeholder="">
                  </div>
                  <!-- End of col -->
				  <div class="col-sm-12">
                    <label for="weather_conditions">Weather Conditions</label>
					<div class="share-checkbox">
                      <input type="checkbox" id="checkbox-sunny" name="weather_conditions" value="Sunny"><label for="checkbox-sunny">Sunny</label>
                      <input type="checkbox" id="checkbox-raining" name="weather_conditions" value="Raining"><label for="checkbox-raining">Raining</label>
					  <input type="checkbox" id="checkbox-cloudy" name="weather_conditions" value="Cloudy"><label for="checkbox-cloudy">Cloudy</label>
                      <input type="checkbox" id="checkbox-Snow-Ice" name="weather_conditions" value="Snow/Ice"><label for="checkbox-Snow-Ice">Snow/Ice</label>
                    </div>
					
                    <!-- End of status-radios -->
                  </div>
				  <!-- End of col -->
				  <div class="col-sm-12">
                    <label for="temperature">Temperature</label>
                    <input type="text" class="form-control required" name="temperature" id="temperature" placeholder="">
                  </div>
                  <!-- End of col -->
				  <div class="col-sm-12">
                    <label>Parties Present</label>
					<div class="share-checkbox">
                      <input type="checkbox" id="checkbox-client" name="parties_present" value="Client">
					  <label for="checkbox-client">Client</label>
                      <input type="checkbox" id="checkbox-buyer-realtor" name="parties_present" value="Buyer’s Realtor">
					  <label for="checkbox-buyer-realtor">Buyer’s Realtor</label>
					  <input type="checkbox" id="checkbox-builder" name="parties_present" value="Builder"><label for="checkbox-builder">Builder</label>
                      <input type="checkbox" id="checkbox-seller" name="parties_present" value="Seller"><label for="checkbox-seller">Seller</label>
					  <input type="checkbox" id="checkbox-none" name="parties_present" value="None"><label for="checkbox-none">None</label>
                    </div>
					
                  </div><?php */ ?>
                  <!-- End of col -->                  
                  <div class="col-sm-12">
                    <label for="prepared_for">Prepared for</label>
                    <input type="text" class="form-control required" name="prepared_for" id="prepared_for" placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-4">
                    <label for="prepared_by">Prepared By</label>
                    <input type="text" class="form-control required" name="prepared_by" id="prepared_by" readonly="readonly" value="<?php echo $user->display_name; ?>">
                  </div>
				  <div class="col-sm-4">
                    <label for="licence_number">Lic #</label>
					<?php $licence_number = get_user_meta($user->ID,  'licence_number', true ); ?>
                    <input type="text" class="form-control" name="licence_number" id="licence_number" readonly="readonly" value="<?php echo $licence_number; ?>">
                  </div>
				  <div class="col-sm-4">
                    <label for="phone_number">Phone Number</label>
					<?php $phone_number = get_user_meta($user->ID,  'phone_number', true ); ?>
                    <input type="text" class="form-control" name="phone_number" id="phone_number" readonly="readonly" value="<?php echo $phone_number; ?>">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-6">
                    <label for="time_in">Time In</label>
                    <input type="text" class="form-control required timepicker" name="time_in" id="time_in" placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-6">
                    <label for="time_out">Time Out</label>
                    <input type="text" class="form-control required timepicker" name="time_out" id="time_out" placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-12">
                    <div class="status-radios">
                      <input type="radio" id="radio-occupied" name="inspection_status" value="occupied"><label for="radio-occupied">occupied</label>
                      <input type="radio" id="radio-vacant" name="inspection_status" value="vacant"><label for="radio-vacant">Vacant</label>
                    </div>
                    <!-- End of status-radios -->
                  </div>
				  <div class="col-sm-12">
					<div class="edit-cover-img" id="hsc_std_photo">
					  <?php $defaultImage = esc_url( get_template_directory_uri() ).'/images/edit-template-default.png'; ?>
                      <img alt="img" src="<?php echo $defaultImage; ?>" class="avatar img-responsive" id="preview_image" style="height:208px;">
                    </div>
                    <label class="btn-file-upload" for="template_cover_logo" style="margin-top:5px;margin-bottom:30px;">Upload Cover Photo</label>
                    <input type="file" name="photo" "="" id="template_cover_logo" onchange="instantPhotoUpload(this)">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-12">
                    <div class="text-center">
                      <input type="submit" name="order_type" class="btn-taptap" value="Next">
                    </div>
                  </div>
                  <!-- End of col -->
                </div>
                <!-- End of row -->
              </form>
            </div>
            <!-- End of box -->
          </div>
          <!-- End of col -->
        </div>
        <!-- End of row -->
      </article>
      <!--End of container-->
<script type="text/javascript">
jQuery(function($){
	
	$('select#template_id').on('change', function() {
		var woodIns = $('option:selected', this).attr('data-wood');
		$('#wood_field').hide();
		if(woodIns == 'true'){
			$('#wood_field').show();
		}
	});
	
	$('.datepicker').datetimepicker({
		format: 'MM/DD/YYYY'
	});
	$('.timepicker').datetimepicker({
		format: 'LT'
	});
	$("#inspection_form").validate();
	
	
	$(document).on("click", ":submit", function(e) {
			$('.msg_show').html('<span class="font_icon"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i></span>');
			var formValid = $("#inspection_form").valid();
			var thisForm = $(this);
			if (formValid === false) {				
				$('.msg_show').html('<span style="color:red">required field must be fill up!</span>');				
			} else {
				var template_id = jQuery('#template_id').find('option:selected').val();
				var company = jQuery('#company').val();
				var inpection_date = jQuery('#inpection_date').val();
				var inpection_date_arr = inpection_date.split("/");
				var inpection_date_new = inpection_date_arr[2] + "-" + inpection_date_arr[0] + "-" + inpection_date_arr[1];
				var report_identification = jQuery('#report_identification').val();	
				var building_orientation = '';//jQuery('#building_orientation').val();				
				//var weather_conditions = jQuery('input[name=weather_conditions]:checked').val();
				var weather_favorite = [];
				//$.each($("input[name='weather_conditions']:checked"), function(){            
					//weather_favorite.push($(this).val());
				//});
				var weather_conditions = '';//weather_favorite.join(", ");
				var temperature = '';//jQuery('#temperature').val();	
				//var parties_present = jQuery('#parties_present').val();				
				var parties_favorite = [];
				//$.each($("input[name='parties_present']:checked"), function(){            
					//parties_favorite.push($(this).val());
				//});
				var parties_present = '';//parties_favorite.join(", ");
				var inspection_city = jQuery('#inspection_city').val();				
				var zip_code = jQuery('#zip_code').val();
				var prepared_for = jQuery('#prepared_for').val();				
				var prepared_by = jQuery('#prepared_by').val();				
				var time_in = jQuery('#time_in').val();				
				var time_out = jQuery('#time_out').val();				
				var inspection_status = $('input[name=inspection_status]:checked').val();
				
				var inspector_types = [];
				$.each($("input[name='inspector_type']:checked"), function(){            
					inspector_types.push($(this).val());
				});
				var inspector_type = inspector_types.join(",");
				
				var case_numbers = [];
				$.each($("input[name='case_number']:checked"), function(){            
					case_numbers.push($(this).val());
				});
				var case_number = case_numbers.join(",");
				
				var inspection_buyer_types = [];
				$.each($("input[name='inspection_buyer_type']:checked"), function(){            
					inspection_buyer_types.push($(this).val());
				});
				var inspection_buyer_type = inspection_buyer_types.join(",");
				
				var owner_types = [];
				$.each($("input[name='owner_type']:checked"), function(){            
					owner_types.push($(this).val());
				});
				var owner_type = owner_types.join(",");
				
				var report_forwardeds = [];
				$.each($("input[name='report_forwarded_to']:checked"), function(){            
					report_forwardeds.push($(this).val());
				});
				var report_forwarded_to = report_forwardeds.join(",");
				
				var notice_inspections = [];
				$.each($("input[name='notice_inspection']:checked"), function(){            
					notice_inspections.push($(this).val());
				});
				var notice_inspection = notice_inspections.join(",");
				var inspection_buyer_name = jQuery('#inspection_buyer_name').val();
				var list_structure = $('textarea#list_structure').val();
				
				
				var file_data = $('#template_cover_logo').prop('files')[0];				
				var form_data = new FormData();
				
				form_data.append('action', 'perform_inspections');
				form_data.append('template_id', template_id);				
				form_data.append('company', company);
				form_data.append('inpection_date', inpection_date_new);
				form_data.append('report_identification', report_identification);
				form_data.append('inspection_city', inspection_city);
				form_data.append('zip_code', zip_code);
				form_data.append('building_orientation', building_orientation);
				form_data.append('weather_conditions', weather_conditions);
				form_data.append('temperature', temperature);
				form_data.append('parties_present', parties_present);
				form_data.append('prepared_for', prepared_for);
				form_data.append('prepared_by', prepared_by);				
				form_data.append('time_in', time_in);				
				form_data.append('time_out', time_out);				
				form_data.append('inspection_status', inspection_status);
				
				form_data.append('inspector_type', inspector_type);
				form_data.append('case_number', case_number);
				form_data.append('inspection_buyer_type', inspection_buyer_type);
				form_data.append('owner_type', owner_type);
				form_data.append('report_forwarded_to', report_forwarded_to);
				form_data.append('notice_inspection', notice_inspection);
				form_data.append('inspection_buyer_name', inspection_buyer_name);
				form_data.append('list_structure', list_structure);
				
				form_data.append('cover_photo', file_data);
				
				$.ajax({					
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					contentType: false,
					processData: false,
					data: form_data,					
					success: function (data) {
					  var parsedJson = $.parseJSON(data);					  
					  if(parsedJson.success == true){						  
						  $('.msg_show').html('');
						  $('.msg_show').html('<span class="font_icon success_icon">'+parsedJson.mess+'</span>');
						  window.location.href = "<?php echo home_url('/form-viewer/?item='); ?>"+template_id+'&report='+parsedJson.report_id;
					  } else {
						  $('.msg_show').html('');
						$('.msg_show').html('<span style="color:red">'+parsedJson.mess+'</span>');
					  }
					},
					error: function (errorThrown) {
						$('.msg_show').html('');
						$('.msg_show').html('<span style="color:red">'+errorThrown+'</span>');						
					}
				});
			}			
			return false;
			
		});
	
});

	var abc = 0; 
	function instantPhotoUpload(THIS){
		if (THIS.files && THIS.files[0]) {
			$('#profilePicRemover').remove();
			 abc += 1; //increementing global variable by 1		
			var z = abc - 1;
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(THIS.files[0]);
			$("#hsc_std_photo").append($("<img/>", {id: 'profilePicRemover', src: '<?php echo esc_url( get_template_directory_uri() ); ?>/images/remove.png', alt: 'delete'}).click(function() {
				$('#preview_image').attr('src', '<?php echo $defaultImage; ?>');
				$('#profilePicRemover').remove();
			}));
		}
	}
	function imageIsLoaded(e) {
		$('#preview_image').attr('src', e.target.result);
	}

</script>
<?php get_footer();
