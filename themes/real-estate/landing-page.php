<?php
/**
 * Template Name: Landing Page
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

get_header('landing'); 
?>
  <article class="container">
	<div class="row">
	  <div class="col-sm-8 col-sm-offset-2">
		<div class="box home-box">
		  <ul>
			<?php 
			if (is_user_logged_in()) {
				$user = wp_get_current_user();
				if(!empty($user) && $user->roles[0] == 'administrator'){
			  ?>
			<li><a class="btn-extra-large" href="<?php echo home_url('/company-registration/'); ?>">Manage Company</a></li>
			<?php } } ?>
			<li><a class="btn-extra-large" href="<?php echo home_url('/perform-inspection/'); ?>">Perform Inspection</a></li>
		  </ul>
		</div>
		<!-- End of box -->
	  </div>
	  <!-- End of col -->
	</div>
	<!-- End of row -->
  </article>
  <!--End of container-->
<?php get_footer('landing');
