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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
  <title>Canvas Client</title>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/fa/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/style.css">
	<?php wp_head(); ?>
</head>
<body ng-app="drawing">
