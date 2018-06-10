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
<!--End of main-->

<?php wp_footer(); ?>

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/scripts.js"></script>	
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.validate.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/main.js"></script>
<script>
	window.setTimeout(function(){
		$('#incipitContent').css({'display':'none','opacity':'0'});
	}, 10000);	
</script>

</body>
</html>
