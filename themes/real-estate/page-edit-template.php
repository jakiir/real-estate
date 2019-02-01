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
		if(!empty($user) && $user->roles[0] != 'administrator' && !empty($user) && $user->roles[0] != 'company_admin'){
			echo '<script>window.location.replace("'.home_url().'");</script>';
			die('You have no access right! Please contact system administration for more information.!');
		}
	} else {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<style>
	#profilePicRemover{
		position: absolute;
		top: 33px;
		right: 22px;
	}
	label.error{color:red;}
</style>
<?php
	global $wpdb;
	$table_template = $wpdb->prefix . 'template';					
	$template_id = !empty($_GET['item']) ? $_GET['item'] : '';
	if(empty($template_id)) die('You have to select a template first');
	$get_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
	if(empty($get_templages)) die('You have to select a template first');					
?>
<article class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <div class="box edit-template-box">
				<?php $new_item = !empty($_GET['new_item']) ? $_GET['new_item'] : ''; ?>
              <h2 class="page-title-body"><?php if($new_item){ echo 'Add Template'; } else { echo 'Edit Templates'; } ?></h2>
              <form class="edit-template-form" id="edit_template" enctype="multipart/form-data" method="post">
			  <input type="hidden" name="template_id" id="template_id" value="<?php echo (isset($_GET['item']) ? $_GET['item'] : ''); ?>">
                <div class="row">
                  <div class="col-sm-6 col-sm-push-6 text-center">
                    <div class="edit-template-img" id="hsc_std_photo">
					  <?php $defaultImage = esc_url( get_template_directory_uri() ).'/images/edit-template-default.png'; ?>
                      <img alt="img" src="<?php echo !empty($get_templages[0]->logo_url) ? $get_templages[0]->logo_url : $defaultImage; ?>" class="avatar img-responsive" id="preview_image">
                    </div>
                    <!-- End of edit-template-img -->
                    <label class="btn-file-upload" for="template_logo">Browse</label>
                    <input type="file" name="photo" <?php echo !empty($get_templages[0]->logo_url) ? '' : 'required'; ?>" name="template_logo" id="template_logo" onchange="instantPhotoUpload(this)"/>
					
                  </div>
                  <!-- End of col -->
                  <div class="col-sm-6 col-sm-pull-6">
                    <label for="template_name">Name</label>
                    <input type="text" class="form-control required" name="template_name" id="template_name" value="<?php echo !empty($get_templages[0]->name) ? $get_templages[0]->name : ''; ?>" placeholder="Name">
                    <div class="share-checkbox">
                      <input type="checkbox" name="template_share" id="template_share" <?php echo !empty($get_templages[0]->shared_flag) && $get_templages[0]->shared_flag == 'true' ? 'checked' : ''; ?> ><label for="template_share">Share</label>
                    </div>
					<div class="clearfix" style="clear:both;">&nbsp;</div>
                    <label for="template_state">State</label>
					<select id="template_state" name="template_state" class="form-control required" >
					  <option value="texas">Texas</option>
					  <option value="Alaska">Alaska</option>
					  <option value="Pacific Time (US &amp; Canada)">Canada</option>
					  <option value="Arizona">Arizona</option>									  
					  <option value="Indiana">Indiana</option>
					</select>
                    <label for="template_state_id">State ID</label>
                    <input type="text" class="form-control required" name="template_state_id" id="template_state_id" value="<?php echo !empty($get_templages[0]->state_form) ? $get_templages[0]->state_form : ''; ?>" placeholder="AK">
                    <label for="template_date">Date</label>
                    <input type="text" class="form-control datepicker required" name="template_date" id="template_date" value="<?php echo !empty($get_templages[0]->template_date) ? $get_templages[0]->template_date : ''; ?>" placeholder="Date">
                    <label for="template_company">Company</label>
                    <input type="text" class="form-control required" name="template_company" id="template_company" value="<?php echo !empty($get_templages[0]->companyId) ? $get_templages[0]->companyId : ''; ?>" placeholder="Company">
                  </div>
				<div class="col-sm-12">
					<div class="share-checkbox">
					  <input type="checkbox" name="share_btn" id="share_btn" <?php echo !empty($get_templages[0]->share_btn) && $get_templages[0]->share_btn == 'true' ? 'checked' : ''; ?> ><label for="share_btn">Enable share this</label>
					</div>
					<div class="share-checkbox">
					  <input type="checkbox" name="print_btn" id="print_btn" <?php echo !empty($get_templages[0]->print_btn) && $get_templages[0]->print_btn == 'true' ? 'checked' : ''; ?> ><label for="print_btn">Enable Print</label>
					</div>
				</div>
				<div class="clearfix" style="clear:both;">&nbsp;</div>
                  <!-- End of col -->
                  <div class="col-sm-12">
                    <label for="footer_template">Footer</label>
                    <textarea class="form-control required" rows="3" cols="80" name="footer_template" id="footer_template"><?php echo !empty($get_templages[0]->footer_html) ? $get_templages[0]->footer_html : ''; ?></textarea>
                    <div class="text-right">
						<span class="msg_show"></span>
                      <button type="submit" name="order_type" class="btn-order-fill save_btn btn-taptap" value="customize">
					  <i class="fa fa-building" aria-hidden="true"></i> Customize
					  </button>
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
		$("#edit_template").validate();
		$(document).on("click", ":submit", function(e) {
			$('.msg_show').html('<span class="font_icon"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i></span>');
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
				var template_share= jQuery('#template_share').is(':checked');
				var share_btn= jQuery('#share_btn').is(':checked');
				var print_btn= jQuery('#print_btn').is(':checked');
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
				form_data.append('share_btn', share_btn);
				form_data.append('print_btn', print_btn);
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
						  $('.msg_show').html('<span class="font_icon success_icon">'+parsedJson.mess+'</span>');
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
