<?php
/**
 * Template Name: Company Registration
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
	if(!empty($user) && $user->roles[0] != 'administrator' && !empty($user) && $user->roles[0] != 'company_admin'){
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<article class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box perform-inspection-box">
				<h2 class="page-title-body">Company Registration</h2>
				<div class="panel-body">
					<form class="form-horizontal" method="post" id="company_registration" action="#">
						<div class="form-group">
							<label for="registration_as" class="cols-sm-2 control-label">Registration As</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
									<select name="registration_as" id="registration_as" class="form-control" <?php if(!empty($user) && $user->roles[0] == 'administrator'){ ?> onchange="regisrationAs(this)" <?php } ?>>
										<?php if(!empty($user) && $user->roles[0] == 'administrator'){ ?>
											<option value="new_company">New Company Admin</option>
										<?php } ?>
										<option value="company_admin">Company Admin</option>
										<option value="inspector">Inspector</option>										
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="company_name" class="cols-sm-2 control-label">Company Name</label>
							<?php if(!empty($user) && $user->roles[0] == 'administrator'){ ?>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
										<span id="company_as">
										<input type="text" class="form-control required" name="company_name" id="company_name"  placeholder="Enter company name"/>
										</span>
									</div>
								</div>
							<?php } if(!empty($user) && $user->roles[0] == 'company_admin'){ 
							$company_name = get_user_meta( $user->ID, 'company_name', true );
							?>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
										<input type="text" class="form-control required" name="company_name_d" value="<?php echo $company_name; ?>" disabled="disabled"/>
										<input type="hidden" name="company_name" id="company_name" value="<?php echo $user->ID; ?>"/>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="form-group">
							<label for="user_fullname" class="cols-sm-2 control-label">User Full Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-group" aria-hidden="true"></i></span>
									<input type="text" class="form-control required" name="user_fullname" id="user_fullname"  placeholder="Enter user fullname"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="email_address" class="cols-sm-2 control-label">User Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control required" name="email_address" id="email_address"  placeholder="Enter user Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="company_username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
									<input type="text" class="form-control required" name="company_username" id="company_username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="licence_number" class="cols-sm-2 control-label">Lic #</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-barcode" aria-hidden="true"></i></span>
									<input type="text" class="form-control required" name="licence_number" id="licence_number"  placeholder="Enter License Number"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="phone_number" class="cols-sm-2 control-label">Phone Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
									<input type="text" class="form-control required" name="phone_number" id="phone_number"  placeholder="Enter Phone Number"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="company_password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control required" name="company_password" id="company_password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm_pass" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control required" name="confirm_pass" id="confirm_pass"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>
						<?php wp_nonce_field('company_new_user','company_new_user_nonce', true, true ); ?>
						<div class="form-group ">
							<button type="submit" class="btn-taptap"><i class="fa fa-share-square"></i> Register</button>
							<span class="msg_show"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
<?php if(!empty($user) && $user->roles[0] == 'administrator'){ ?>
function regisrationAs(thisVal){
	var selected_val = thisVal.value;
	if(selected_val == 'new_company'){
		$('#company_as').html('<input type="text" class="form-control required" name="company_name" id="company_name"  placeholder="Enter company name"/>');
	} else {
		var html = '<select name="company_name" id="company_name" class="form-control">';
		<?php
			$args1 = array(
				 'role' => 'company_admin',
				 'orderby' => 'user_nicename',
				 'order' => 'ASC'
			);
			 $company_users = get_users($args1);		
			if(!empty($company_users)) {
			foreach($company_users as $company_user){
				$company_name = get_user_meta( $company_user->ID, 'company_name', true );
				if(!empty($company_name)){
		?>
		html = html + '<option value="<?php echo $company_user->ID; ?>"><?php echo $company_name; ?></option>';
			<?php } } } ?>
		html = html + '</select>';
		$('#company_as').html(html);
	}
}
<?php } ?>
$(document).ready(function() {
	$("#company_registration").validate();
	$(document).on("click", ":submit", function(e) {
		e.preventDefault()
			$('.msg_show').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
			var formValid = $("#company_registration").valid();
			// Collect data from inputs
			
			var thisForm = $(this);
			if (formValid === true) {
				var reg_nonce = $('#company_new_user_nonce').val();
				var registration_as  = $('#registration_as').val();
				var company_name  = $('#company_name').val();
				var user_fullname  = $('#user_fullname').val();
				var email_address  = $('#email_address').val();
				var licence_number  = $('#licence_number').val();
				var phone_number  = $('#phone_number').val();
				var company_username  = $('#company_username').val();
				var company_password  = $('#company_password').val();
				var confirm_pass  = $('#confirm_pass').val();				
				if(company_password !== confirm_pass){
					$('.msg_show').html('<span style="color:red">Both password mismatch!</span>');
					return false;
				}
				
				var form_data = new FormData();
				form_data.append('action', 'company_registration_clb');
				form_data.append('nonce', reg_nonce);
				form_data.append('registration_as', registration_as);
				form_data.append('company_name', company_name);
				form_data.append('user_fullname', user_fullname);
				form_data.append('email_address', email_address);
				form_data.append('company_username', company_username);
				form_data.append('licence_number', licence_number);
				form_data.append('phone_number', phone_number);
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
