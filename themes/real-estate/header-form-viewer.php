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
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title>Form[todo:Replace with Form title]</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!--<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap.min.css"' ); ?>" />-->
</head>

<body ng-app="submitForm">
<div id="incipitContent" style="background-color: rgb(236, 240, 241);display: flex;opacity:1;">
	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/loading_icon.gif">
	<p style="font-style: italic">Loading...</p>
	<blockquote style="border-top: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); opacity: 0;"></blockquote>
</div>
<div id="page" class="site">
	<div id="content" class="site-content">
	<nav class="navbar navbar-default">
	  <div class="container">
		<div class="navbar-header">
			<?php if (is_user_logged_in()) { $user = wp_get_current_user(); ?>
				<span class="mobile-view-user">
					<?php 
					if(!empty($user) && $user->roles[0] == 'administrator'){
						$adminUrl = admin_url();
						echo '<a href="'.$adminUrl.'">'.$user->display_name.'</a>'; 
					} else {
						echo $user->display_name;
					}
					?>
					<?php //echo $user->roles[0]; ?>
				</span>
			<?php } ?>
			<a href="javascript:void(0);" class="icon" onclick="expand_nav_menu()">&#9776;</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">		  
		  <?php 
			if (is_user_logged_in()) {
			$user = wp_get_current_user();
			if(!empty($user) && $user->roles[0] != 'administrator'){
		  ?>
				<?php /* ?><li><a href="javascript:void(0)"><?php the_title(); ?></a></li><?php */ ?>
				<li><a href="<?php echo home_url('/perform-inspection/'); ?>">Home</a></li>
				<li class="<?php if(is_page('perform-inspection')) echo 'active'; ?>"><a href="<?php echo home_url('/perform-inspection/'); ?>">Perform inspection</a></li>
				<li class="<?php if(is_page('completed-inspections')) echo 'active'; ?>"><a href="<?php echo home_url('/completed-inspections/'); ?>">Completed inspections</a></li>
			<?php } else { ?>
				<?php /* ?><li><a href="javascript:void(0)"><?php the_title(); ?></a></li><?php */ ?>
				<li><a href="<?php echo home_url('/template/'); ?>">Home</a></li>
				<li class="<?php if(is_page('perform-inspection')) echo 'active'; ?>"><a href="<?php echo home_url('/perform-inspection/'); ?>">Perform inspection</a></li>
				<li class="<?php if(is_page('completed-inspections')) echo 'active'; ?>"><a href="<?php echo home_url('/completed-inspections/'); ?>">Completed inspections</a></li>
				<li class="<?php if(is_page('template')) echo 'active'; ?>"><a href="<?php echo home_url('/template/'); ?>">Template</a></li>
			<?php } ?>
			<li><a href="#" role="button" id="printDrBtn" class=""><i class="fa fa-print" aria-hidden="true"></i> Print</a></li>
		  <li><a class="login_button" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
			<?php } ?>
		</ul>		
		<?php if (is_user_logged_in()) { ?>
			<span class="desktop-view-user">
				<?php if(!empty($user) && $user->roles[0] == 'administrator'){
						$adminUrl = admin_url();
						echo '<a href="'.$adminUrl.'">'.$user->display_name.'</a>'; 
					} else {
						echo $user->display_name;
					}
				?>
				<?php //echo $user->roles[0]; ?>
			</span>
		<?php } ?>
		</div>
	  </div>
	</nav>
