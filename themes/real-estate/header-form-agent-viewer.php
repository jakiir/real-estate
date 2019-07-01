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
	<!--<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap.min.css"' ); ?>" />-->
</head>

<body ng-app="submitForm">
<div id="incipitContent" style="background-color: rgb(236, 240, 241);display: flex;opacity:1;">
	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/loading_icon.gif">
	<p style="font-style: italic">Loading...</p>
	<blockquote style="border-top: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); opacity: 0;"></blockquote>
</div>
<header class="area">
      <section class="header area">
        <article class="container">
          <div class="nav-icon">
            <button class="nav-icon-btn" type="button">
              <span class="nav-icon-bar"></span>
              <span class="nav-icon-bar"></span>
              <span class="nav-icon-bar"></span>
            </button>
          </div>
          <!-- End of nav-icon -->
          <div class="main-nav">
            <div class="site-logo">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="...">
            </div>
            <!-- End of site-logo -->
            <ul>
			  <li><a href="javascript:void(0)" id="printDrBtn" class="printDrBtn" data-icon="fa-print"><i class="fa fa-print" aria-hidden="true"></i> Print Report (FULL)</a>
			  <a href="javascript:void(0)" class="printDrBtn" data-icon="fa-file">
				<i class="fa fa-file"></i> Save as PDF
			  </a>
			  </li>
            </ul>
            <!-- End of nav -->
          </div>
          <!--End of main-nav-->
          <!-- End of user-options -->
        </article>
        <!--End of container-->
      </section>
      <!--End of header-->
    </header>
    <!--End of header-->
	<main class="area">