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
	<?php //wp_head(); ?>
	<?php $template_directory_uri = get_template_directory_uri(); ?>
	
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <title>6 Figure Report</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap.min.css"' ); ?>" />
    <!--font-awesome css-->
    <link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/font-awesome.min.css"' ); ?>" />
    <!-- app css -->
    <link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/app.css"' ); ?>" />
    <!-- css for this template -->
    <link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/main.css"' ); ?>" />
	
	
</head>
<body ng-app="formbuilder">
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
              <a href="<?php echo home_url('/landing-page/'); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="...">
              </a>
            </div>
            <!-- End of site-logo -->
            <ul>
              <li><a href="<?php echo home_url('/landing-page/'); ?>">Home</a></li>
              <li><a href="<?php echo home_url('/perform-inspection/'); ?>">Perform Inspections</a></li>
              <li><a href="<?php echo home_url('/completed-inspections/'); ?>">Completed Inspections</a></li>
              <li><a href="<?php echo home_url('/template/'); ?>">Templates</a></li>
            </ul>
            <!-- End of nav -->
          </div>
          <!--End of main-nav-->
          <div class="user-options">
            <h2 class="user-name">
			<?php 
				$user = wp_get_current_user();
				if(!empty($user)){
					echo $user->display_name;
				}
			?>
			</h2>
            <div class="dropdown">
              <button class="btn btn-user dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="icon-user"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a href="#">Profile</a></li>
                <li><a href="#">Company</a></li>
                <li><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
              </ul>
            </div>
            <!-- End of dropdown -->
          </div>
          <!-- End of user-options -->
        </article>
        <!--End of container-->
      </section>
      <!--End of header-->
    </header>
    <!--End of header-->
	<main class="area">