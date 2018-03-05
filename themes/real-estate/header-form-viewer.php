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
	<title>Form[todo:Replace with Form title]</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap.min.css"' ); ?>" />
</head>

<body ng-app="submitForm">
<div id="page" class="site">
	<div id="content" class="site-content">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="javascript:void(0)"><?php the_title(); ?></a>
		</div>
		<ul class="nav navbar-nav">		  
		  <?php 
			if (is_user_logged_in()) {
			$user = wp_get_current_user();
			if(!empty($user) && $user->roles[0] != 'administrator'){
		  ?>
				<li class="active"><a href="<?php echo home_url('/perform-inspection/'); ?>">Home</a></li>
				<li><a href="<?php echo home_url('/perform-inspection/'); ?>">Perform inspection</a></li>
				<li><a href="<?php echo home_url('/completed-inspections/'); ?>">Completed inspections</a></li>
			<?php } else { ?>
				<li class="active"><a href="<?php echo home_url('/template/'); ?>">Home</a></li>
				<li><a href="<?php echo home_url('/perform-inspection/'); ?>">Perform inspection</a></li>
				<li><a href="<?php echo home_url('/completed-inspections/'); ?>">Completed inspections</a></li>
				<li><a href="<?php echo home_url('/template/'); ?>">Template</a></li>
			<?php } ?>
			<li><a href="#" role="button" id="printDrBtn" class=""><i class="fa fa-print" aria-hidden="true"></i> Print</a></li>
		  <li><a class="login_button" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
			<?php } ?>
		</ul>
		<?php if (is_user_logged_in()) { ?>
			<span style="float: right;">
				<?php echo $user->display_name; ?>
				<br/>
				<?php echo $user->roles[0]; ?>
			</span>
		<?php } ?>
	  </div>
	</nav>
