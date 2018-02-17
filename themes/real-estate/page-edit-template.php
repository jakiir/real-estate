<?php
/**
 * Template Name: Edit Template Page 
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
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		if($user->roles[0] != 'administrator'){
			echo '<script>window.location.replace("'.home_url().'");</script>';
			die('You have no access right! Please contact system administration for more information.!');
		}
	} else {
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
	<section id="blog">
		<div class="container">
			<div class="panel panel-primary">						
				<div class="panel-heading">
				<?php $new_item = !empty($_GET['new_item']) ? $_GET['new_item'] : ''; ?>
				  <h1 class="panel-title"><?php if($new_item){ echo 'Add Template'; } else { the_title(); } ?></h1>
				</div>
				<?php
					global $wpdb;
					$table_template = $wpdb->prefix . 'template';					
					$template_id = !empty($_GET['item']) ? $_GET['item'] : '';
					if(empty($template_id)) die('You have to select a template first');
					$get_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
					if(empty($get_templages)) die('You have to select a template first');					
				?>
				<div class="panel-body">
					<div class="container">						
						<div class="row">
							<form class="form-horizontal" role="form" id="edit_template" enctype="multipart/form-data">							
							<input type="hidden" name="template_id" id="template_id" value="<?php echo (isset($_GET['item']) ? $_GET['item'] : ''); ?>">
							  <!-- edit form column -->
							  <div class="col-md-8 personal-info">							
								  <div class="form-group">
									<label class="col-lg-3 control-label" for="template_name">Name:</label>
									<div class="col-lg-8">
									  <input class="form-control required" type="text" name="template_name" id="template_name" value="<?php echo !empty($get_templages[0]->name) ? $get_templages[0]->name : ''; ?>">
									</div>
								  </div>
								  
								  <div class="form-group">
									<div class="col-lg-8 col-lg-offset-3" for="template_share">
									 <label><input type="checkbox" name="template_share" id="template_share" <?php echo !empty($get_templages[0]->shared_flag) && $get_templages[0]->shared_flag == 'on' ? 'checked' : ''; ?>> Share</label>
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-lg-3 control-label" for="template_state">State:</label>
									<div class="col-lg-8">
									  <div class="ui-select">
										<select id="template_state" name="template_state" class="form-control required" >
										  <option value="texas">Texas</option>
										  <option value="Alaska">Alaska</option>
										  <option value="Pacific Time (US &amp; Canada)">Canada</option>
										  <option value="Arizona">Arizona</option>									  
										  <option value="Indiana">Indiana</option>
										</select>
									  </div>
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-lg-3 control-label" for="template_state_id">State Id:</label>
									<div class="col-lg-8">
									  <input class="form-control required" type="text" name="template_state_id" id="template_state_id" value="<?php echo !empty($get_templages[0]->state_form) ? $get_templages[0]->state_form : ''; ?>">
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-lg-3 control-label" for="template_date">Date:</label>
									<div class="col-lg-8">
									  <input class="form-control datepicker required" type="text" name="template_date" id="template_date" value="<?php echo !empty($get_templages[0]->template_date) ? $get_templages[0]->template_date : ''; ?>">
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-lg-3 control-label" for="template_company">Company:</label>
									<div class="col-lg-8">
									  <input class="form-control required" type="text" name="template_company" id="template_company" value="<?php echo !empty($get_templages[0]->companyId) ? $get_templages[0]->companyId : ''; ?>">
									</div>
								  </div>							
							  </div>
							  
							  <!--Right panel-->
							  <div class="col-md-3">
								<div class="text-center" id="hsc_std_photo">
								  <img src="<?php echo !empty($get_templages[0]->logo_url) ? $get_templages[0]->logo_url : '//placehold.it/200'; ?>" class="avatar img-responsive" id="preview_image" alt="avatar">
								  <h6>Upload a different photo...</h6>
								  
								  <input type="file" class="form-control <?php echo !empty($get_templages[0]->logo_url) ? '' : 'required'; ?>" name="template_logo" id="template_logo" onchange="instantPhotoUpload(this)">
								</div>
							  </div>
							  
							  <div class="col-md-12">
								<div class="form-group">
									<label for="footer_template" class="col-lg-1 control-label col-lg-offset-1">Footer:</label>
									<div class="col-lg-9">
									  <textarea class="form-control required" rows="3" name="footer_template" id="footer_template"><?php echo !empty($get_templages[0]->footer_html) ? $get_templages[0]->footer_html : ''; ?></textarea>
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-md-9 col-lg-offset-1 control-label msg_show"></label>
									<div class="col-md-2">
										<button type="submit" name="order_type" class="btn-order-fill save_btn btn btn-primary" value="customize">
										<i class="fa fa-building" aria-hidden="true"></i>										 
										Customize
										</button>									  							  
									</div>
								  </div>
							  </div>
							</form>
					  </div>
					</div>
					<hr>
				</div>
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
		$("#edit_template").validate();
		$(document).on("click", ":submit", function(e) {
			$('.msg_show').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
			var formValid = $("#edit_template").valid();
			var thisForm = $(this);		
			
			/*var allFormField = $("#edit_template").find('input, textarea, select');			
			var values = {};
			allFormField.each(function () {
				values[this.name] = $(this).val();
			});*/
			
			
			if (formValid === false) {				
				$('.msg_show').html('<span style="color:red">required field must be fill up!</span>');				
			} else {
				var template_id = jQuery('#template_id').val();
				var template_name = jQuery('#template_name').val();
				var template_share = jQuery('#template_share').val();
				var template_state = $('#template_state').find('option:selected').val();				
				var template_state_id = jQuery('#template_state_id').val();				
				var template_date = jQuery('#template_date').val();				
				var template_company = jQuery('#template_company').val();
				var footer_template = jQuery('#footer_template').val();				
				var file_data = $('#template_logo').prop('files')[0];				
				var form_data = new FormData();
				
				form_data.append('action', 'editTemplateAction');
				form_data.append('template_id', template_id);				
				form_data.append('template_name', template_name);
				form_data.append('template_share', template_share);
				form_data.append('template_state', template_state);
				form_data.append('template_state_id', template_state_id);
				form_data.append('template_date', template_date);
				form_data.append('template_company', template_company);
				form_data.append('footer_template', footer_template);
				form_data.append('template_logo', file_data);
				
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
						  window.location.href = "<?php echo home_url('/form-builder/?item='); ?>"+template_id;
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
				$('#preview_image').attr('src', '//placehold.it/200');
				$('#profilePicRemover').remove();
			}));
		}
	}
	function imageIsLoaded(e) {
		$('#preview_image').attr('src', e.target.result);
	}
</script>

<?php get_footer();
