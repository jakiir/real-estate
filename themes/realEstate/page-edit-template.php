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

<style>
	#profilePicRemover{
		position: absolute;
		top: 2px;
		right: 22px;
	}
	label.error{color:red;}
</style>

<!-- PAGE HEADER -->
<section id="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h1><?php the_title(); ?></h1>
					<span class="st-border"></span>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /PAGE HEADER -->

<!-- BLOG -->
	<section id="blog">
		<div class="container">
			<div class="panel panel-primary">						
				<div class="panel-heading">
				  <h1 class="panel-title">Edit Template</h1>
				</div>
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
									  <input class="form-control required" type="text" name="template_name" id="template_name" value="">
									</div>
								  </div>
								  
								  <div class="form-group">
									<div class="col-lg-8 col-lg-offset-3" for="template_share">
									 <label><input type="checkbox" name="template_share" id="template_share" class="required"> Share</label>
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
									  <input class="form-control required" type="text" name="template_state_id" id="template_state_id" value="">
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-lg-3 control-label" for="template_date">Date:</label>
									<div class="col-lg-8">
									  <input class="form-control datepicker required" type="text" name="template_date" id="template_date" value="">
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-lg-3 control-label" for="template_company">Company:</label>
									<div class="col-lg-8">
									  <input class="form-control required" type="text" name="template_company" id="template_company" value="">
									</div>
								  </div>							
							  </div>
							  
							  <!--Right panel-->
							  <div class="col-md-3">
								<div class="text-center" id="hsc_std_photo">
								  <img src="//placehold.it/200" class="avatar img-responsive" id="preview_image" alt="avatar">
								  <h6>Upload a different photo...</h6>
								  
								  <input type="file" class="form-control required" name="template_logo" id="template_logo" onchange="instantPhotoUpload(this)">
								</div>
							  </div>
							  
							  <div class="col-md-12">
								<div class="form-group">
									<label for="footer_template" class="col-lg-1 control-label col-lg-offset-1">Footer:</label>
									<div class="col-lg-9">
									  <textarea class="form-control required" rows="3" name="footer_template" id="footer_template"></textarea>
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-md-2 col-lg-offset-8 control-label"></label>
									<div class="col-md-2">
										<button type="submit" name="order_type" class="btn-order-fill save_btn btn btn-primary" value="customize">
										 <i class="fa fa-refresh fa-spin" aria-hidden="true" style="display: none;"></i>
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
		$('.datepicker').datetimepicker({});
		$("#edit_template").validate();
		$(document).on("click", ":submit", function(e) {
			var formValid = $("#edit_template").valid();
			var thisForm = $(this);
			thisForm.find(".fa-refresh").css("display", "inline-block");
			
			/*var allFormField = $("#edit_template").find('input, textarea, select');			
			var values = {};
			allFormField.each(function () {
				values[this.name] = $(this).val();
			});*/
			
			
			if (formValid === false) {
				alert('required field must be fill up!');
				thisForm.find(".fa-refresh").css("display", "none");
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
						  alert(parsedJson.mess);
						  window.location.href = "<?php echo home_url('/form-builder/?item='); ?>"+template_id;
					  } else {
						alert(parsedJson.mess);
					  }
					},
					error: function (errorThrown) {
						alert(errorThrown);
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
