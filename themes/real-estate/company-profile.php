<?php
/**
 * Template Name: Company Profile
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
	
	$user = wp_get_current_user();
	if(!empty($user) && $user->roles[0] != 'administrator' && !empty($user) && $user->roles[0] != 'company_admin' && !empty($user) && $user->roles[0] != 'inspector'){
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<article class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box perform-inspection-box">
				<h2 class="page-title-body">Company Profile</h2>
				<div class="panel-body">
					<form class="form-horizontal" method="post" id="company_profile" action="#">
						<?php
							$company_name = get_user_meta( $user->ID, 'company_name', true );
							if(!empty($company_name)){
						?>
						<div class="form-group">
							<label for="company_name" class="cols-sm-2 control-label">Company Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="company_name_d" value="<?php echo $company_name; ?>" placeholder="Enter company name"/>
									<input type="hidden" name="company_name" id="company_name" disabled="disabled" value="<?php echo $user->ID; ?>"/>
								</div>
							</div>							
						</div>
						<?php } ?>
						<div class="form-group">
							<label for="user_fullname" class="cols-sm-2 control-label">User Full Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-group" aria-hidden="true"></i></span>
									<input type="text" class="form-control required" name="user_fullname" id="user_fullname"  value="<?php echo $user->display_name; ?>" placeholder="Enter user fullname"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="email_address" class="cols-sm-2 control-label">User Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control required" name="email_address" id="email_address"  value="<?php echo $user->user_email; ?>" disabled="disabled" placeholder="Enter user Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="company_username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
									<input type="text" class="form-control required" name="company_username" id="company_username" value="<?php echo $user->user_login; ?>" disabled="disabled" placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="company_password" class="cols-sm-2 control-label">New Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="company_password" id="company_password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm_pass" class="cols-sm-2 control-label">Confirm New Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm_pass" id="confirm_pass"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>
						<?php wp_nonce_field('company_profile_update','company_update_user_nonce', true, true ); ?>
						<div class="form-group ">
							<button type="submit" class="btn-taptap"><i class="fa fa-edit"></i> Update</button>
							<span class="msg_show"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function() {
	$("#company_profile").validate();
	$(document).on("click", ":submit", function(e) {
		e.preventDefault()
			$('.msg_show').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
			var formValid = $("#company_profile").valid();
			// Collect data from inputs
			
			var thisForm = $(this);
			if (formValid === true) {
				var reg_nonce = $('#company_update_user_nonce').val();
				var user_fullname  = $('#user_fullname').val();
				var company_password  = $('#company_password').val();
				var confirm_pass  = $('#confirm_pass').val();				
				if(company_password !== confirm_pass){
					$('.msg_show').html('<span style="color:red">Both password mismatch!</span>');
					return false;
				}
				
				var form_data = new FormData();
				form_data.append('action', 'company_profile_clb');
				form_data.append('nonce', reg_nonce);
				form_data.append('user_fullname', user_fullname);
				form_data.append('company_password', company_password);
				form_data.append('confirm_pass', confirm_pass);
				
				$.ajax({					
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					contentType: false,
					processData: false,
					data : form_data,					
					success: function (response) {
					  var parsedJson = $.parseJSON(response);
					  if(parsedJson.success == true){						  
						  $('.msg_show').html('');
						  $('.msg_show').html('<span style="color:green">'+parsedJson.mess+'</span>');
						  window.location = "<?php echo home_url('/company-management/'); ?>";
						  //location.reload();
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
			} else {
				$('.msg_show').html('<span style="color:red">Required field must be filled up!</span>');
			}			
			return false;
			
		});
	
});
</script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/main.js"></script>
<?php //get_footer();
