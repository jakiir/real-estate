<?php
/**
 * Template Name: Landing Page
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header('landing'); 
if (!is_user_logged_in()) {
	echo '<script>window.location.replace("'.home_url().'");</script>';
	die('You have no access right! Please contact system administration for more information.!');
}

$user = wp_get_current_user();
if(!empty($user) && $user->roles[0] != 'administrator' && !empty($user) && $user->roles[0] != 'company_admin' && !empty($user) && $user->roles[0] != 'inspector'){
	die('You have no access right! Please contact system administration for more information.!');
}
?>
  <article class="container">
	<div class="row">
	  <div class="col-sm-10 col-sm-offset-1">		  
		<div class="box home-box">
		<div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="image_outer_container">
							<div class="green_icon"></div>
							<div class="image_inner_container">
								<?php
									$get_author_gravatar = get_avatar_url($user->ID, array('size' => 100));
									if(has_post_thumbnail()){
										the_post_thumbnail();
									} else {
										echo '<img src="'.$get_author_gravatar.'" alt="'.get_the_title().'" />';
									}
								?>
							</div>
						</div>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4><?php echo $user->display_name; ?></h4>
						<?php $licence_number = get_user_meta($user->ID,  'licence_number', true ); ?>
                        <small><cite title="San Francisco, USA"><?php echo $licence_number; ?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?php echo $user->user_email; ?>
                            <br />
							<?php $phone_number = get_user_meta($user->ID,  'phone_number', true ); ?>
                            <i class="glyphicon glyphicon-phone-alt"></i><a style="text-decoration:none;color: #000;" href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a>
                            <br />
							<?php 
								$timestamp = strtotime($user->user_registered); 
								$regi_date = date('F d, Y', $timestamp);
							?>
                            <i class="glyphicon glyphicon-gift"></i><?php echo $regi_date; ?></p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Social</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Social</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i> Google +</a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                                <li><a href="#"><i class="fa fa-github"></i> Github</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-6">
			<div class="well well-sm">
                <div class="row">
					<div class="col-md-12">
						<a class="btn-taptap" href="<?php echo home_url('/completed-inspections/?show=year'); ?>"><i class="fa fa-calendar"></i> Inspections this year</a>
					</div>
					<hr />
					<hr />
					<div class="col-md-12">
						<a class="btn-taptap" href="<?php echo home_url('/completed-inspections/?show=month'); ?>"><i class="fa fa-calendar"></i> Inspections in the last 30 days</a>
					</div>
				</div>
			</div>			
		</div>
		</div>
		<!-- End of box -->
	  </div>
	  <!-- End of col -->
	</div>
	<!-- End of row -->
  </article>
  <!--End of container-->
<?php get_footer('landing');
