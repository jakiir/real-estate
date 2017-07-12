<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		<!-- FOOTER -->
	<footer id="footer">
		<div class="container">
			<div class="row">
				<!-- SOCIAL ICONS -->
				<div class="col-sm-6 col-sm-push-6 footer-social-icons">
					<span>Follow us:</span>
					<a href=""><i class="fa fa-facebook"></i></a>
					<a href=""><i class="fa fa-twitter"></i></a>
					<a href=""><i class="fa fa-google-plus"></i></a>
					<a href=""><i class="fa fa-pinterest-p"></i></a>
				</div>
				<!-- /SOCIAL ICONS -->
				<div class="col-sm-6 col-sm-pull-6 copyright">
					<p>&copy; 2015 <a href="">ShapedTheme</a>. All Rights Reserved.</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- /FOOTER -->


	<!-- Scroll-up -->
	<div class="scroll-up">
		<ul><li><a href="#header"><i class="fa fa-angle-up"></i></a></li></ul>
	</div>

	
	<!-- JS -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script><!-- jQuery -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script><!-- Bootstrap -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.parallax.js"></script><!-- Parallax -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/smoothscroll.js"></script><!-- Smooth Scroll -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/masonry.pkgd.min.js"></script><!-- masonry -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.fitvids.js"></script><!-- fitvids -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/owl.carousel.min.js"></script><!-- Owl-Carousel -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.counterup.min.js"></script><!-- CounterUp -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/waypoints.min.js"></script><!-- CounterUp -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.isotope.min.js"></script><!-- isotope -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.magnific-popup.min.js"></script><!-- magnific-popup -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/scripts.js"></script><!-- Scripts -->

<?php wp_footer(); ?>

<script type="text/javascript">
	jQuery(function($){
		$('.add').on('click', function() {
		    var options = $('select.multiselect1 option:selected').sort().clone();
		    $('select.multiselect2').append(options);
		});
		$('.addAll').on('click', function() {
		    var options = $('select.multiselect1 option').sort().clone();
		    $('select.multiselect2').append(options);
		});
		$('.remove').on('click', function() {
		    $('select.multiselect2 option:selected').remove();
		});
		$('.removeAll').on('click', function() {
		    $('select.multiselect2').empty();
		});
	});
</script>

</body>
</html>
