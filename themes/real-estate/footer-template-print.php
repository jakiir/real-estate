</main>

<?php wp_footer(); ?>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/scripts.js"></script>	
<script>
	window.setTimeout(function(){
		$('#incipitContent').css({'display':'none','opacity':'0'});
	}, 20000);	
</script>

</body>
</html>
