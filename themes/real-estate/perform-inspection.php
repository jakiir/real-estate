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
	$table_inspection = $wpdb->prefix . 'inspection';			
	$get_inspection = $wpdb->get_row( "SELECT * FROM $table_inspection WHERE user_id=$user_id ORDER BY id DESC LIMIT 1");
?>
<article class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <div class="box perform-inspection-box">
              <h2 class="page-title-body">Perform Inspection</h2>
              <form class="perform-inspection-form" id="inspection_form" action="" method="post">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="company">Company</label>
                    <input type="text" class="form-control required" name="company" id="company" placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-6">
                    <label for="inpection_date">Date</label>
                    <input type="text" class="form-control datepicker required" name="inpection_date" id="inpection_date" placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-12">
                    <label for="report_identification">Report Identification</label>
                    <input type="text" class="form-control required" name="report_identification" id="report_identification" placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-12">
					<?php 
					$user = wp_get_current_user();
					if(!empty($user) && $user->roles[0] != 'administrator'){
						$parrent_user = esc_attr( get_the_author_meta( 'parrent_user', $user_id ) );
						if(empty($parrent_user)) $parrent_user = $user_id;
						$users = get_users(array(
							'meta_key'     => 'parrent_user',
							'meta_value'   => $parrent_user,
							'meta_compare' => '=',
						));
						$user_all[] = $parrent_user;
						if(!empty($users)){
							foreach($users as $user){
								$user_all[] = $user->ID;
							}
						}
						$selected_user = implode(',',$user_all);
						$table_template = $wpdb->prefix . 'template';						
						$get_share_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE shared_template=1 AND user_id IN ($selected_user)", OBJECT );
					} else {
						$table_template = $wpdb->prefix . 'template';
						$get_share_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE shared_template=1", OBJECT );
					}
					?>
                    <label for="template_id">Template</label>
					<select id="template_id" name="template_id" class="form-control required" >
					  <option value="">List of Template</option>
					  <?php if(!empty($get_share_templages)){
							foreach($get_share_templages as $template){
							?>
							<option value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
						<?php } } ?>
					</select>
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-12">
                    <label for="prepared_for">Prepared for</label>
                    <input type="text" class="form-control required" name="prepared_for" id="prepared_for" placeholder="">
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-12">
                    <label for="prepared_by">Prepared By</label>
                    <input type="text" class="form-control required" name="prepared_by" id="prepared_by" placeholder="">
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
                      <input type="radio" id="radio-ocuppied" name="inspection_status" value="ocuppied"><label for="radio-ocuppied">Ocuppied</label>
                      <input type="radio" id="radio-vacant" name="inspection_status" value="vacant"><label for="radio-vacant">Vacant</label>
                    </div>
                    <!-- End of status-radios -->
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
	$('.datepicker').datetimepicker({
		viewMode: 'years',
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
				var report_identification = jQuery('#report_identification').val();				
				var prepared_for = jQuery('#prepared_for').val();				
				var prepared_by = jQuery('#prepared_by').val();				
				var time_in = jQuery('#time_in').val();
				var time_out = jQuery('#time_out').val();				
				var inspection_status = $('input[name=inspection_status]:checked').val();				
				var form_data = new FormData();
				
				form_data.append('action', 'perform_inspections');
				form_data.append('template_id', template_id);				
				form_data.append('company', company);
				form_data.append('inpection_date', inpection_date);
				form_data.append('report_identification', report_identification);
				form_data.append('prepared_for', prepared_for);
				form_data.append('prepared_by', prepared_by);				
				form_data.append('time_in', time_in);				
				form_data.append('time_out', time_out);				
				form_data.append('inspection_status', inspection_status);
				
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
</script>
<?php get_footer();
