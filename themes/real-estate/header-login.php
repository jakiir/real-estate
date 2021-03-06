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
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>

	<?php //wp_head(); ?>
	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap.min.css"' ); ?>" />
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/custom-style.css"' ); ?>" />
    <!--font-awesome css-->
    <link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/font-awesome.min.css"' ); ?>" />
    <!-- app css -->
    <link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/app.css"' ); ?>" />
    <!-- css for this template -->
    <link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/main.css"' ); ?>" />
</head>

<body>
<main class="area">