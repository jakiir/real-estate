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
			<li><a class="btn-extra-large" href="<?php echo home_url('/completed-inspections/'); ?>">Manage Company</a></li>
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
