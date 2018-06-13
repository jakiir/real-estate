<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realestate
 */

?>
</main>

<?php wp_footer(); ?>

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/scripts.js"></script>	
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/moment.min.js"></script><!-- arallax -->
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap-datetimepicker.min.js"></script><!-- Parallax -->	
<script>
	window.setTimeout(function(){
		$('#incipitContent').css({'display':'none','opacity':'0'});
	}, 10000);	
</script>

</body>
</html>
