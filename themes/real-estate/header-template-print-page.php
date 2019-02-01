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
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/css/bootstrap.min.css"' ); ?>" />
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
</head>

<body ng-app="submitForm">
<div id="incipitContent" style="background-color: rgb(236, 240, 241);display: flex;opacity:1;">
	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/loading_icon.gif">
	<p style="font-style: italic">Loading...</p>
	<blockquote style="border-top: 1px solid rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); opacity: 0;"></blockquote>
</div>
<header class="area">
<?php $user = wp_get_current_user(); ?>
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
			  <?php 
				if (is_user_logged_in()) {
				$user = wp_get_current_user();
				if(!empty($user) && $user->roles[0] != 'administrator'){
			  ?>
					<li><a class="<?php if(is_page('completed-inspections')) echo 'active'; ?>" href="<?php echo home_url('/completed-inspections/'); ?>">Back</a></li>
				<?php } else { ?>
					<li><a class="<?php if(is_page('template')) echo 'active'; ?>" href="<?php echo home_url('/template/'); ?>">Back</a></li>
				<?php } ?>
				<li><a href="javascript:void(0)" id="printTemplateBtn" onclick="printTemplateBtn()" class="btn-taptap"><i class="fa fa-print" aria-hidden="true"></i> PRINT INSPECTIONS REPORT</a></li>
				<?php } ?>
			  
            </ul>
            <!-- End of nav -->
          </div>
          <!--End of main-nav-->
          <?php /*?><div class="user-options">
			<a href="javascript:void(0)" id="fullPrintTemplateBtn" class="btn-taptap"><i class="fa fa-print" aria-hidden="true"></i> PRINT FULL TEMPLATE</a>
            <!-- End of dropdown -->
          </div><?php */ ?>
          <!-- End of user-options -->
        </article>
        <!--End of container-->
      </section>
      <!--End of header-->
    </header>
    <!--End of header-->
	<main class="area">
