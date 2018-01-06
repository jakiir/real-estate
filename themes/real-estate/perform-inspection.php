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
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
<style>
	#profilePicRemover{
		position: absolute;
		top: 2px;
		right: 22px;
	}
	label.error{color:red;}
</style>

<!-- BLOG -->
<section id="blog" class="container">
	<div class="panel panel-primary">						
		<div class="panel-heading">
		  <h1 class="panel-title"><?php the_title(); ?></h1>
		</div>				
		<div class="panel-body">
			<form class="form-horizontal" role="form" id="inspection_form" enctype="multipart/form-data">
			  <!-- edit form column -->
			  <div class="col-md-12 personal-info">							
				  <div class="form-group">
					<label class="col-lg-2 control-label" for="company">Company :</label>
					<div class="col-lg-4">
					  <input class="form-control required" type="text" name="company" id="company" value="">
					</div>
					
					<label class="col-lg-2 control-label" for="inpection_date">Date :</label>
					<div class="col-lg-4">
					  <input class="form-control datepicker required" type="text" name="inpection_date" id="inpection_date" value="">
					</div>							
				  </div>
				  <div class="form-group">
					<label class="col-lg-2 control-label" for="report_identification">Report Identification :</label>
					<div class="col-lg-10">
					  <input class="form-control required" type="text" name="report_identification" id="report_identification" value="">
					</div>
				  </div>						
				  
				  <div class="form-group">
					<label class="col-lg-2 control-label" for="template_id">Template :</label>
					<div class="col-lg-10">
					  <div class="ui-select">
						<select id="template_id" name="template_id" class="form-control required" >
						<?php
							global $wpdb;			
							$table_template = $wpdb->prefix . 'template';
							$get_share_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE shared_template=1", OBJECT );						
						?>
						  <option value="">List of Template</option>
						  <?php if(!empty($get_share_templages)){
								foreach($get_share_templages as $template){ ?>
								<option value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
							<?php } } ?>
						</select>
					  </div>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="col-lg-2 control-label" for="prepared_for">Prepared For :</label>
					<div class="col-lg-10">
					  <input class="form-control required" type="text" name="prepared_for" id="prepared_for" value="">
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="col-lg-2 control-label" for="prepared_by">Prepared By :</label>
					<div class="col-lg-10">
					  <input class="form-control required" type="text" name="prepared_by" id="prepared_by" value="">
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="col-lg-2 control-label" for="time_in">Time In :</label>
					<div class="col-lg-4">
					  <input class="form-control required timepicker" type="text" name="time_in" id="time_in" value="">
					</div>
					
					<label class="col-lg-2 control-label" for="time_out">Time Out :</label>
					<div class="col-lg-4">
					  <input class="form-control required timepicker" type="text" name="time_out" id="time_out" value="">
					</div>							
				  </div>
				  
				  <div class="form-group">					
					<div class="col-lg-10 col-lg-offset-2">
						<label class="redio-inline">
						  <input type="radio" name="inspection_status" value="ocuppied" checked> Ocuppied
						</label>
					</div>
					<div class="col-lg-10 col-lg-offset-2">
						<label class="redio-inline">
						  <input type="radio" name="inspection_status" value="vacant"> Vacant
						</label>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-md-9 msg_show"></label>
					<div class="col-md-3">
						<button type="submit" name="order_type" class="btn-order-fill save_btn btn btn-primary pull-right" value="Next">
						Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>
						</button>									  							  
					</div>
				  </div>
				</div>						  
			</form>						
		</div>
	</div>
</section>
	<!-- /BLOG -->
<script type="text/javascript">
jQuery(function($){
	$('.datepicker').datetimepicker({
		viewMode: 'years',
		format: 'DD/MM/YYYY'
	});
	$('.timepicker').datetimepicker({
		format: 'LT'
	});
	$("#inspection_form").validate();
	
	
	$(document).on("click", ":submit", function(e) {
			$('.msg_show').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
			var formValid = $("#inspection_form").valid();
			var thisForm = $(this);		
			
			if (formValid === false) {				
				$('.msg_show').html('<span style="color:red">required field must be fill up!</span>');				
			} else {
				var template_id = jQuery('#template_id').val();
				var company = jQuery('#company').val();
				var inpection_date = jQuery('#inpection_date').val();
				var report_identification = $('#report_identification').find('option:selected').val();				
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
						  $('.msg_show').html('<span style="color:green">'+parsedJson.mess+'</span>');
						  window.location.href = "<?php echo home_url('/form-viewer/?item='); ?>"+template_id;
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
