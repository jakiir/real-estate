<?php
/**
 * Template Name: Ajax Login
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

get_header('login'); 
if (is_user_logged_in()) {
	$user = wp_get_current_user();
	if(!empty($user) && $user->roles[0] == 'administrator' && !empty($user) || $user->roles[0] == 'company_admin'){
		$siteUrl = home_url('/landing-page/');
		wp_redirect( $siteUrl );
	} else {
		$siteUrl = home_url('/perform-inspection/');
		wp_redirect( $siteUrl );
	}
}
?>

<!-- BLOG -->
	<section class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
			<?php if (!is_user_logged_in()) { ?>
				<div class="box perform-inspection-box">
					  <h2 class="page-title-body">Site Login</h2>
					  <div class="login_message" style="display:none;"></div>
					<div class="card card-container" style="margin-top:15px;">						
						<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
						<p id="profile-name" class="profile-name-card"></p>
						<form id="login" action="login" method="post" class="form-signin">
							<span id="reauth-email" class="reauth-email"></span>
							<input type="text" id="username" class="form-control" placeholder="Username" required autofocus>
							<input type="password" id="password" class="form-control" placeholder="Password" required>
							<div id="remember" class="checkbox">
								<label>
									<input type="checkbox" value="remember-me"> Remember me
								</label>
							</div>
							<button class="btn-taptap submit_button" type="submit">Sign in</button>
							<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
						</form><!-- /form -->
						<a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">Forgot the password?</a>
					</div><!-- /card-container -->						
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php get_footer('login');
