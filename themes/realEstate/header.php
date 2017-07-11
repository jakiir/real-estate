<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<!-- Main CSS file -->
<?php $template_directory_uri = get_template_directory_uri(); ?>
<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap.min.css"' ); ?>" />
<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/owl.carousel.css"' ); ?>" />
<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/magnific-popup.css"' ); ?>" />
<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/font-awesome.css"' ); ?>" />
<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/style.css"' ); ?>" />
<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/responsive.css"' ); ?>" />


<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo esc_url( $template_directory_uri . '/images/icon/favicon.png"' ); ?>">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url( $template_directory_uri . '/images/icon/apple-touch-icon-144-precomposed.png"' ); ?>">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url( $template_directory_uri . '/images/icon/apple-touch-icon-114-precomposed.png"' ); ?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url( $template_directory_uri . '/images/icon/apple-touch-icon-72-precomposed.png"' ); ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( $template_directory_uri . '/images/icon/apple-touch-icon-57-precomposed.png"' ); ?>">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<?php wp_head(); ?>

</head>
<body>

<!-- PRELOADER -->
<div id="st-preloader">
	<div id="pre-status">
		<div class="preload-placeholder"></div>
	</div>
</div>
<!-- /PRELOADER -->

<!-- HEADER -->
	<header id="header">
		<nav class="navbar st-navbar navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#st-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
				    	<span class="icon-bar"></span>
				    	<span class="icon-bar"></span>
				    	<span class="icon-bar"></span>
					</button>
					<a class="logo" href="index.html"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt=""></a>
				</div>

				<div class="collapse navbar-collapse" id="st-navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
				    	<li><a href="#header">Home</a></li>
				    	<li><a href="#services">Services</a></li>
				    	<li><a href="#our-works">Works</a></li>
				    	<li><a href="#pricing">Pricing</a></li>
				    	<li><a href="#our-team">Team</a></li>
				    	<li><a href="#contact">Contact</a></li>
				    	<li><a href="blog.html">Blog</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>
	</header>
	<!-- /HEADER -->