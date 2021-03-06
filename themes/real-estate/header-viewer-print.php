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
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/main.css"' ); ?>" />
</head>

<body ng-app="submitForm">
<div id="incipitContent" style="background-color: rgb(236, 240, 241);display: flex;opacity:1;">
	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/loading_icon.gif">
	<p style="font-style: italic">Loading...</p>
	<blockquote style="border-top: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); opacity: 0;"></blockquote>
</div>
<!--End of header-->
<main class="area">
