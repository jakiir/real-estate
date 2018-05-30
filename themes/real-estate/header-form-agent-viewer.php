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
<div id="page" class="site">
	<div id="content" class="site-content">
	<nav class="navbar- navbar-default-" style="margin-top:10px;overflow:hidden;">
	  <div class="container-fluid">
		<ul class="nav navbar-nav" style="width:100%;">		  
		  <li style="float:none;text-align:center;margin:0 auto;width:150px;"><a href="#" style="text-decoration:none;" role="button" id="printDrBtn" class="button primary"><i class="fa fa-print" aria-hidden="true"></i> Full Report</a></li>
		</ul>
	  </div>
	</nav>