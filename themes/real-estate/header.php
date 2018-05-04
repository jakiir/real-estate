<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realestate
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php //wp_head(); ?>
	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap.min.css"' ); ?>" />
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/custom-style.css"' ); ?>" />
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap-datetimepicker.css"' ); ?>" />
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/responsive.css"' ); ?>" />
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script><!-- jQuery -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script><!-- Bootstrap -->
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.validate.js"></script><!-- Parallax -->
</head>

<body ng-app="formbuilder">
<div id="page" class="site">
	<div id="content" class="site-content">
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container">		
		<div class="navbar-header">
			<?php if (is_user_logged_in()) { $user = wp_get_current_user(); ?>
				<span class="mobile-view-user">
					<?php echo $user->display_name; ?>
					<br/>
					<?php echo $user->roles[0]; ?>
				</span>
			<?php } ?>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">		  
		  <?php 
			if (is_user_logged_in()) {
			$user = wp_get_current_user();
			if(!empty($user) && $user->roles[0] != 'administrator'){
		  ?>
				<li class="<?php if(is_page('perform-inspection')) echo 'active'; ?>"><a href="<?php echo home_url('/perform-inspection/'); ?>">Home</a></li>
				<li class="<?php if(is_page('perform-inspection')) echo 'active'; ?>"><a href="<?php echo home_url('/perform-inspection/'); ?>">Perform inspection</a></li>
				<li class="<?php if(is_page('completed-inspections')) echo 'active'; ?>"><a href="<?php echo home_url('/completed-inspections/'); ?>">Completed inspections</a></li>
			<?php } else { ?>
				<li class="<?php if(is_page('template')) echo 'active'; ?>"><a href="<?php echo home_url('/template/'); ?>">Home</a></li>
				<li class="<?php if(is_page('perform-inspection')) echo 'active'; ?>"><a href="<?php echo home_url('/perform-inspection/'); ?>">Perform inspection</a></li>
				<li class="<?php if(is_page('completed-inspections')) echo 'active'; ?>"><a href="<?php echo home_url('/completed-inspections/'); ?>">Completed inspections</a></li>
				<li class="<?php if(is_page('template')) echo 'active'; ?>"><a href="<?php echo home_url('/template/'); ?>">Template</a></li>
			<?php } ?>
		  <li><a class="login_button" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>	
			<?php } ?>
		</ul>
		<?php if (is_user_logged_in()) { ?>
			<span class="desktop-view-user">
				<?php echo $user->display_name; ?>
				<br/>
				<?php echo $user->roles[0]; ?>
			</span>
		<?php } ?>
	  </div>
	  </div>
	</nav>
